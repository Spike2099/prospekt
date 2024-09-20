<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;


class UserLogin extends FormRequest
{

    protected $redirectTo = '/signin';

    public function authorize()
    {
        return true;
    }


    public static function rules()
    {
        return [
            'email' => 'required|email|min:4|max:50|exists:users',
            'password' => ['required', new Password()]
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Логин указан не верно',
            'email.min' => 'Логин не может быть меньше 4 символов',
            'email.max' => 'Логин не может быть больше 50 символов',
            'password.passwordExists' => 'Пароль указан не верно',
            'email.required' => 'Укажите ваш логин',
            'email.email' => 'Логин должен быть действительным адресом электронной почты',
            'password.required' => 'Укажите ваш пароль'
        ];
    }
}
