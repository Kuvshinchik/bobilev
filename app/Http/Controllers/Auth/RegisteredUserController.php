<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\Invite;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'invite_code' => ['required', 'string', function ($attribute, $value, $fail) {
            $invite = Invite::where('code', $value)->where('used', false)->first();
            if (!$invite || $invite->isExpired()) {
                $fail('Неверный или использованный код приглашения.');
            }
        }],
    ]);

    $invite = Invite::where('code', $request->invite_code)->firstOrFail();
    $invite->update(['used' => true, 'user_id' => null]); // Зарезервируем позже

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'invite_code' => $request->invite_code, // Опционально
    ]);

    $invite->update(['user_id' => $user->id]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);

    }
}
