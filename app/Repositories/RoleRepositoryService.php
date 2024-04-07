<?php

namespace App\Repositories;

use App\DTO\RoleDTO;
use App\Interfaces\PermissionsRepository;
use App\Interfaces\RoleRepository;
use App\Interfaces\RoleUserRepositorry;
use App\Models\Role;

class RoleRepositoryService implements RoleRepository
{

    public function getAllRoles(): array
    {
        return RoleDTO::makeFromCollection(Role::all());
    }

    public function addRole(string $role): array
    {
        $role = Role::create([
            'role' => $role
        ]);
        $repository = app(RoleUserRepositorry::class);
        $repository->addUserRole(1, $role->id);
        return $this->getAllRoles();
    }

    public function renameRole(int $id, string $role): array
    {
        Role::where('id', $id)->update(['role' => $role]);
        return $this->getAllRoles();
    }

    public function deleteRole(int $id): array
    {
        Role::destroy($id);
        $repository = app(RoleUserRepositorry::class);
        $repository->roleDelete($id);
        $repository = app(PermissionsRepository::class);
        $repository->removeDeleteRolePermissions($id);
        return $this->getAllRoles();
    }
}
