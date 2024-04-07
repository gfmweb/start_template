<?php

namespace App\Interfaces;

use App\DTO\RoleDTO;

interface RoleRepository
{
    public function getAllRoles(): array;

    public function addRole(string $role): array;

    public function renameRole(int $id, string $role): array;

    public function deleteRole(int $id): array;


}
