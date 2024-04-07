<?php

namespace App\Providers;

use App\Interfaces\RoleUserRepositorry;
use App\Repositories\RoleUserReposyporyService;
use Illuminate\Support\ServiceProvider;

class RoleUserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoleUserRepositorry::class,RoleUserReposyporyService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
