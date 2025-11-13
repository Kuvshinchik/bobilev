@extends('layouts.app')

@section('content')
    <h1>Приглашения</h1>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('invitations.store') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Создать приглашение</button>
    </form>

    <h2>Список приглашений</h2>

    <ul>
        @foreach ($invitations as $inv)
            <li>
                {{ $inv->email }} |
                {{ $inv->used ? 'Использовано' : 'Активно' }} |
                @if(!$inv->used)
                    Ссылка: {{ route('invite.register', $inv->token) }}
                @endif
            </li>
        @endforeach
    </ul>

    {{ $invitations->links() }}
@endsection
