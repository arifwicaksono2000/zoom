<?php

use App\Http\Controllers\api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/reservation', [ReservationController::class, 'store']);
Route::delete('/reservation', [ReservationController::class, 'destroy']);
Route::patch('/reservation', [ReservationController::class, 'update']);
Route::get('/workspace/{workspace_id}/reservation/{reservation_id}', [ReservationController::class, 'show']);
