<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VokzalController;
use App\Http\Controllers\DashboardController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/
// Группа маршрутов для основного сайта

Route::group([], function () {
    // Главная страница
    Route::match(['get', 'post'], '/', [IndexController::class, 'execute'])->name('index');


});

Route::get('/vokzals', [VokzalController::class, 'index'])
    ->name('vokzals.index');
    
Route::get('/vokzals/{id}', [VokzalController::class, 'show'])
    ->name('vokzals.show');
	
Route::get('/dashboard/itog-dzhv', [DashboardController::class, 'itogDzhv']);