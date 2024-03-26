<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class)
    ->name('homepage');

Route::middleware([RedirectIfAuthenticated::class])->group(function() {
    Route::prefix('register')->name('register.')->group(function() {
        Route::get('/', [RegisterController::class, 'index'])
            ->name('index');
        Route::post('/', [RegisterController::class, 'store'])
            ->name('store');
    });

    Route::prefix('login')->name('login.')->group(function() {
        Route::get('/', [LoginController::class, 'index'])
            ->name('index');
        Route::post('/', [LoginController::class, 'store'])
            ->name('store');
    });
});


Route::middleware([Authenticate::class])->group(function() {
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');


    Route::prefix('profile')->name('profile.')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])
            ->name('index');
        Route::put('/', [ProfileController::class, 'update'])
            ->name('update');
    });

    Route::prefix('portfolios')->name('portfolios.')->group(function() {
        Route::get('/', [PortfolioController::class, 'listPage'])
            ->name('list-page');
        Route::get('/create', [PortfolioController::class, 'createPage'])
            ->name('create-page');

        Route::get('/update/{portfolio}', [PortfolioController::class, 'updatePage'])
            ->middleware('can:update,portfolio')
            ->name('update-page');
    });
    Route::resource('portfolios', PortfolioController::class)->only(['store', 'update', 'destroy']);
});
