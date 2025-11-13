@extends('layouts.app')

@section('content')
    <h1>Регистрация по приглашению</h1>

    <p>Вы регистрируете аккаунт для: <strong>{{ $invitation->email }}</strong></p>

    <form method="POST" action="{{ route('invite.register.post', $token) }}">
        @csrf

        <div>
            <label>Имя</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Пароль</label>
            <input type="password" name="password" required>
            @error('password') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Подтверждение пароля</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Создать аккаунт</button>
    </form>
@endsection
