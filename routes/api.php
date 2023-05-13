<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\KedelaiController;
use App\Http\Controllers\PetaniOfferController;
use App\Http\Controllers\PengelolaOfferController;
use App\Http\Controllers\PetaniInventoryController;
use App\Http\Controllers\PengelolaPartnerController;
use App\Http\Controllers\PetaniAgreementsController;
use App\Http\Controllers\PengelolaInventoryController;
use App\Http\Controllers\PengelolaAgreementsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("guest")->group(function(){
    Route::post("/login",[AuthController::class,"login"]);
});

Route::middleware("auth:api")->group(function(){
    Route::get('/users', function(){return response()->json(auth()->user());});
    Route::get('/logout', function(){ Auth::guard("api")->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil logout',
        ]);});
});


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
// Route agreements petani
Route::post('/petani/agreements/cancel', [PetaniAgreementsController::class, 'cancelAgreements']);
Route::post('/petani/agreements/reject', [PetaniAgreementsController::class, 'rejectAgreements']);
Route::post('/petani/agreements/confirm', [PetaniAgreementsController::class, 'confirmAgreements']);


// Route api forecasting data kedelai
Route::get('/kedelai',[KedelaiController::class,'index']);
Route::get('/kedelai/{apiKedelai}',[KedelaiController::class,'show']);