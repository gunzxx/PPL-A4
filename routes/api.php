<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PetaniOfferController;
use App\Http\Controllers\PengelolaOfferController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PengelolaAgreementsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route inventory all
Route::post('/inventory/delete', [InventoryController::class, 'delete']);

// Route partner pengelola
Route::post('/pengelola/partners/delete', [PengelolaPartnerController::class, 'delete']);

// Route offer petani
Route::post('/petani/offers/cancel', [PetaniOfferController::class, 'cancelOffers']);
// Route offer pengelola
Route::post('/pengelola/offers/confirm', [PengelolaOfferController::class, 'confirmOffers']);
Route::post('/pengelola/offers/cancel', [PengelolaOfferController::class, 'cancelOffers']);

// Route agreements
Route::post('/pengelola/agreements/delete', [PengelolaAgreementsController::class, 'deleteAgreements']);

Route::post('/petani/agreements/delete', [PengelolaAgreementsController::class, 'deleteAgreements']);
Route::post('/petani/agreements/confirm', [PengelolaAgreementsController::class, 'confirmAgreements']);

