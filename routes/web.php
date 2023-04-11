<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Pengelola\HomeController;

Route::get('/', function () {return view('landing');})->name("landing");
// Route::get('/delete', function () {User::find(2)->delete();})->name("landing");

Route::middleware(['auth','role:pengelola'])->group(function(){
    Route::get('/pengelola/home', [HomeController::class,'index']);

    Route::get('/pengelola/partners/', [PartnerController::class,'index']);
    Route::get('/pengelola/partners/partners', [PartnerController::class,'index']);
    Route::get('/pengelola/partners/create', [PartnerController::class,'create']);

    Route::get('/pengelola/shop', [ShopController::class,'index']);
    
    Route::get('/pengelola/inventory', [InventoryController::class,'index']);
    Route::get('/pengelola/inventory/home', [InventoryController::class,'index']);
    Route::get('/pengelola/inventory/create', [InventoryController::class,'create']);
    Route::post('/pengelola/inventory/create', [InventoryController::class,'store']);
    Route::post('/pengelola/inventory/update', [InventoryController::class,'update']);
    Route::get('/pengelola/inventory/update', [InventoryController::class,'manage']);
    Route::get('/pengelola/inventory/update/{inventory}', [InventoryController::class,'edit']);
    Route::delete('/pengelola/inventory/delete', [InventoryController::class,'delete']);
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
