<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PetaniOfferController;
use App\Http\Controllers\PengelolaOfferController;
use App\Http\Controllers\PetaniInventoryController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PengelolaInventoryController;
use App\Http\Controllers\PengelolaAgreementsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route inventory all
Route::post('/petani/inventory/delete', [PetaniInventoryController::class, 'delete']);
Route::post('/pengelola/inventory/delete', [PengelolaInventoryController::class, 'delete']);

// Route partner pengelola
Route::post('/pengelola/partners/stop', [PengelolaPartnerController::class, 'stop']);
Route::post('/pengelola/partners/delete', [PengelolaPartnerController::class, 'delete']);

// Route offer petani
Route::post('/petani/offers/cancel', [PetaniOfferController::class, 'cancelOffers']);
// Route offer pengelola
Route::post('/pengelola/offers/confirm', [PengelolaOfferController::class, 'confirmOffers']);
Route::post('/pengelola/offers/cancel', [PengelolaOfferController::class, 'rejectOffers']);

// Route agreements
Route::post('/pengelola/agreements/delete', [PengelolaAgreementsController::class, 'deleteAgreements']);

Route::post('/petani/agreements/delete', [PengelolaAgreementsController::class, 'deleteAgreements']);
Route::post('/petani/agreements/confirm', [PengelolaAgreementsController::class, 'confirmAgreements']);

