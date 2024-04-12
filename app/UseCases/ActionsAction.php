<?php

namespace App\UseCases;

use App\Interfaces\ActionRepository;
use App\Interfaces\PermissionsRepository;

class ActionsAction
{
    public static function getActions(): array
    {
        $repository = app(ActionRepository::class);
        return $repository->getActions();
    }

    public static function deleteAction(int $id): void
    {
        $repository = app(ActionRepository::class);
        $repository->deleteAction($id);
        $repository = app(PermissionsRepository::class);
        $repository->removeDeleteActionPermissions($id);
    }

    public static function addAction(string $action): void
    {
        $repository = app(ActionRepository::class);
        $repository->addAction($action);
    }
}
