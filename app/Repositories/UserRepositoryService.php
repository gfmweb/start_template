<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Interfaces\RoleUserRepositorry;
use App\Interfaces\UserRepository;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Role;
use App\Models\Telegram;
use App\Models\User;


class UserRepositoryService implements UserRepository
{
    private function buildRoles(User $user): User
    {
        $roles = [];
        $ids = [];
        foreach ($user->roles as $role) {
            $ids[] = $role->role_id;
        }
        $rolesModel = Role::whereIn('id', $ids)->get();
        foreach ($rolesModel as $item) {
            $roles[] = ['id' => $item->id, 'role' => $item->role];
        }
        $user->roles = $roles;
        return $user;
    }

    public function getUserById(int $id): UserDTO
    {
        $user = User::findOrFail($id)->load(['phone', 'email', 'telegram', 'roles']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function getUserByLogin(string $login): UserDTO
    {
        $user = User::where('login', $login)->firstOrFail()->load(['phone', 'email', 'telegram', 'roles']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function getUserByToken(string $token): UserDTO
    {
        $user = User::where('token', $token)->firstOrFail()->load(['phone', 'email', 'telegram', 'roles']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function getUserByRefreshToken(string $refreshToken): UserDTO
    {
        $user = User::where('refreshToken', $refreshToken)->firstOrFail()->load(['phone', 'email', 'telegram', 'roles']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function createUser(array $data): UserDTO
    {
        $user = User::create($data);
        if (isset($data['email'])) {
            Email::create(['user_id' => $user->id, 'email' => $data['email']]);
        }
        if (isset($data['phone'])) {
            Phone::create(['user_id' => $user->id, 'phone' => $data['phone']]);
        }
        if (isset($data['telegram'])) {
            Telegram::create(['user_id' => $user->id, 'telegram' => $data['telegram']]);
        }
        $roleUser = app(RoleUserRepositorry::class);
        $roleUser->addUserRole($user->id, 1);
        return $this->getUserById($user->id);
    }

    public function updateUser(UserDTO $user): UserDTO
    {
        $userModel = User::findOrFail($user->id);
        $userModel->name = $user->name;
        $userModel->login = $user->login;
        $userModel->password = $user->password;
        $userModel->token = $user->token;
        $userModel->rememberToken = $user->rememberToken;
        $userModel->save();
        if (isset($user->email)) {
            Email::where('user_id', $user->id)->update(['email' => $user->email]);
        }
        if (isset($user->phone)) {
            Phone::where('user_id', $user->id)->update(['phone' => $user->phone]);
        }
        if (isset($user->telegram)) {
            Telegram::where('user_id', $user->id)->update(['telegram' => $user->phone]);
        }

        return $this->getUserById($user->id);
    }

    public function deleteUser(int $id): void
    {
        User::where('id', $id)->delete();
    }

    public function getAllUsers(): array
    {
        $users = User::all()->load(['phone', 'email', 'telegram', 'roles']);
        for ($i = 0, $iMax = count($users); $i < $iMax; $i++) {
            $users[$i] = self::buildRoles($users[$i]);
        }
        return UserDTO::makeFromCollection($users);
    }
}
