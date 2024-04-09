<?php

namespace App\Repositories;

use App\Interfaces\TelegramRepository;
use App\Models\Telegram;

class TelegramRepositoryService implements TelegramRepository
{

    public function addOrUpdateTelegram(int $user_id, int $telegram): void
    {
        Telegram::updateOrCreate(
            ['user_id' => $user_id],
            ['telegram' => $telegram]
        );
    }

    public function getUserIdByTelegram(int $telegram): ?int
    {
        return Telegram::select('user_id')->where('telegram', $telegram)->first()->user_id;
    }
}
