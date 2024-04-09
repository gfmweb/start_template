<?php

namespace App\Repositories;

use App\Interfaces\FirebaseRepository;
use App\Models\FireBase;

class FirebaseRepositoryService implements FirebaseRepository
{

    public function firebaseAddUpdate(int $user_id, string $firebase): void
    {
        FireBase::updateOrCreate(
            ['user_id' => $user_id],
            ['firebase' => $firebase]
        );
    }
}
