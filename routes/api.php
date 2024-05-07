<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedspaServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('medspas')->group(function () {
        Route::post('{medspa}/appointments', [AppointmentController::class, 'store']);
        Route::get('{medspa}/services', MedspaServicesController::class);

    });

});
