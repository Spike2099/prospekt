<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class Checkout extends FormRequest
{

    protected $redirectTo = '/order';

    /** 
     * name,
     * phone,
     * email,
     * address,
     * checkout
    */

    public function authorize()
    {
        return true;
    }

    public static function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|min:4|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Напишите имя получателя',
            'phone.required' => 'Без номера телефона мы не сможем обработать ваш заказ',
            'email.min' => 'E-mail не может быть меньше 4 символов',
            'email.max' => 'E-mail не может быть больше 50 символов',
            'email.required' => 'E-mail адрес обязателен',
            'email.email' => 'E-mail должен быть действительным адресом электронной почты',
        ];
    }

}