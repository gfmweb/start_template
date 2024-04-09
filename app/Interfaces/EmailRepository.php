<?php

namespace App\Interfaces;

interface EmailRepository
{
    public function addOrUpdateEmail(int $user_id, string $email): void;

    public function getUserIdByEmail(string $email): ?int;
}
