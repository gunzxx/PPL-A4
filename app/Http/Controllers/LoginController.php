<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login',[
            "title" => "Login",
            'css'=>['login']
        ]);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        else{
            dd($validate);
            return redirect()->back()->with('loginError',"Login gagal");
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
