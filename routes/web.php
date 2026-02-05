<?php

use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/debug-php', function () {
    return phpinfo();
});
Route::get('logs', [LogViewerController::class, 'index'])->name('logadmin');
