<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\PetaniShopController;
use App\Http\Controllers\api\KedelaiController;
use App\Http\Controllers\PetaniOfferController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PengelolaCartController;
use App\Http\Controllers\PetaniPaymentController;
use App\Http\Controllers\PengelolaOfferController;
use App\Http\Controllers\PetaniInventoryController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PetaniAgreementsController;
use App\Http\Controllers\PengelolaDeliveryController;
use App\Http\Controllers\PengelolaInventoryController;
use App\Http\Controllers\PengelolaAgreementsController;

/**
 * Sprint 1 : Kerja sama
 */

// Route inventory petani
Route::post('/petani/inventory/delete', [PetaniInventoryController::class, 'delete']);
// Route inventory pengelola
Route::post('/pengelola/inventory/delete', [PengelolaInventoryController::class, 'delete']);

// Route partner pengelola
Route::post('/pengelola/partners/stop', [PengelolaPartnerController::class, 'stop']);
Route::post('/pengelola/partners/delete', [PengelolaPartnerController::class, 'delete']);

// Route offer petani
Route::post('/petani/offers/cancel', [PetaniOfferController::class, 'cancelOffer']);
Route::post('/petani/offers/delete', [PetaniOfferController::class, 'deleteOffer']);
// Route offer pengelola
Route::post('/pengelola/offers/confirm', [PengelolaOfferController::class, 'confirmOffers']);
Route::post('/pengelola/offers/reject', [PengelolaOfferController::class, 'rejectOffers']);
Route::post('/pengelola/offers/cancel', [PengelolaOfferController::class, 'cancelOffers']);
Route::post('/offerDetail/{id}', [PengelolaOfferController::class, 'single']);

// Route agreements pengelola
Route::post('/pengelola/agreements/cancel', [PengelolaAgreementsController::class, 'cancelAgreements']);
Route::post('/pengelola/agreements/delete', [PengelolaAgreementsController::class, 'deleteAgreements']);
Route::post('/agreementDetail/{id}', [PengelolaAgreementsController::class, 'single']);

// Route agreements petani
Route::post('/petani/agreements/delete', [PetaniAgreementsController::class, 'cancelAgreements']);
Route::post('/petani/agreements/reject', [PetaniAgreementsController::class, 'rejectAgreements']);
Route::post('/petani/agreements/confirm', [PetaniAgreementsController::class, 'confirmAgreements']);

// Route api forecasting data kedelai
Route::get('/kedelai',[KedelaiController::class,'index']);
Route::get('/kedelai/{apiKedelai}',[KedelaiController::class,'show']);


/**
 * Sprint 2 : Jual beli
 */

// Penjualan
Route::post("/petani/item/delete",[PetaniShopController::class,'delete']);

// Keranjang
Route::post("/pengelola/cart/add",[PengelolaCartController::class,'add']);
Route::post("/pengelola/cart/update",[PengelolaCartController::class,'update']);
Route::post("/pengelola/cart/delete",[PengelolaCartController::class,'delete']);

// Pembayaran
Route::post("/pengelola/payment/add",[TransactionController::class,'add']);
Route::post("/pengelola/payment/cancel",[TransactionController::class,'cancel']);

Route::post("/petani/payment/accept",[PetaniPaymentController::class,'accept']);

// Pengiriman
Route::post("/pengelola/delivery/accept",[PengelolaDeliveryController::class,'accept']);

/**
 * Callback untuk premium
 */
Route::post("/premium-callback",[PremiumController::class,'callback']);