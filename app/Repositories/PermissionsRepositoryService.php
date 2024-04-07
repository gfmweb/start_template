<?php

namespace App\Repositories;

use App\DTO\PermissionsDTO;
use App\Interfaces\ActionRepository;
use App\Interfaces\PermissionsRepository;
use App\Models\Permission;

class PermissionsRepositoryService implements PermissionsRepository
{

    public function getPermissions(int $role_id): array
    {
        $actionsRepository = app(ActionRepository::class);
        $actions = $actionsRepository->getActions();
        $permissions = Permission::where('role_id', $role_id)->get();
        return PermissionsDTO::makeFromCollections($actions, $permissions, $role_id);
    }

    public function changePermission(int $action_id, int $role_id, bool $granted)
    {
        Permission::updateOrCreate(
            ['action_id' => $action_id, 'role_id' => $role_id],
            ['granted' => $granted]
        );
    }

    public function removeDeleteRolePermissions(int $role_id): void
    {
        Permission::where('role_id', $role_id)->delete();
    }

    public function removeDeleteActionPermissions(int $action_id): void
    {
        Permission::where('action_id', $action_id)->delete();
    }
}
