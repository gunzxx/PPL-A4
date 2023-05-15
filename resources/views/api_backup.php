<?php


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("guest")->group(function () {
    Route::post("/login", [AuthController::class, "login"]);
});

Route::middleware("auth:api")->group(function () {
    Route::get('/users', function () {
        return response()->json(auth()->user());
    });
    Route::get('/logout', function () {
        Auth::guard("api")->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil logout',
        ]);
    });
});



?>