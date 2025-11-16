<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInvitations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // 1. Проверка URL-параметра приглашения:
        // Пример: /register?code=SECRET_INVITE_CODE
        if ($request->has('code') && $request->code === env('MASTER_INVITE_CODE')) {
            return $next($request);
        }

        // 2. ИЛИ проверка, есть ли запись в таблице инвайтов:
        // if ($request->has('token') && Invitation::isValid($request->token)) {
        //     return $next($request);
        // }

        // Если нет кода, перенаправляем на главную или 404
        return redirect('/')->withErrors(['msg' => 'Регистрация только по приглашениям.']);
    }

}
