<?php

namespace App\UseCases;

use App\DTO\UserDTO;
use App\Exceptions\LoginRegisterLogoutException;
use App\Interfaces\UserRepository;
use App\Services\RedisThrottle;
use Illuminate\Support\Facades\Hash;

class LoginRegisterLogout
{
    /**
     * @param array $data
     * @return UserDTO|LoginRegisterLogoutException
     * @throws LoginRegisterLogoutException
     */
    public static function login(array $data): UserDTO|LoginRegisterLogoutException
    {
        if (!RedisThrottle::checkLogin($data['login']))
            throw new LoginRegisterLogoutException('Превышено количество попыток входа. Попробуйте позже');
        RedisThrottle::setAttemptLogin($data['login']);
        $repository = app(UserRepository::class);
        $dbUser = $repository->getUserByLogin($data['login']);
        if (!Hash::check($data['password'], $dbUser->password))
            throw new LoginRegisterLogoutException('Неправильное имя пользователя или пароль');
        RedisThrottle::removeLoginAttempts($data['login']);
        $token = Hash::make($dbUser->password . time());
        $rememberToken = Hash::make($token);
        $dbUser->token = $token;
        $dbUser->rememberToken = $rememberToken;
        $repository->updateUser($dbUser);
        return $dbUser;
    }

    public static function register(array $data, string $ip): UserDTO|LoginRegisterLogoutException
    {
        if (!RedisThrottle::checkRegisterAttempt($ip))
            throw new LoginRegisterLogoutException('Слишком много регистраций');
        $repository = app(UserRepository::class);
        RedisThrottle::checkRegisterAttempt($ip);
        $dbUser = $repository->createUser($data);
        $token = Hash::make($dbUser->password . time());
        $rememberToken = Hash::make($token);
        $dbUser->token = $token;
        $dbUser->password = Hash::make($data['password']);
        $dbUser->roles = [['id' => 1, 'role' => 'Пользователь']];
        $dbUser->rememberToken = $rememberToken;
        $repository->updateUser($dbUser);
        RedisThrottle::removeRegisterAttempt($ip);
        return $dbUser;
    }

    public static function logout(string $token)
    {
        $repository = app(UserRepository::class);
        $dbUser = $repository->getUserByToken($token);
        $dbUser->token = null;
        $dbUser->rememberToken = null;
        $repository->updateUser($dbUser);
    }
}
