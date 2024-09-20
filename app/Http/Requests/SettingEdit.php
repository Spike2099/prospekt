<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingEdit extends FormRequest
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
            'legalAddress' => 'required',
            'actualAddress' => 'nullable',
            'email' => 'required|email|min:4|max:50',
            'phone' => 'required|numeric|min:11',
            'delivery' => 'nullable',
            'person' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'legalAddress.required' => 'Укажите адрес вашей компании',
            'email.min' => 'E-mail не может быть меньше 4 символов',
            'email.max' => 'E-mail не может быть больше 50 символов',
            'email.required' => 'Укажите актуальный рабочий e-mail',
            'email.email' => 'E-mail должен быть действительным адресом электронной почты',
            'phone.required' => 'Укажите актуальный рабочий номер телефона',
            'phone.min' => 'Номер телефона не может быть меньше 11 цифр',
            //'phone.max' => 'Номер телефона не может быть больше 14 цифр (возможно лишние пробелы и скобки)',
            'phone.numeric' => 'В номере телефона должны быть только цифры',
            'person.required' => 'Напишите ваше имя'
        ];
    }

}