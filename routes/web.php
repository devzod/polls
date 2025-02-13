<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'lang']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('login', 'login')->name('loginPost');
});

Route::middleware(['auth', 'lang'])->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('change-lang/{lang}', 'changeLang')->name('changeLang');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    //users
    Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
        Route::get('index', 'index')->name('index')->can('users.index');
        Route::post('store', 'store')->name('store')->can('users.store');
        Route::get('create', 'create')->name('create')->can('users.store');
        Route::get('updateProfile', 'updateProfile')->name('updateProfile');
        Route::put('update/{id}', 'update')->name('update')->can('users.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('users.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('users.delete');
    });

    // Permissions
    Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function () {
        Route::get('index', 'index')->name('index')->can('permissions.index');
        Route::get('create', 'create')->name('create')->can('permissions.store');
        Route::post('/store', 'store')->name('store')->can('permissions.store');
        Route::get('edit/{id}', 'edit')->name('edit')->can('permissions.update');
        Route::put('/update/{id}', 'update')->name('update')->can('permissions.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('permissions.delete');
    });

    // Roles
    Route::controller(RoleController::class)->name('roles.')->prefix('roles')->group(function () {
        Route::get('index', 'index')->name('index')->can('roles.index');
        Route::get('new', 'new')->name('new');
        Route::post('store', 'store')->name('store')->can('roles.store');
        Route::get('create', 'create')->name('create')->can('roles.store');
        Route::put('update/{id}', 'update')->name('update')->can('roles.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('roles.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('roles.delete');
    });

    // Languages
    Route::controller(LanguageController::class)->name('languages.')->prefix('languages')->group(function () {
        Route::get('index', 'index')->name('index')->can('languages.index');
        Route::get('create', 'create')->name('create')->can('languages.store');
        Route::post('/store', 'store')->name('store')->can('languages.store');
        Route::get('edit/{id}', 'edit')->name('edit')->can('languages.update');
        Route::put('/update/{id}', 'update')->name('update')->can('languages.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('languages.delete');
    });

    // Regions
    Route::controller(RegionController::class)->name('regions.')->prefix('regions')->group(function () {
        Route::get('index', 'index')->name('index')->can('regions.index');
        Route::get('create', 'create')->name('create')->can('regions.store');
        Route::post('/store', 'store')->name('store')->can('regions.store');
        Route::get('edit/{id}', 'edit')->name('edit')->can('regions.update');
        Route::put('/update/{id}', 'update')->name('update')->can('regions.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('regions.delete');
    });

    // POS
    Route::controller(PosController::class)->name('pos.')->prefix('pos')->group(function () {
        Route::get('index', 'index')->name('index')->can('pos.index');
        Route::get('create', 'create')->name('create')->can('pos.store');
        Route::post('/store', 'store')->name('store')->can('pos.store');
        Route::get('edit/{id}', 'edit')->name('edit')->can('pos.update');
        Route::put('/update/{id}', 'update')->name('update')->can('pos.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('pos.delete');
    });

    // POLL
    Route::controller(PollController::class)->name('poll.')->prefix('polls')->group(function () {
        Route::get('index', 'index')->name('index')->can('poll.index');
        Route::get('create', 'create')->name('create')->can('poll.store');
        Route::post('/store', 'store')->name('store')->can('poll.store');
        Route::get('show/{id}', 'show')->name('show')->can('poll.index');
        Route::get('edit/{id}', 'edit')->name('edit')->can('poll.update');
        Route::put('/update/{id}', 'update')->name('update')->can('poll.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('poll.delete');
    });

    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');

});
