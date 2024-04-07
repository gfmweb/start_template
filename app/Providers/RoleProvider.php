<?php

namespace App\Providers;

use App\Interfaces\RoleRepository;
use App\Repositories\RoleRepositoryService;
use Illuminate\Support\ServiceProvider;

class RoleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(RoleRepository::class,RoleRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
