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

    public function addRole(string $role): int
    {
        $role = Role::create([
            'role' => $role
        ]);
        return $role->id;
    }

    public function renameRole(int $id, string $role): array
    {
        Role::where('id', $id)->update(['role' => $role]);
        return $this->getAllRoles();
    }

    public function deleteRole(int $id): void
    {
        Role::destroy($id);
    }
}
