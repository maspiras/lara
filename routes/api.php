<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIReservationController;
use App\Http\Controllers\Api\APIServiceController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/reservations', APIReservationController::class);
Route::apiResource('/services', APIServiceController::class);