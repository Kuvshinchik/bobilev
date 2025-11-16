<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            if ($request->route()->getName() !== 'invite.message') {
                return redirect()->route('invite.message');
            }
            return $next($request);
        }

        $user = Auth::user();
        $invite = \App\Models\Invite::where('user_id', $user->id)->first();
        if (!$invite || $invite->used === false) { // Или проверка по user->invite_code
            Auth::logout();
            return redirect()->route('invite.message');
        }

        return $next($request);
    }
}