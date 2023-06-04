<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetaniShopController;
use App\Http\Controllers\PetaniOfferController;
use App\Http\Controllers\PengelolaCartController;
use App\Http\Controllers\PengelolaShopController;
use App\Http\Controllers\PetaniHistoryController;
use App\Http\Controllers\PetaniPaymentController;
use App\Http\Controllers\PengelolaOfferController;
use App\Http\Controllers\PetaniDeliveryController;
use App\Http\Controllers\PetaniInventoryController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PengelolaPaymentController;
use App\Http\Controllers\PetaniAgreementsController;
use App\Http\Controllers\PengelolaDeliveryController;
use App\Http\Controllers\PengelolaInventoryController;
use App\Http\Controllers\PengelolaAgreementsController;
use App\Http\Controllers\PengelolaShopHistoryController;
use App\Http\Controllers\PengelolaPartnerHistoryController;

Route::get('/', fn() => view('landing'))->name("landing");


// Route guest
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class,'showRegister']);
    Route::post('/register', [AuthController::class,'register']);
});


// Route untuk semua role yang ter-autentikasi
Route::middleware('auth')->group(function(){
    // Route home
    Route::get('/home',fn() => redirect("/".auth()->user()->getRoleNames()[0]."/home"));
    Route::get("/pengelola/home", [HomeController::class,"showHome"]);
    Route::get("/petani/home", [HomeController::class,'showHome']);

    // Route premium
    Route::get('/premium', [PremiumController::class,'order']);

    // Route profile
    Route::get('/profile',[ProfileController::class,'index']);
    Route::get('/profile/edit',[ProfileController::class,'edit']);
    Route::post('/profile/edit',[ProfileController::class,'update']);

    // Route logout
    Route::get('/logout', [AuthController::class,'logout']);
});


// Route untuk role petani
Route::middleware(['auth','role:petani'])->group(function(){
    // Penawaran
    Route::get('/petani/partners', fn() => redirect('/petani/partners/offers'));
    Route::get('/petani/partners/offers', [PetaniOfferController::class,'showOffers']);
    Route::get('/petani/partners/offers/create/{partner}', [PetaniOfferController::class,'createOffers']);
    Route::post('/petani/partners/offers/create', [PetaniOfferController::class,'saveOffers']);
    Route::get('/petani/partners/offers/edit/{detail_id}', [PetaniOfferController::class,'editOffers']);
    Route::post('/petani/partners/offers/update', [PetaniOfferController::class,'updateOffers']);

    // Persetujuan
    Route::get('/petani/partners/agreements', [PetaniAgreementsController::class,'showAgreements']);

    // Jual beli
    Route::get('/petani/shop', fn() => redirect('/petani/shop/shop'));
    Route::get('/petani/shop/shop', [PetaniShopController::class,'index']);
    Route::get('/petani/shop/create', [PetaniShopController::class,'create']);
    Route::post('/petani/shop/create', [PetaniShopController::class,'store']);
    Route::get('/petani/shop/update/{item}', [PetaniShopController::class,'edit']);
    Route::post('/petani/shop/update', [PetaniShopController::class,'update']);

    // Pembayaran
    Route::get('/petani/shop/payment', [PetaniPaymentController::class, 'index']);
    Route::get('/petani/shop/payment/{payment_id}', [PetaniPaymentController::class, 'showPay']);
    
    // Pengiriman
    Route::get('/petani/shop/delivery', [PetaniDeliveryController::class,'index']);
    Route::get('/petani/shop/delivery/{delivery_id}', [PetaniDeliveryController::class,'proof']);
    Route::get('/petani/shop/delivery/send/{delivery_id}', [PetaniDeliveryController::class,'send']);
    Route::post('/petani/shop/delivery/send', [PetaniDeliveryController::class,'save']);

    // Riwayat Jual Beli
    Route::get('/petani/shop/history', [PetaniHistoryController::class, 'index']);

    // inventory
    Route::get('/petani/inventory', fn() => redirect("/petani/inventory/inventory"));
    Route::get('/petani/inventory/inventory', [PetaniInventoryController::class, 'showInventory']);
    Route::get('/petani/inventory/create', [PetaniInventoryController::class, 'create']);
    Route::post('/petani/inventory/create', [PetaniInventoryController::class, 'store']);
    Route::post('/petani/inventory/update', [PetaniInventoryController::class, 'update']);
    Route::get('/petani/inventory/update/{inventory}', [PetaniInventoryController::class, 'edit']);
});


