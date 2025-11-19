<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InviteOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Для неавторизованных: показать страницу с сообщением
            if ($request->route()->getName() !== 'invite.message') {
                return redirect()->route('invite.message');
            }
            return $next($request);
        }

        // Для авторизованных: проверить, использовали ли они приглашение
        $user = Auth::user();
        if (!$user->invite_code && !Invite::where('user_id', $user->id)->exists()) {
            Auth::logout();
            return redirect()->route('invite.message');
        }

        return $next($request);
    }
}