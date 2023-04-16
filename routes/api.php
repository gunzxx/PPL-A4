<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PetaniPartnerController;
use App\Http\Controllers\PengelolaPartnerController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/inventory/delete', [InventoryController::class, 'delete']);

Route::post('/pengelola/partners/delete', [PengelolaPartnerController::class, 'delete']);

// Route petani
Route::post('/petani/offers', [PetaniPartnerController::class, 'addOffers']);
Route::post('/petani/offers/cancel', [PetaniPartnerController::class, 'cancelOffers']);

