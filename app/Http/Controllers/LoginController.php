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
        return view('login.index',[
            "title" => "Login"
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        if(Auth::attempt([
            "username" => $request->post('username'),
            "password" => $request->post('password'),
        ])){
            return redirect('/login')->with('error',"Login gagal");
        }
    }
}
