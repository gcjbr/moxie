<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedspaServicesController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('medspas')->group(function () {
        Route::post('{medspa}/appointments', [AppointmentController::class, 'store']);
        Route::get('{medspa}/services', MedspaServicesController::class);

    });

    Route::prefix('services')->group(function () {
        Route::get('{service}', [ServiceController::class, 'show']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::put('/{service}', [ServiceController::class, 'update']);
    });

    Route::prefix('appointments')->group(function () {
        Route::get('/', [AppointmentController::class, 'index']);
        Route::get('{appointment}', [AppointmentController::class, 'show']);
        Route::patch('{appointment}', [AppointmentController::class, 'update']);
    });

});
