<?php

namespace App\Interfaces;

use App\DTO\ActionsDTO;

interface ActionRepository
{
    public function getActions(): array;

    public function addAction(string $name): void;

    public function deleteAction(int $id): void;

    public function updateAction(int $id, string $name): void;

    public function getActionByName(string $name):ActionsDTO|null;

}
