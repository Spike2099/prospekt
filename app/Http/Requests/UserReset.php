<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserReset extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users',
        ];
    }

    public function messages()
    {
        return [
            'email.exists'   => 'E-mail указан не верно',
            'email.required' => 'Укажите ваш E-mail',
            'email.email'    => 'E-mail должен быть действительным адресом электронной почты',
            'email.exists'   => 'Мы не можем найти пользователя с таким адресом электронной почты.'
        ];
    }
}
