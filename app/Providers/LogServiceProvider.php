<?php

namespace App\Providers;

use App\Interfaces\LogService;
use App\Repositories\LogsRepository;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(LogService::class, LogsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
