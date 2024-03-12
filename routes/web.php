<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class)
    ->name('homepage');

Route::prefix('register')->as('register')->group(function() {
    Route::get('/', [RegisterController::class, 'index'])
        ->name('index');
    Route::post('/', [RegisterController::class, 'store'])
        ->name('store');
});

Route::get('login', [LoginController::class, 'index'])
    ->name('index');
Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');

Route::resource('login', LoginController::class)
    ->only(['index', 'store', 'destroy']);

Route::prefix('admin-panel')->as('admin-panel')->group(function() {
    Route::get('/', DashboardController::class)
        ->name('dashboard');
});

