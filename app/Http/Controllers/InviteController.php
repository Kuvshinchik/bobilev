<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    public function create(Request $request)
    {
        // Логика только для админов (добавьте проверку)
    $code = Str::random(32);
    Invite::create(['code' => $code]);
    return view('invites.create', ['code' => $code]);
    }
}