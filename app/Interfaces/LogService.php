<?php

namespace App\Interfaces;

use App\DTO\LogDTO;
use Illuminate\Support\Carbon;

interface LogService
{
    public function getLogsByUserId(int $userId);

    public function getLogsByDate(Carbon $startDate, Carbon $endDate): array;

    public function storeLog(int $userId, string $data): void;

}