// Route untuk role pengelola
Route::middleware(['auth','role:pengelola'])->group(function(){
    // Kerja sana
    Route::get('/pengelola/partners', fn()=> redirect('/pengelola/partners/partners'));
    Route::get('/pengelola/partners/partners', [PengelolaPartnerController::class, 'showPartner']);
    Route::get('/pengelola/partners/partners/create', [PengelolaPartnerController::class, 'create']);
    Route::post('/pengelola/partners/partners/create', [PengelolaPartnerController::class, 'store']);
    Route::get('/pengelola/partners/partners/edit', function(){return redirect('/pengelola/partners/partners');});
    Route::get('/pengelola/partners/partners/edit/{partner_id}', [PengelolaPartnerController::class, 'edit']);
    Route::post('/pengelola/partners/partners/edit', [PengelolaPartnerController::class, 'update']);

    // Riwayat kerja sama
    Route::get("/pengelola/partners/partners/history", [PengelolaPartnerHistoryController::class, 'index']);
    
    // Penawaran
    Route::get('/pengelola/partners/offers', [PengelolaOfferController::class, 'showOffers']);

    // Persetujuan
    Route::get('/pengelola/partners/agreements', [PengelolaAgreementsController::class, 'showAgreements']);
    Route::get('/pengelola/partners/agreements/create', [PengelolaAgreementsController::class, 'createAgreements']);
    Route::post('/pengelola/partners/agreements/create', [PengelolaAgreementsController::class, 'saveAgreements']);
    Route::get('/pengelola/partners/agreements/edit/{agreementDetailId}', [PengelolaAgreementsController::class, 'editAgreements']);
    Route::post('/pengelola/partners/agreements/edit', [PengelolaAgreementsController::class, 'updateAgreements']);

    // Pembelian
    Route::get('/pengelola/shop', fn() => redirect('/pengelola/shop/shop'));
    Route::get('/pengelola/shop/shop', [PengelolaShopController::class,'index']);
    
    // Keranjang
    Route::get('/pengelola/shop/cart', [PengelolaCartController::class,'index']);
    
    // Pembayaran
    Route::get('/pengelola/shop/payment', [PengelolaPaymentController::class,'index']);
    Route::get('/pengelola/shop/payment/{payment_id}', [PengelolaPaymentController::class, 'showPay']);
    Route::get('/pengelola/shop/payment/pay/{payment_id}', [PengelolaPaymentController::class,'pay']);
    Route::post('/pengelola/shop/payment/pay', [PengelolaPaymentController::class,'savePay']);
    
    // Pengiriman
    Route::get('/pengelola/shop/delivery', [PengelolaDeliveryController::class,'index']);
    Route::get('/pengelola/shop/delivery/{delivery_id}', [PengelolaDeliveryController::class,'proof']);
    
    // Riwayat Jual Beli
    Route::get('/pengelola/shop/history', [PengelolaShopHistoryController::class,'index']);

    // Inventory
    Route::get('/pengelola/inventory', fn() => redirect("/pengelola/inventory/inventory"));
    Route::get('/pengelola/inventory/inventory', [PengelolaInventoryController::class, 'showInventory']);
    Route::get('/pengelola/inventory/create', [PengelolaInventoryController::class, 'create']);
    Route::post('/pengelola/inventory/create', [PengelolaInventoryController::class, 'store']);
    Route::post('/pengelola/inventory/update', [PengelolaInventoryController::class, 'update']);
    Route::get('/pengelola/inventory/update/{inventory}', [PengelolaInventoryController::class, 'edit']);
});
