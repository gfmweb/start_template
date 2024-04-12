<?php

namespace App\Interfaces;

use App\DTO\RoleDTO;

interface RoleUserRepositorry
{
    public function removeUserRole(int $user_id, int $role_id): void;

    public function addUserRole(int $user_id, int $role_id): void;

    public function userDelete(int $user_id): void;

    public function roleDelete(int $role_id): void;

    public function getRolePermissions(array $roles_id, int $action_id): array;

}
