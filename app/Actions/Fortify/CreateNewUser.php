<?php

namespace App\Actions\Fortify;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        // Валидация с кастомным правилом для invite_code
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'invite_code' => ['required', 'string'],
        ]);

        $validator->after(function ($validator) use ($input) {
            $invite = Invite::where('code', $input['invite_code'])
                ->where('used', false)
                ->first();

            if (!$invite || ($invite->expires_at && $invite->expires_at->isPast())) {
                $validator->errors()->add('invite_code', 'Неверный, использованный или просроченный код приглашения.');
            }
        });

        $validator->validate();

        // Получаем и маркируем invite как использованный
        $invite = Invite::where('code', $input['invite_code'])->firstOrFail();
        $invite->update(['used' => true]);

        // Создаём пользователя
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'invite_code' => $input['invite_code'], // Опционально для аудита
        ]);

        // Связываем invite с пользователем
        $invite->update(['user_id' => $user->id]);

        return $user;
    }
}