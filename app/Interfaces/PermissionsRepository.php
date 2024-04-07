<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface PermissionsRepository
{
    public function getPermissions(int $role_id): Collection;

    public function changePermission(int $action_id, int $role_id, bool $granted);

    public function removeDeleteRolePermissions(int $role_id): void;

    public function removeDeleteActionPermissions(int $action_id): void;

}
