<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\InvitationRegisterController;
use App\Http\Controllers\PreparationDataController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Гостевые маршруты
Route::middleware('guest')->group(function () {
    // Аутентификация
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.post');
        Route::get('/first-user', 'showFirstUserForm')->name('first-user');
        Route::post('/first-user', 'storeFirstUser')->name('first-user.post');
    });

    // Регистрация по приглашению
    Route::controller(InvitationRegisterController::class)
        ->prefix('register/invite/{token}')
        ->group(function () {
            Route::get('/', 'show')->name('register.invited');
            Route::post('/', 'store')->name('register.invited.store');
        });
});

// Авторизованные маршруты
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('home'))->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard/itog-dzhv', 'getZimaByRegion')->name('dashboard.itog-dzhv');

        // API для графиков
        Route::prefix('api')->group(function () {
            Route::get('/zima/by-region', 'getZimaByRegion')->name('api.zima.by-region');
            Route::get('/zima/by-work', 'getZimaByWork')->name('api.zima.by-work');
            Route::get('/zima/summary', 'getZimaSummary')->name('api.zima.summary');
            Route::get('/vokzals/by-rdzv', 'getVokzalsByRdzv')->name('api.vokzals.by-rdzv');
        });
    });

    // Подготовка данных
    Route::controller(PreparationDataController::class)
        ->prefix('preparation-data')
        ->name('preparation-data.')
        ->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/stations/{region}', 'stations')->name('stations');
        });

    // Worker
    Route::controller(WorkerController::class)
        ->prefix('worker')
        ->name('worker.')
        ->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/table', 'table')->name('table');
            Route::get('/analytics', 'analytics')->name('analytics');
            Route::get('/get-vokzals', 'getVokzals')->name('get-vokzals'); // AJAX для фильтра
        });

    // Статические страницы
    Route::prefix('pages')->group(function () {
        Route::view('/kadri', 'pages.kadri')->name('kadriMain');
        Route::view('/kadriVakcinacia', 'pages.kadriVakcinacia')->name('kadriVakcinacia');
    });

    // Админ-панель приглашений
    Route::middleware('admin-by-name')
        ->controller(InvitationController::class)
        ->prefix('invitations')
        ->name('invitations.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
        });
});
