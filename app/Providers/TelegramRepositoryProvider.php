<?php

namespace App\Providers;

use App\Interfaces\TelegramRepository;
use App\Repositories\TelegramRepositoryService;
use Illuminate\Support\ServiceProvider;

class TelegramRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TelegramRepository::class, TelegramRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
