<?php

namespace App\Interfaces;

interface PhoneRepository
{
    public function addOrUpdatePhone(int $user_id, int $phone): void;

    public function getUserIdByPhone(int $phone): ?int;
}
