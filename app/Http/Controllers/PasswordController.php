<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
//use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PasswordReset as Reset;
use App\Http\Requests\UserReset;
use App\Models\User;


class PasswordController extends Controller
{

    protected $redirectTo = '/';

    public function getEmail()
    {
        return view('forgot-password');
    }

    public function resetPasswordAuth(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'password' => 'required|unique:users|min:8'
        ]);
        User::where('id', $id)->update(['password' => Hash::make($request->input('password'))]);
        return back()->with(['status' => 'Ваш пароль изменён']);
    }

    public function notReset()
    {
        return view('errors.400');
    }

    public function postEmail(UserReset $request)
    {
        $email = $request->input('email');
        $status = Password::sendResetLink($request->only('email'));
        $text = 'Пожалуйста подтвердите свой e-mail адрес';
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Мы отправили ссылку для сброса пароля на '.$email, 'text' => $text])
            : back()->withErrors(['email' => __($status)]);
    }

    public function getReset($token)
    {
        return view('reset', ['token' => $token]);
    }

    public function postReset(Reset $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(30));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('signin')->with(['status' => 'Ваш пароль изменён.'])
                : back()->withErrors(['email' => [__($status)]]);
    }
    
}
