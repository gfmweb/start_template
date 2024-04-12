<?php

namespace App\Services;

use App\Interfaces\ActionRepository;
use App\Interfaces\RoleUserRepositorry;
use App\Interfaces\UserRepository;

class PermissionCheck
{
    public static function checkPermission(string $token, string $action): bool
    {
        $repository = app(ActionRepository::class);
        $action = $repository->getActionByName($action);

        if (is_null($action)) return true;
        $repository = app(UserRepository::class);
        $user = $repository->getUserByToken($token);
        $ids = [];
        foreach ($user->roles as $role) {
            if ($role['id'] == 2) return true;
            $ids[] = $role['id'];
        }
        $repository = app(RoleUserRepositorry::class);
        $permissions = $repository->getRolePermissions($ids, $action->id);
        foreach ($permissions as $permission) {
            if ($permission['granted'] == 1) {
                return true;
            }
        }
        return false;
    }
}
