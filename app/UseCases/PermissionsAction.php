<?php

namespace App\UseCases;

use App\DTO\PermissionsDTO;
use App\Interfaces\ActionRepository;
use App\Interfaces\PermissionsRepository;

class PermissionsAction
{
    public static function getPermissions(int $role_id): array
    {
        $permissionsrepository = app(PermissionsRepository::class);
        $permissions = $permissionsrepository->getPermissions($role_id);
        $actionsRepository = app(ActionRepository::class);
        $actions = $actionsRepository->getActions();
        return PermissionsDTO::makeFromCollections($actions, $permissions, $role_id);
    }

    public static function changePermissions(int $action_id, int $role_id, bool $granted): void
    {
        $provider = app(PermissionsRepository::class);
        $provider->changePermission($action_id, $role_id, $granted);
    }


}
