<?php


use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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
            ->name('update-page');
    });
    Route::resource('portfolios', PortfolioController::class)->only(['store', 'update', 'destroy']);
});
