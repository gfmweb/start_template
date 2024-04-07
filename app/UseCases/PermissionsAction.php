<?php

namespace App\UseCases;

use App\Interfaces\PermissionsRepository;

class PermissionsAction
{
    public static function getPermissions(int $role_id): array
    {
        $provider = app(PermissionsRepository::class);
        return $provider->getPermissions($role_id);
    }

    public static function changePermissions(int $action_id, int $role_id, bool $granted): void
    {
        $provider = app(PermissionsRepository::class);
        $provider-> changePermission($action_id, $role_id, $granted );
    }


}
