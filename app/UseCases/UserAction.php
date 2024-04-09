<?php

namespace App\UseCases;

use App\DTO\UserDTO;
use App\Interfaces\EmailRepository;
use App\Interfaces\PhoneRepository;
use App\Interfaces\RoleUserRepositorry;
use App\Interfaces\TelegramRepository;
use App\Interfaces\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserAction
{
    public static function dropUserPassword(int $id): void
    {
        $repository = app(UserRepository::class);
        $user = $repository->getUserById($id);
        $user->password = Hash::make('password');
        $repository->updateUser($user);
    }

    public static function deleteUser(int $id): void
    {
        $repository = app(UserRepository::class);
        $repository->deleteUser($id);
        $repository = app(RoleUserRepositorry::class);
        $repository->userDelete($id);
    }

    public static function updateUserPassword(array $data, string $token): null |\Exception
    {
        $repository = app(UserRepository::class);
        $user =  $repository->getUserByToken($token);
        if(!Hash::check($data['current_password'], $user->password)){
            throw new \Exception('Текущий пароль введен не верно');
        }
        $repository->updateUserPassword($user->id, Hash::make($data['password']));
        return null;
    }

    public static function updateContacts(array $data, string $token): void
    {
        $repository = app(UserRepository::class);
        $user =  $repository->getUserByToken($token);
        $telegram = app(TelegramRepository::class);
        $telegram->addOrUpdateTelegram($user->id,$data['telegram']);
        $email = app(EmailRepository::class);
        $email->addOrUpdateEmail($user->id,$data['email']);
        $phone = app(PhoneRepository::class);
        $phone->addOrUpdatePhone($user->id,$data['phone']);
    }

    public static function getUserByPhone(int $phone) : ?UserDTO
    {
        $phoneRepository = app(PhoneRepository::class);
        $user_id = $phoneRepository->getUserIdByPhone($phone);
        if(is_int($user_id))
        {
            $userRepository = app(UserRepository::class);
            return $userRepository->getUserById($user_id);
        }
        return null;
    }

    public static function getUserByEmail(string $email) : ?UserDTO
    {
        $emailRepository = app(EmailRepository::class);
        $user_id = $emailRepository->getUserIdByEmail($email);
        if(is_int($user_id))
        {
            $userRepository = app(UserRepository::class);
            return $userRepository->getUserById($user_id);
        }
        return null;
    }
}
