<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    public function create(Request $request)
    {
        // Проверка админа (реализуйте middleware или gate)
        $this->authorize('admin'); // Пример с Policy

        $code = Str::random(32);
        Invite::create(['code' => $code]);

        return view('invites.create', compact('code'));
    }
}