<?php

namespace App\Providers;

use App\Interfaces\PhoneRepository;
use App\Repositories\PhoneRepositoryService;
use Illuminate\Support\ServiceProvider;

class PhoneRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(PhoneRepository::class,PhoneRepositoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
