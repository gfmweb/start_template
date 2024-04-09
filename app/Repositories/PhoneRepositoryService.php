<?php

namespace App\Repositories;

use App\Interfaces\PhoneRepository;
use App\Models\Phone;

class PhoneRepositoryService implements PhoneRepository
{

    public function addOrUpdatePhone(int $user_id, int $phone): void
    {
        Phone::updateOrCreate(
            ['user_id' => $user_id],
            ['phone' => $phone]
        );
    }

    public function getUserIdByPhone(int $phone): ?int
    {
        return Phone::select('user_id')->where('phone', $phone)->first()->user_id;
    }
}
