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
    }
}
