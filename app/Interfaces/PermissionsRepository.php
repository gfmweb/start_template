<?php

namespace App\Interfaces;

interface PermissionsRepository
{
    public function getPermissions(int $role_id): array;

    public function changePermission(int $action_id, int $role_id, bool $granted);

    public function removeDeleteRolePermissions(int $role_id): void;

    public function removeDeleteActionPermissions(int $action_id): void;

}
