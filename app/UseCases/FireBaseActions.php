<?php

namespace App\UseCases;

use App\Interfaces\FirebaseRepository;
use App\Interfaces\UserRepository;

class FireBaseActions
{
    public static function AddUpdateFireBase(string $token, string $firebase): void
    {
        $UserRepository = app(UserRepository::class);
        $user = $UserRepository->getUserByToken($token);
        $FireBaseRepository = app(FirebaseRepository::class);
        $FireBaseRepository->firebaseAddUpdate($user->id, $firebase);
    }
}
