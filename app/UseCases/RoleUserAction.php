<?php

namespace App\UseCases;

use App\Interfaces\RoleUserRepositorry;

class RoleUserAction
{
    public static function removeUserRole(int $user_id, int $role_id): void
    {
        $repository = app(RoleUserRepositorry::class);
        $repository->removeUserRole($user_id, $role_id);
    }

    public static function addUserRole(int $user_id, int $role_id): void
    {
        $repository = app(RoleUserRepositorry::class);
        $repository->addUserRole($user_id, $role_id);
    }
}
