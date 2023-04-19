<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', [
            "title" => "Login",
            'css' => ['login']
        ]);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended(auth()->user()->getRoleNames()[0] . "/home");
        } else {
            // dd($validate);
            return redirect()->back()->withErrors(['gagal'=> "Login gagal"])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegister()
    {
        return view('auth.register', [
            "title" => "Register",
            'css' => ['login']
        ]);
    }

    public function register(Request $request)
    {
        // dd($request->input('role'));
        $validate = $request->validate([
            'fullname' => 'required',
            'id_number' => 'required|numeric',
            'number_phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        // dd($validate);

        $validate['password'] = bcrypt($validate['password']);
        User::create($validate)->assignRole($request->post('role'));
        return redirect('/login')->with('daftar', "User berhasil didaftarkan");
    }
}
