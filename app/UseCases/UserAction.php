<?php

namespace App\UseCases;

use App\Interfaces\RoleUserRepositorry;
use App\Interfaces\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserAction
{
    public static function dropUserPassword(int $id): void
    {
        $repository = app(UserRepository::class);
        $user = $repository->getUserById($id);
        $user->password = Hash::make('password');
        $repository->updateUser($user);
    }

    public static function deleteUser(int $id): void
    {
        $repository = app(UserRepository::class);
        $repository->deleteUser($id);
        $repository = app(RoleUserRepositorry::class);
        $repository->userDelete($id);
    }

    public static function updateUserPassword(array $data, string $token): null |\Exception
    {
        $repository = app(UserRepository::class);
        $user =  $repository->getUserByToken($token);
        if(!Hash::check($data['current_password'], $user->password)){
            throw new \Exception('Текущий пароль введен не верно');
        }
        $repository->updateUserPassword($user->id, Hash::make($data['password']));
        return null;
    }

    public static function updateContacts(array $data, string $token): void
    {
        $repository = app(UserRepository::class);
        $user =  $repository->getUserByToken($token);
        $repository->updateContacts($user->id, $data);
    }
}
