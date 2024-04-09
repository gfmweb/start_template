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
        $user = User::findOrFail($id)->load(['phone', 'email', 'telegram', 'roles','firebase']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function getUserByLogin(string $login): UserDTO
    {
        $user = User::where('login', $login)->firstOrFail()->load(['phone', 'email', 'telegram', 'roles','firebase']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function getUserByToken(string $token): UserDTO
    {
        $user = User::where('token', $token)->firstOrFail()->load(['phone', 'email', 'telegram', 'roles','firebase']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function getUserByRefreshToken(string $refreshToken): UserDTO
    {
        $user = User::where('refreshToken', $refreshToken)->firstOrFail()->load(['phone', 'email', 'telegram', 'roles','firebase']);
        $user = $this->buildRoles($user);
        return UserDTO::makeFromModel($user);
    }

    public function createUser(array $data): UserDTO
    {
        $user = User::create($data);
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
        return $this->getUserById($user->id);
    }

    public function deleteUser(int $id): void
    {
        User::where('id', $id)->delete();
    }

    public function getAllUsers(): array
    {
        $users = User::all()->load(['phone', 'email', 'telegram', 'roles','firebase']);
        for ($i = 0, $iMax = count($users); $i < $iMax; $i++) {
            $users[$i] = self::buildRoles($users[$i]);
        }
        return UserDTO::makeFromCollection($users);
    }

    public function updateUserPassword(int $user_id, string $password): void
    {
        User::where('id', $user_id)->update(['password' => $password]);
    }

    public function updateContacts(int $user_id, array $contacts): void
    {
        Telegram::updateOrCreate(
            ['user_id' => $user_id],
            ['telegram' => $contacts['telegram']]
        );
        Phone::updateOrCreate(
            ['user_id' => $user_id],
            ['phone' => $contacts['phone']]
        );
        Email::updateOrCreate(
            ['user_id' => $user_id],
            ['email' => $contacts['email']]
        );

    }


}
