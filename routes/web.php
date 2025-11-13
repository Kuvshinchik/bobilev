<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VokzalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreparationDataController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\InvitedRegisterController;



//use App\Models\User;
//use Illuminate\Support\Facades\Hash;




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


//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
});

// Форма регистрации по приглашению
Route::get('/invite/{token}', [InvitedRegisterController::class, 'showRegistrationForm'])
    ->name('invite.register');

// Отправка формы регистрации
Route::post('/invite/{token}', [InvitedRegisterController::class, 'register'])
    ->name('invite.register.post');


