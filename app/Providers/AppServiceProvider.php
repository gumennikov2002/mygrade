<?php

namespace App\Providers;

use App\Contracts\LinkService;
use App\Contracts\PortfolioService;
use App\Contracts\PublicPortfolioService;
use App\Contracts\ServiceService;
use App\Contracts\UserService;
use App\Services\AppLinkService;
use App\Services\AppPortfolioService;
use App\Services\AppPublicPortfolioService;
use App\Services\AppServiceService;
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
        App::bind(PublicPortfolioService::class, AppPublicPortfolioService::class);
        App::bind(ServiceService::class, AppServiceService::class);
        App::bind(LinkService::class, AppLinkService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
