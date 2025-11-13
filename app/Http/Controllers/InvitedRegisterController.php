<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitedRegisterController extends Controller
{
    public function showRegistrationForm($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || !$invitation->isValid()) {
            abort(403, 'Недействительное или просроченное приглашение.');
        }

        return view('auth.invited-register', [
            'token'      => $token,
            'invitation' => $invitation,
        ]);
    }

    public function register(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || !$invitation->isValid()) {
            abort(403, 'Недействительное или просроченное приглашение.');
        }

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // создаём пользователя привязанного к email приглашения
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $invitation->email,
            'password' => Hash::make($data['password']),
        ]);

        // помечаем приглашение как использованное
        $invitation->update([
            'used' => true,
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('home'); // подстрой под свой маршрут
    }
}
