<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Method untuk menampilkan view login
     */
    public function showLogin()
    {
        return view('auth.login', [
            "title" => "Login",
            'css' => ['login']
        ]);
    }

    /**
     * Method untuk memvalidasi login
     */
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended(auth()->user()->getRoleNames()[0] . "/home")->with('success','Berhasil login!');
        } else {
            return redirect()->back()->withErrors(['gagal'=> "Email/password salah"])->withInput();
        }
    }

    /**
     * Method untuk logout
     */
    public function logout()
    {
        // Auth::guard("api")->logout();
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Method untuk menampilkan view register
     */
    public function showRegister()
    {
        return view('auth.register', [
            "title" => "Register",
            'css' => ['login']
        ]);
    }

    /**
     * Method untuk validasi register
     */
    public function register(Request $request)
    {
        $validate = $request->validate([
            'fullname' => 'required',
            'id_number' => 'required|numeric',
            'number_phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $validate['password'] = bcrypt($validate['password']);
        $validate['number_phone'] = "+62".$validate['number_phone'];
        // dd($validate['number_phone']);
        User::create($validate)->assignRole($request->post('role'));
        return redirect('/login')->with('success', "User berhasil didaftarkan");
    }
}
