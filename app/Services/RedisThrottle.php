<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisThrottle
{
    private $redis;
    private $attempLimit;

    private function __construct()
    {
        $this->redis = Redis::connection();
        $this->attempLimit = config('throttle.login');
    }

    /**
     * Регистрирует попытку входа
     * @param string $login
     * @return void
     */
    public static function setAttemptLogin(string $login): void
    {
        $service = new self();
        if ($service->redis->command('EXISTS', ['attempt_' . $login]) == 1) {
            $service->redis->command('INCR', ['attempt_' . $login]);
        } else {
            $service->redis->command('SET', ['attempt_' . $login, 1, config('throttle.ttl')]);
        }
    }

    /**
     * Проверяет превышение допустимых попыток входа
     * @param string $login
     * @return bool
     */
    public static function checkLogin(string $login): bool
    {
        $service = new self();
        if ($service->redis->command('EXISTS', ['attempt_' . $login]) == 1) {
            return ($service->redis->command('GET', ['attempt_' . $login]) < config('throttle.login'));
        } else {
            return true;
        }
    }

    /**
     * Уничтожает запись о попытке входа
     * @param string $login
     * @return void
     */
    public static function removeLoginAttempts(string $login): void
    {
        $service = new self();
        $service->redis->command('DEL', ['attempt_' . $login]);
    }

    public static function setRegisterAttempt(string $ip): void
    {
        $service = new self();
        $service->redis->command('SET', ['register_' . str_replace('.', '_', $ip), 1, config('throttle.ttl')]);
    }

    public static function checkRegisterAttempt(string $ip): bool
    {
        $service = new self();
        if ($service->redis->command('EXISTS', ['register_' . str_replace('.', '_', $ip)]) == 1) {
            return ($service->redis->command('GET', ['register_' . str_replace('.', '_', $ip)]) < config('throttle.login'));
        } else {
            return true;
        }
    }

    public static function removeRegisterAttempt(string $ip): void
    {
        $service = new self();
        $service->redis->command('DEL', ['register_' . str_replace('.', '_', $ip)]);
    }
}
