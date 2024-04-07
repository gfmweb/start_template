<?php

namespace App\Providers;

use App\Interfaces\PermissionsRepository;
use App\Repositories\PermissionsRepositoryService;
use Illuminate\Support\ServiceProvider;

class PermissionsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(PermissionsRepository::class,PermissionsRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
