<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class)
    ->name('homepage');

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

Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');

Route::prefix('admin-panel')->name('admin-panel.')->group(function() {
    Route::get('/', DashboardController::class)
        ->name('dashboard');
});

