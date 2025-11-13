<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitationController extends Controller
{
    namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function __construct()
    {
        // Только для админов/авторизованных — подстрой под свою логику
        $this->middleware('auth');
        // $this->middleware('can:manage-invitations'); // если есть policy/gate
    }

    public function index()
    {
        $invitations = Invitation::latest()->paginate(20);

        return view('invitations.index', compact('invitations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:invitations,email'],
        ]);

        $token = Str::random(32);

        $invitation = Invitation::create([
            'email'      => $data['email'],
            'token'      => $token,
            'expires_at' => now()->addDays(7), // например, 7 дней
        ]);

        // тут можно сразу отправить письмо с ссылкой
        // Mail::to($invitation->email)->send(new InvitationMail($invitation));

        return back()->with('status', 'Приглашение создано. Ссылка: ' . route('invite.register', $token));
    }
}

}
