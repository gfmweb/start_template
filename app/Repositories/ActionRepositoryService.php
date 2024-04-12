<?php

namespace App\Repositories;

use App\DTO\ActionsDTO;
use App\Interfaces\ActionRepository;
use App\Interfaces\PermissionsRepository;
use App\Models\Action;

class ActionRepositoryService implements ActionRepository
{
    public function addAction(string $name): void
    {
        Action::create([
            'action' => $name
        ]);
    }

    public function deleteAction(int $id): void
    {
        Action::where('id', $id)->delete();
    }

    public function updateAction(int $id, string $name): void
    {
        Action::where('id', $id)->update(['action' => $name]);
    }

    public function getActions(): array
    {
        return ActionsDTO::makeFromCollection(Action::all());
    }

    public function getActionByName(string $name): ActionsDTO|null
    {
        $action = Action::where('action', $name)->first();
        return ($action) ? ActionsDTO::makeFromModel($action) : null;
    }
}
