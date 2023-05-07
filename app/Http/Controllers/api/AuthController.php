<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        if(!$request->post('email') || !$request->post('password')){
            return response()->json(["message"=>"Data tidak lengkap!"],404);
        }

        $email = $request->post('email');
        $password = $request->post('password');
        $token = Auth::guard("api")->attempt(['email' => $email, 'password' => $password]);
        // $token = Auth::attempt(['email' => $email, 'password' => $password]);
        if($token == false){
            return response()->json(["message"=>"Autentikasi gagal!","status"=>false],401);
        }

        return response()->json(["status"=>true,"message"=>"Autentikasi berhasil!","token"=>$token]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
