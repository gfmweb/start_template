<?php

namespace App\Providers;

use App\Interfaces\FirebaseRepository;
use App\Repositories\FirebaseRepositoryService;
use Illuminate\Support\ServiceProvider;

class FirebaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FirebaseRepository::class,FirebaseRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
