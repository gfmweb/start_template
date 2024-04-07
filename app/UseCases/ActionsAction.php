<?php

namespace App\UseCases;

use App\Interfaces\ActionRepository;

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
    }

    public static function addAction(string $action): void
    {
        $repository = app(ActionRepository::class);
        $repository->addAction($action);
    }
}
