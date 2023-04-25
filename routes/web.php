<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetaniShopController;
use App\Http\Controllers\PetaniOfferController;
use App\Http\Controllers\PengelolaShopController;
use App\Http\Controllers\PengelolaOfferController;
use App\Http\Controllers\PetaniInventoryController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PetaniAgreementsController;
use App\Http\Controllers\PengelolaInventoryController;
use App\Http\Controllers\PengelolaAgreementsController;
use App\Http\Controllers\PengelolaPartnerHistoryController;

Route::get('/', function () {return view('landing');})->name("landing");
Route::get("/tes-media",function(){
    // $user =  User::find(1)->getMedia("profile")->each->delete();
    // return view("tes",compact('user'));
    return view("tes");
});
Route::post('/tes-media',function(Request $request){
    $request->validate([
        'image' => 'mimes:jpg,png,jpeg'
    ]);
    $user = User::find(1);
    $user->addMediaFromRequest("image")->toMediaCollection('profile');
    return back();
});

// Route guest
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class,'showRegister']);
    Route::post('/register', [AuthController::class,'register']);
});

// Route untuk semua role
Route::middleware('auth')->group(function(){
    // Route home
    Route::get('/home',function(){return redirect("/".auth()->user()->getRoleNames()[0]."/home");});
    Route::get("/pengelola/home", [HomeController::class,"showHome"]);
    Route::get("/petani/home", [HomeController::class,'showHome']);

    // Route logout
    Route::get('/logout', [AuthController::class,'logout']);
});


// Route untuk role petani
Route::middleware(['auth','role:petani'])->group(function(){
    // Penawaran
    Route::get('/petani/partners', function(){return redirect('/petani/partners/offers');});
    Route::get('/petani/partners/offers', [PetaniOfferController::class,'showOffers']);
    Route::get('/petani/partners/offers/create/{partner}', [PetaniOfferController::class,'createOffers']);
    Route::post('/petani/partners/offers/create', [PetaniOfferController::class,'saveOffers']);
    Route::get('/petani/partners/offers/edit/{detail_id}', [PetaniOfferController::class,'editOffers']);
    Route::post('/petani/partners/offers/update', [PetaniOfferController::class,'updateOffers']);

    // Persetujuan
    Route::get('/petani/partners/agreements', [PetaniAgreementsController::class,'showAgreements']);

    // Route jual beli
    Route::get('/petani/shop', function(){return redirect('/petani/shop/shop');});
    Route::get('/petani/shop/shop', [PetaniShopController::class,'index']);

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
    // Kerja sana
    Route::get('/pengelola/partners', function(){return redirect('/pengelola/partners/partners');});
    Route::get('/pengelola/partners/partners', [PengelolaPartnerController::class, 'showPartner']);
    Route::get('/pengelola/partners/partners/create', [PengelolaPartnerController::class, 'create']);
    Route::post('/pengelola/partners/partners/create', [PengelolaPartnerController::class, 'store']);
    Route::get('/pengelola/partners/partners/edit', function(){return redirect('/pengelola/partners/partners');});
    Route::get('/pengelola/partners/partners/edit/{partner}', [PengelolaPartnerController::class, 'edit']);
    Route::post('/pengelola/partners/partners/edit', [PengelolaPartnerController::class, 'update']);
    
    // Penawaran
    Route::get('/pengelola/partners/offers', [PengelolaOfferController::class, 'showOffers']);

    // Riwayat
    Route::get("/pengelola/partners/history", [PengelolaPartnerHistoryController::class, 'index']);

    // Persetujuan
    Route::get('/pengelola/partners/agreements', [PengelolaAgreementsController::class, 'showAgreements']);
    Route::get('/pengelola/partners/agreements/create', [PengelolaAgreementsController::class, 'createAgreements']);
    Route::post('/pengelola/partners/agreements/create', [PengelolaAgreementsController::class, 'saveAgreements']);
    Route::get('/pengelola/partners/agreements/edit/{agreementDetailId}', [PengelolaAgreementsController::class, 'editAgreements']);
    Route::post('/pengelola/partners/agreements/edit', [PengelolaAgreementsController::class, 'updateAgreements']);

    // Jual beli
    Route::get('/pengelola/shop', function(){return redirect('/pengelola/shop/shop');});
    Route::get('/pengelola/shop/shop', [PengelolaShopController::class,'index']);

    // Route inventory
    Route::get('/pengelola/inventory', [PengelolaInventoryController::class, 'showInventory']);
    Route::get('/pengelola/inventory/home', [PengelolaInventoryController::class, 'showInventory']);
    Route::get('/pengelola/inventory/create', [PengelolaInventoryController::class, 'create']);
    Route::post('/pengelola/inventory/create', [PengelolaInventoryController::class, 'store']);
    Route::get('/pengelola/inventory/update', [PengelolaInventoryController::class, 'manage']);
    Route::post('/pengelola/inventory/update', [PengelolaInventoryController::class, 'update']);
    Route::get('/pengelola/inventory/update/{inventory}', [PengelolaInventoryController::class, 'edit']);
});

