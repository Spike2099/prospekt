<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CounterAgent extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'company' => 'required',
            'email' => 'required|email|min:4|max:50',
            'phone' => 'required',
            //'phone' => 'required|numeric|min:11',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.min' => 'E-mail не может быть меньше 4 символов',
            'email.max' => 'E-mail не может быть больше 50 символов',
            'email.required' => 'Укажите актуальный рабочий e-mail',
            'email.email' => 'E-mail должен быть действительным адресом электронной почты',
            'phone.required' => 'Укажите актуальный рабочий номер телефона',
            //'phone.min' => 'Номер телефона не может быть меньше 11 цифр',
            //'phone.numeric' => 'В номере телефона должны быть только цифры'
        ];
    }

}