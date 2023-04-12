<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {return view('landing');})->name("landing");

Route::middleware(['auth','role:pengelola'])->group(function(){
    
    Route::get('/pengelola/partners/', [PartnerController::class,'index']);
    Route::get('/pengelola/partners/partners', [PartnerController::class,'index']);
    Route::get('/pengelola/partners/create', [PartnerController::class,'create']);
    
    Route::get('/pengelola/shop', [ShopController::class,'index']);
    
});

// Route untuk semua role
Route::middleware('auth')->group(function(){
    Route::get('/pengelola/home', [HomeController::class,'index']);
    Route::get('/petani/home', [HomeController::class,'index']);

    // Route Inventory
    Route::get('/inventory', [InventoryController::class,'index']);
    Route::get('/inventory/home', [InventoryController::class,'index']);
    Route::get('/inventory/create', [InventoryController::class,'create']);
    Route::post('/inventory/create', [InventoryController::class,'store']);
    Route::post('/inventory/update', [InventoryController::class,'update']);
    Route::get('/inventory/update', [InventoryController::class,'manage']);
    Route::get('/inventory/update/{inventory}', [InventoryController::class,'edit']);
    Route::delete('/inventory/delete', [InventoryController::class,'delete']);

    // Route logout
    Route::get('/logout', [LoginController::class,'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [LoginController::class,'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class,'index']);
    Route::post('/register', [RegisterController::class,'register']);
});
