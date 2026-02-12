<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthenticationController::class, 'index'])->name('login');
Route::post('authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/debug-php', function () {
    return phpinfo();
});
Route::get('logs', [LogViewerController::class, 'index'])->name('logadmin');
