<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\Pengelola\PengelolaHomeController;

Route::get('/', function () {return view('landing');})->name("landing");
// Route::get('/delete', function () {User::find(2)->delete();})->name("landing");

Route::middleware(['auth','role:pengelola'])->group(function(){
    Route::get('/pengelola/home', [PengelolaHomeController::class,'index']);

    Route::get('/pengelola/partners', [PengelolaHomeController::class,'partner']);

    Route::get('/pengelola/shop', [PengelolaHomeController::class,'index']);
    
    Route::get('/pengelola/inventory', [PengelolaHomeController::class,'inventory']);
    Route::get('/pengelola/inventory/create', [PengelolaHomeController::class,'inventory']);
    Route::get('/pengelola/inventory/update', [PengelolaHomeController::class,'inventory']);
});
Route::middleware('auth')->group(function(){
    Route::get('/logout', [LoginController::class,'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [LoginController::class,'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class,'index']);
    Route::post('/register', [RegisterController::class,'register']);
});
