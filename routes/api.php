<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PetaniOfferController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route inventory all
Route::post('/inventory/delete', [InventoryController::class, 'delete']);

// Route partner pengelola
Route::post('/pengelola/partners/delete', [PengelolaPartnerController::class, 'delete']);

// Route offer petani
Route::post('/petani/offers/cancel', [PetaniOfferController::class, 'cancelOffers']);

