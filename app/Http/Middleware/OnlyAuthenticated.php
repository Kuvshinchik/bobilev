<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Разрешаем гостям маршруты логина
        if ($request->routeIs('login', 'logout')) {
            return $next($request);
        }

        // Разрешаем восстановление пароля (если используешь)
        if ($request->routeIs(
            'password.request',
            'password.email',
            'password.reset',
            'password.update'
        )) {
            return $next($request);
        }

        // Разрешаем регистрацию по приглашению
        if ($request->routeIs('invite.register', 'invite.register.post')) {
            return $next($request);
        }

        // Если пользователь авторизован — пропускаем
        if (auth()->check()) {
            return $next($request);
        }

        // Остальное — только для авторизованных
        return redirect()->route('login');
    }
}
