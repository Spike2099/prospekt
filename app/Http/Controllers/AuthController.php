<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLogin;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Customer;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUser;
use App\Models\MoySklad;
use Illuminate\Http\Response;


class AuthController extends Controller
{

    public function home()
    {
        return view('index');
    }

    public function reset()
    {
        return view('reset');
    }

    public function Signin()
    {
        return view('signin');
    }

    public function SendMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user) {
            Mail::to($request->email)->send(new NewUser($user));
        }
        return [
            'message' => 'Send post mail get started'
        ];
    }

    public function Sigature(Request $request)
    {
        $customer = Role::where('slug','customer')->first();
        $view     = Permission::where('slug','view')->first();
        // $edit     = Permission::where('slug','edit')->first();
        // $update   = Permission::where('slug','update')->first();
        // $delete   = Permission::where('slug','delete')->first();
        // $create   = Permission::where('slug','create')->first();
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->verified = $request->verified;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach($customer);
        $user->permissions()->attach($view);
        //->sync(array($view, $edit, $update, $delete, $create));
        
        return [
            'message' => 'Success, user created!'
        ];
    }

    public function Customer(Request $request)
    {
        Customer::create($request->all());
        return [
            'message' => 'Success! Contact is added'
        ];
    }

    public function register()
    {
        return view('signup');
    }


    public function login(UserLogin $request)
    {
        $credentials = $request->validate(UserLogin::rules());
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return redirect()->route('signin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin');
        //redirect('/');
    }

}
