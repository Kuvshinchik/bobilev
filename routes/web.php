<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VokzalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreparationDataController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\InvitedRegisterController;


use App\Http\Controllers\HomeController;
//use App\Models\User;
//use Illuminate\Support\Facades\Hash;





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




Auth::routes(); // Регистрирует /register
//Auth::routes(['register' => false]);

// ВСЕ остальные маршруты защищены
Route::middleware(['auth'])->group(function () {
    Route::get('/', [IndexController::class, 'execute'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // все остальные маршруты
});




/*
Route::get('/vokzals', [VokzalController::class, 'index'])
    ->name('vokzals.index');

Route::get('/vokzals/{id}', [VokzalController::class, 'show'])
    ->name('vokzals.show');
	*/
	
Route::get('/dashboard/itog-dzhv', [DashboardController::class, 'itogDzhv']);

Route::get('/preparation-data/create', [PreparationDataController::class, 'create'])
    ->name('preparation-data.create');

Route::post('/preparation-data', [PreparationDataController::class, 'store'])
    ->name('preparation-data.store');




Route::get('/invite-only', function () {
    return view('invite-only');
})->name('invite.message');

Route::get('/admin/invites/create', [App\Http\Controllers\InviteController::class, 'create'])->middleware(['auth']);









/*
Route::get('/home', [App\Http\Controllers\IndexController::class, 'execute'])->name('home');


Route::get('/admin/invites/create', [App\Http\Controllers\InviteController::class, 'create'])->middleware(['auth']);

// Форма регистрации по приглашению
Route::get('/invite/{token}', [InvitedRegisterController::class, 'showRegistrationForm'])
    ->name('invite.register');

// Отправка формы регистрации
Route::post('/invite/{token}', [InvitedRegisterController::class, 'register'])
    ->name('invite.register.post');


*/


















/*
// Переопределяем роут /register, применяя наш посредник
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])
    ->middleware('check.invitations')
    ->name('register');

// Важно: нужно также защитить POST-запрос регистрации,
// чтобы нельзя было обойти GET-маршрут
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])
    ->middleware('check.invitations');
*/




/*

Route::get('/debug-password', function () {
    $user = User::where('email', 'admin@example.com')->first();

    if (!$user) {
        return 'Пользователь admin@example.com не найден';
    }

    $ok = Hash::check('12345678', $user->password);

    return $ok ? 'Пароль подходит' : 'Пароль НЕ подходит';
});




use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/create-admin', function () {
    $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('12345678'),
    ]);

    return 'Админ создан! ID: ' . $user->id;
});





Route::get('/debug-users', function () {
    return User::all();
});

Route::get('/test-login', function () {
    $credentials = [
        'email' => 'admin@example.com',
        'password' => '12345678',
    ];

    if (Auth::attempt($credentials)) {
        // Авторизация прошла, Laravel создал сессию
        return 'Auth::attempt(TRUE). Пользователь: ' . Auth::user()->email;
    }

    return 'Auth::attempt(FALSE) — логин/пароль считаются неверными';
});



Route::get('/force-login', function () {
    $user = User::where('email', 'admin@example.com')->first();

    if (!$user) {
        return 'Пользователь admin@example.com не найден';
    }

    Auth::login($user); // логиним без пароля

    return redirect('/check-auth');
});

Route::get('/check-auth', function () {
    return auth()->check()
        ? 'Вы залогинены как: ' . auth()->user()->email
        : 'Вы НЕ залогинены';
});

*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
