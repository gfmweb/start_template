<?php

namespace App\UseCases;

use App\Interfaces\PermissionsRepository;
use App\Interfaces\RoleRepository;
use App\Interfaces\RoleUserRepositorry;
use App\Models\Role;
use App\Models\RoleUser;

class RolesAction
{
    public static function getAllRoles(): array
    {
        $repository = app(RoleRepository::class);
        return $repository->getAllRoles();
    }

    public static function newRoleAdd(string $role): array
    {
        $repositoryRole = app(RoleRepository::class);
        $id =  $repositoryRole->addRole($role);
        $repositoryRoleUser = app(RoleUserRepositorry::class);
        $repositoryRoleUser->addUserRole(1, $id);
        return $repositoryRole->getAllRoles();
    }

    public static function deleteRole(int $id): array
    {
        $repositoryRole = app(RoleRepository::class);
        $repository = app(RoleUserRepositorry::class);
        $repository->roleDelete($id);
        $repository = app(PermissionsRepository::class);
        $repository->removeDeleteRolePermissions($id);
        return $repositoryRole->getAllRoles();
    }

}
