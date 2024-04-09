<?php

namespace App\Interfaces;

interface FirebaseRepository
{
    public function firebaseAddUpdate(int $user_id, string $firebase): void;
}
