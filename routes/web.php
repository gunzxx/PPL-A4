<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PetaniPartnerController;
use App\Http\Controllers\PetaniInventoryController;

Route::get('/', function () {return view('landing');})->name("landing");

// Route untuk role petani
Route::middleware(['auth','role:petani'])->group(function(){
    // Route kerja sama
    Route::get('/petani/partners', function(){return redirect('/petani/partners/partners');});
    Route::get('/petani/partners/partners', [PetaniPartnerController::class,'showPartner']);
    Route::get('/petani/partners/partners/detail/{partner}', [PetaniPartnerController::class,'detailPartner']);
    //
    Route::get('/petani/partners/offers', [PetaniPartnerController::class,'showOffers']);
    Route::get('/petani/partners/offers/create/{partner}', [PetaniPartnerController::class,'createOffers']);
    Route::post('/petani/partners/offers/create', [PetaniPartnerController::class,'saveOffers']);
    //
    Route::get('/petani/partners/agreements', [PetaniPartnerController::class,'showAgreements']);

    // Route jual beli
    Route::get('/petani/shop', [ShopController::class,'index']);

    // Route inventory
    Route::get('/petani/inventory', [PetaniInventoryController::class, 'showInventory']);
    Route::get('/petani/inventory/home', [PetaniInventoryController::class, 'showInventory']);
    Route::get('/petani/inventory/create', [PetaniInventoryController::class, 'create']);
    Route::post('/petani/inventory/create', [PetaniInventoryController::class, 'store']);
    Route::get('/petani/inventory/update', [PetaniInventoryController::class, 'manage']);
    Route::post('/petani/inventory/update', [PetaniInventoryController::class, 'update']);
    Route::get('/petani/inventory/update/{inventory}', [PetaniInventoryController::class, 'edit']);
});

// Route untuk role pengelola
Route::middleware(['auth','role:pengelola'])->group(function(){
    Route::get('/pengelola/partners', [PengelolaPartnerController::class, 'showPartner']);
    Route::get('/pengelola/partners/create', [PengelolaPartnerController::class, 'create']);
    Route::post('/pengelola/partners/create', [PengelolaPartnerController::class, 'store']);
    Route::get('/pengelola/partners/edit', function(){return redirect('/partners');});
    Route::get('/pengelola/partners/edit/{partner}', [PengelolaPartnerController::class, 'edit']);
    Route::post('/pengelola/partners/edit', [PengelolaPartnerController::class, 'update']);

    // // Route Penawaran
    Route::get('/pengelola/offers', [PengelolaPartnerController::class, 'showPartner']);

    // Route jual beli
    Route::get('/pengelola/shop', [ShopController::class,'index']);

    // Route inventory
    
});

// Route untuk semua role
Route::middleware('auth')->group(function(){
    // Route home
    // Route::get('/home', [HomeController::class,'showHome']);
    Route::get('/pengelola/home', [HomeController::class,'showHome']);
    Route::get('/petani/home', [HomeController::class,'showHome']);


    // Route logout
    Route::get('/logout', [LoginController::class,'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [LoginController::class,'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class,'index']);
    Route::post('/register', [RegisterController::class,'register']);
});
