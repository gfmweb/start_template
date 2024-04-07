<?php

namespace App\Providers;

use App\Interfaces\UserRepository;
use App\Repositories\UserRepositoryService;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class,UserRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
