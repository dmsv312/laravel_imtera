<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'current']);

    Route::get('/settings', [SettingsController::class, 'show']);
    Route::post('/settings', [SettingsController::class, 'update']);

    Route::get('/summary', [ReviewController::class, 'summary']);
    Route::get('/reviews', [ReviewController::class, 'index']);
});
