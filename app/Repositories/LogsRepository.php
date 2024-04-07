<?php

namespace App\Repositories;

use App\DTO\LogDTO;
use App\Interfaces\LogService;
use App\Models\Log;
use Illuminate\Support\Carbon;

class LogsRepository implements LogService
{

    public function getLogsByUserId(int $userId)
    {
        $ModelData = Log::where('user_id', $userId)->get();
        return LogDTO::makeFromCollection($ModelData);
    }

    public function getLogsByDate(Carbon $startDate, Carbon $endDate): array
    {
        return [];
    }

    public function storeLog(int $userId, string $data): void
    {
        // TODO: Implement storeLog() method.
    }
}
