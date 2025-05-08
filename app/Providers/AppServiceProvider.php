<?php

namespace App\Providers;

use App\Services\Contracts\LoginPredictionServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\LoginPredictionService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginPredictionServiceInterface::class, LoginPredictionService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
