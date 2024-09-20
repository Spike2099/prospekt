<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeContract extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required',
            'action' => 'required',
            'bank' => 'required',
            'rs' => 'required|numeric|min:20',
            'bik' => 'required|numeric|min:9',
            'ks' => 'required|numeric|min:20',
            'email' => 'required|email|min:4|max:50',
            'phone' => 'required' //|numeric|min:11
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите ваше полное ФИО',
            'action.required' => 'Пожалуйста, выберите значение из списка',
            'bank.required' => 'Пожалуйста, укажите название банка',
            'email.min' => 'E-mail не может быть меньше 4 символов',
            'email.max' => 'E-mail не может быть больше 50 символов',
            'email.required' => 'Укажите актуальный рабочий e-mail',
            'email.email' => 'E-mail должен быть действительным адресом электронной почты',
            'rs.required' => 'Укажите номер рассчётного счёта',
            'rs.min' => 'Номер рассчётного счёта не может быть меньше 20 символов',
            'bik.required' => 'Укажите БИК банка',
            'bik.min' => 'БИК банка не может быть меньше 9 символов',
            'ks.required' => 'Укажите номер корр.счёта',
            'ks.min' => 'Номер корр.счёта не может быть меньше 20 символов',
            'rs.numeric' => 'Рассчётный счёт допускаются только цифры',
            'bik.numeric' => 'В БИК должны быть только цифры',
            'ks.numeric' => 'В номере корр.счёта должны быть только цифры',
            'phone.required' => 'Укажите актуальный рабочий номер телефона',
            //'phone.min' => 'Номер телефона не может быть меньше 11 цифр',
            //'phone.numeric' => 'В номере телефона должны быть только цифры'
        ];
    }

}
