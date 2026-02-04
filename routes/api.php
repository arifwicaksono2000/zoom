<?php

use App\Http\Controllers\api\ReservationController;
use App\Http\Controllers\api\WorkspaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reservation', [ReservationController::class, 'store']);
    Route::delete('/reservation', [ReservationController::class, 'destroy']);
    Route::patch('/reservation', [ReservationController::class, 'update']);
    Route::get('/workspace/{workspace_id}/reservation/{reservation_id}', [ReservationController::class, 'show']);
});

Route::group([
    'prefix' => 'workspace',
    'as' => 'workspace.',
    'middleware' => 'web'
], function () {
    Route::get('/', [WorkspaceController::class, 'index']);
    Route::get('/{workspace_id}', [WorkspaceController::class, 'show']);
    Route::get('/{workspace_id}/reservation', [ReservationController::class, 'getWorkspaceReservations']);
    Route::get('/location', [WorkspaceController::class, 'getAllLocation']);
    Route::get('/location/{location_id}/workspace', [WorkspaceController::class, 'getWorkspaceByLocation']);
});

// Route::get('/workspace', [WorkspaceController::class, 'index']);
// Route::get('/workspace/all', [WorkspaceController::class, 'getAll']);
// Route::get('/workspace/{workspace_id}', [WorkspaceController::class, 'show']);
// Route::get('/workspace/{workspace_id}/reservation', [ReservationController::class, 'getWorkspaceReservations']);
// Route::get('/location', [WorkspaceController::class, 'getAllLocation']);
// Route::get('/location/{location_id}/workspace', [WorkspaceController::class, 'getWorkspaceByLocation']);
