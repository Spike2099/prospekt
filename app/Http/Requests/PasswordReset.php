<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordReset extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'email.exists'   => 'E-mail указан не верно',
            'email.required' => 'Укажите ваш E-mail',
            'email.email'    => 'E-mail должен быть действительным адресом электронной почты',
            'email.exists'   => 'Мы не можем найти пользователя с таким адресом электронной почты.',
            'token.required' => 'Отсутствует токен авторизации!',
            'password.min'   => 'Минимальное количество у пароля :min символов',
            'password.required' => 'Напишите новый пароль',
            'password_confirmation.required' => 'Подтвердите новый пароль',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
