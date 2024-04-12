<?php

namespace App\Repositories;

use App\Interfaces\EmailRepository;
use App\Models\Email;

class EmailRepositoryService implements EmailRepository
{

    public function addOrUpdateEmail(int $user_id, string $email): void
    {
        Email::updateOrCreate(
            ['user_id' => $user_id],
            ['email' => $email]
        );
    }

    public function getUserIdByEmail(string $email): ?int
    {
        return Email::select('user_id')->where('email', $email)->first()->user_id;
    }
}
