<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\ValidationException;


class Password implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $user = User::where('email', $_COOKIE['email'])->first();
        try {
            if($user === null) {
                throw ValidationException::withMessages([
                    'email' => ['Не верно указан e-mail.'],
                ]);
            } else {
                if (! Hash::check($value, $user['password'])) {
                    throw ValidationException::withMessages([
                        'password' => ['Пароль указан не верно.'],
                    ]);
                }
                return true;                
            }
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'password' => [$e->getMessage()],
            ]);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Введёный пароль указан не верно.';
    }
}
