<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
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

        $validate['password']= bcrypt($validate['password']);
        User::create($validate)->assignRole($request->post('role'));
        return redirect('/login')->with('daftar', "User berhasil didaftarkan");
    }
}
