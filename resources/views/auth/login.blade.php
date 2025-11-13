@extends('layouts.app')

@section('content')
    <h1>Вход</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="email">Email</label><br>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password">Пароль</label><br>
            <input id="password" type="password" name="password" required>
        </div>

        <button type="submit">Войти</button>
    </form>
@endsection
