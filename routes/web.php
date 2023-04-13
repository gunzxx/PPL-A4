<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {return view('landing');})->name("landing");

// Route untuk role petani
Route::middleware(['auth','role:petani'])->group(function(){
    Route::get('/petani/partners/', [PartnerController::class,'showPartner']);
    Route::get('/petani/partners/partners', [PartnerController::class,'showPartner']);
    Route::get('/petani/partners/create', [PartnerController::class,'create']);

    Route::get('/petani/shop', [ShopController::class,'index']);
});

// Route untuk role pengelola
Route::middleware(['auth','role:pengelola'])->group(function(){
    
    
    Route::get('/pengelola/shop', [ShopController::class,'index']);
});

// Route untuk semua role
Route::middleware('auth')->group(function(){
    // Route home
    Route::get('/home', [HomeController::class,'showHome']);
    Route::get('/pengelola/home', [HomeController::class,'showHome']);
    Route::get('/petani/home', [HomeController::class,'showHome']);

    // Route kerja sama
    Route::get('/partners', [PartnerController::class, 'showPartner']);
    Route::get('/partners/partners', [PartnerController::class, 'showPartner']);
    Route::get('/partners/create', [PartnerController::class, 'create']);
    Route::post('/partners/create', [PartnerController::class, 'store']);
    Route::get('/partners/edit', function(){return redirect('/partners');});
    Route::get('/partners/edit/{partner}', [PartnerController::class, 'edit']);
    Route::post('/partners/edit', [PartnerController::class, 'update']);
    
    // Route Penawaran
    Route::get('/partners/offers', [PartnerController::class, 'showPartner']);

    // Route inventory
    Route::get('/inventory', [InventoryController::class,'showInventory']);
    Route::get('/inventory/home', [InventoryController::class,'showInventory']);
    Route::get('/inventory/create', [InventoryController::class,'create']);
    Route::post('/inventory/create', [InventoryController::class,'store']);
    Route::get('/inventory/update', [InventoryController::class,'manage']);
    Route::post('/inventory/update', [InventoryController::class,'update']);
    Route::get('/inventory/update/{inventory}', [InventoryController::class,'edit']);

    // Route logout
    Route::get('/logout', [LoginController::class,'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [LoginController::class,'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class,'index']);
    Route::post('/register', [RegisterController::class,'register']);
});
