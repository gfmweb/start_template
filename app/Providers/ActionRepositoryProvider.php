<?php

namespace App\Providers;

use App\Interfaces\ActionRepository;
use App\Repositories\ActionRepositoryService;
use Illuminate\Support\ServiceProvider;

class ActionRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(ActionRepository::class,ActionRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
