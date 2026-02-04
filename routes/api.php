<?php

use App\Http\Controllers\api\ReservationController;
use App\Http\Controllers\api\WorkspaceController;
use App\Http\Middleware\AddExecutionTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group([
    'middleware' => ['web', AddExecutionTime::class]
], function () {
    Route::group([
        'prefix' => 'reservation',
        'as' => 'reservation.',
    ], function () {
        Route::post('/', [ReservationController::class, 'store']);
        Route::delete('/', [ReservationController::class, 'destroy']);
        Route::patch('/', [ReservationController::class, 'update']);
    });
    Route::group([
        'prefix' => 'location',
        'as' => 'location.',
    ], function () {
        Route::get('/', [WorkspaceController::class, 'getAllLocation']);
        Route::get('/{location_id}/workspace', [WorkspaceController::class, 'getWorkspaceByLocation']);
    });
    Route::group([
        'prefix' => 'workspace',
        'as' => 'workspace.',
    ], function () {
        Route::get('/', [WorkspaceController::class, 'index']);
        Route::get('/{workspace_id}', [WorkspaceController::class, 'show']);
        Route::get('/{workspace_id}/reservation', [ReservationController::class, 'getWorkspaceReservations']);
        Route::get('/{workspace_id}/reservation/{reservation_id}', [ReservationController::class, 'show']);
    });
});
