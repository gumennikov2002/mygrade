<?php

namespace App\Providers;

use App\Contracts\PortfolioService;
use App\Contracts\UserService;
use App\Services\AppPortfolioService;
use App\Services\AppUserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(UserService::class, AppUserService::class);
        App::bind(PortfolioService::class, AppPortfolioService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
