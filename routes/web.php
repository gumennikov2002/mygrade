<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio/{username}/{slug}', [PortfolioController::class, 'indexPublic']);

Route::middleware(['guest'])->group(function () {
    Route::get('/', HomepageController::class)->name('homepage');

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/', [Auth\RegisterController::class, 'index'])->name('index');
        Route::post('/', [Auth\RegisterController::class, 'store'])->name('store');
    });

    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [Auth\LoginController::class, 'index'])->name('index');
        Route::post('/', [Auth\LoginController::class, 'store'])->name('store');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [Auth\LoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    Route::resource('portfolios', PortfolioController::class);
    Route::resource('services', ServiceController::class)->only(['store', 'update', 'destroy']);
    Route::resource('links', LinkController::class)->only(['store', 'update', 'destroy']);
});
