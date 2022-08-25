<?php

use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Http\Controllers\AuthController;
use LaravelCommon\App\Http\Controllers\UserController;

Route::middleware(['controller-after'])->group(function () {
    Route::prefix('api')->group(function () {
        Route::post('/auth/generate_token', [AuthController::class, 'generateToken']);

        Route::middleware(['check-token'])->group(function () {
            Route::get('/users', [UserController::class, 'getAll']);
        });
    });
});
