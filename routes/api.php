<?php

use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\StuffAuthController;
use App\Http\Controllers\Api\StuffController;
use Illuminate\Support\Facades\Route;

Route::controller(StuffAuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::controller(StuffController::class)->prefix('stuff')->name('stuff.')->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::post('update', 'update')->name('update');
    });

    Route::controller(PosController::class)->prefix('pos')->name('pos.')->group(function () {
        Route::get('all', 'getAll')->name('getAll');
        Route::post('update', 'update')->name('update');
    });

});
