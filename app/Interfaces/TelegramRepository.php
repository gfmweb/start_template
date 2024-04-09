<?php

namespace App\Interfaces;

interface TelegramRepository
{
    public function addOrUpdateTelegram(int $user_id, int $telegram): void;

    public function getUserIdByTelegram(int $telegram): ?int;
}
