<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\InvitationRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreparationDataController;
use App\Http\Controllers\WorkerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Авторизованные маршруты
Route::middleware('auth')->group(function () {
	Route::get('/', function () {return view('home');})->name('home');
	
	//Route::get('/dashboard', function () {return view('index');})->name('dashboard');
	//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	//Route::get('/dashboard/itog-dzhv', [DashboardController::class, 'itogDzhv']);
	
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// API для графиков Morris.js
Route::get('/api/zima/by-region', [DashboardController::class, 'getZimaByRegion'])
    ->name('api.zima.by-region');

Route::get('/api/zima/by-work', [DashboardController::class, 'getZimaByWork'])
    ->name('api.zima.by-work');

Route::get('/api/zima/summary', [DashboardController::class, 'getZimaSummary'])
    ->name('api.zima.summary');
	

Route::get('/api/vokzals/by-rdzv', [DashboardController::class, 'getVokzalsByRdzv']);	

	
	//Route::get('/dashboard/itog-dzhv', [App\Http\Controllers\DashboardController::class, 'getItogDzhvData'])->name('dashboard.itog-dzhv');
Route::get('/dashboard/itog-dzhv', [App\Http\Controllers\DashboardController::class, 'getZimaByRegion'])->name('dashboard.itog-dzhv');

    Route::middleware('admin-by-name')->group(function () {
        Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
        Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
        Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
});
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	
	Route::get('/preparation-data/create', [PreparationDataController::class, 'create'])
        ->name('preparation-data.create');

    Route::post('/preparation-data', [PreparationDataController::class, 'store'])
        ->name('preparation-data.store');

    // AJAX для подгрузки вокзалов по РДЖВ
    Route::get('/preparation-data/stations/{region}', [PreparationDataController::class, 'stations'])
        ->name('preparation-data.stations');
	

Route::get('/worker/dashboard', [WorkerController::class, 'dashboard'])->name('worker.dashboard');
Route::get('/worker/table', [WorkerController::class, 'table'])->name('worker.table');
Route::get('/worker/analytics', [WorkerController::class, 'analytics'])->name('worker.analytics');
Route::get('/pages/kadri', function () {return view('pages.kadri');})->name('kadriMain');
Route::get('/pages/kadriVakcinacia', function () {return view('pages.kadriVakcinacia');})->name('kadriVakcinacia');
});

// Гостевые маршруты
Route::middleware('guest')->group(function () {
    // логин
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // регистрация первого пользователя (только пока нет ни одного)
    Route::get('/first-user', [AuthController::class, 'showFirstUserForm'])->name('first-user');
    Route::post('/first-user', [AuthController::class, 'storeFirstUser'])->name('first-user.post');

    // регистрация по приглашению
    Route::get('/register/invite/{token}', [InvitationRegisterController::class, 'show'])
        ->name('register.invited');

    Route::post('/register/invite/{token}', [InvitationRegisterController::class, 'store'])
        ->name('register.invited.store');
});


