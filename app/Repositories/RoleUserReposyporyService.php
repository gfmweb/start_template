<?php

namespace App\Repositories;

use App\DTO\PermissionsDTO;
use App\Interfaces\RoleUserRepositorry;
use App\Models\Permission;
use App\Models\RoleUser;

class RoleUserReposyporyService implements RoleUserRepositorry
{

    public function removeUserRole(int $user_id, int $role_id): void
    {
        RoleUser::where('user_id', $user_id)->where('role_id', $role_id)->delete();
    }

    public function addUserRole(int $user_id, int $role_id): void
    {
        RoleUser::create(
            [
                'user_id' => $user_id,
                'role_id' => $role_id
            ]
        );
    }

    public function userDelete(int $user_id): void
    {
        RoleUser::where('user_id', $user_id)->delete();
    }

    public function roleDelete(int $role_id): void
    {
        RoleUser::where('role_id', $role_id)->delete();
    }

    public function getRolePermissions(array $roles_id, int $action_id): array
    {
        $DBData = Permission::whereIn('role_id', $roles_id)->where('action_id', $action_id)->get()->toArray();
        return $DBData;
    }
}
