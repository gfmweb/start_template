<?php

namespace App\UseCases;

use App\Interfaces\RoleRepository;
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
        $repository = app(RoleRepository::class);
        return $repository->addRole($role);
    }

    public static function deleteRole(int $id): array
    {
        $repository = app(RoleRepository::class);
        return $repository->deleteRole($id);
    }

}
