<?php

namespace App\Providers;

use App\Contracts\PortfolioService;
use App\Contracts\PublicPortfolioService;
use App\Contracts\UserService;
use App\Services\AppLinkService;
use App\Services\AppPortfolioService;
use App\Services\AppPublicPortfolioService;
use App\Services\AppServiceService;
use App\Services\AppUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, AppUserService::class);
        $this->app->bind(PortfolioService::class, AppPortfolioService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
