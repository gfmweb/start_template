<?php

namespace App\Providers;

use App\Interfaces\EmailRepository;
use App\Repositories\EmailRepositoryService;
use Illuminate\Support\ServiceProvider;

class EmailRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->bind(EmailRepository::class,EmailRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
