<?php

use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Http\Controllers\AuthController;
use LaravelCommon\App\Http\Controllers\UserController;
use LaravelCommon\App\Http\Middleware\CheckToken;
use LaravelCommon\App\Http\Middleware\ControllerAfter;
use LaravelCommon\App\Http\Middleware\Hydrators\UserHydrator;

Route::middleware([ControllerAfter::NAME])->group(function () {
    Route::prefix('api')->group(function () {
        Route::post('/auth/generate_token', [AuthController::class, 'generateToken']);

        Route::middleware([CheckToken::NAME])->group(function () {
            Route::get('/users', [UserController::class, 'getAll']);
            Route::prefix('user')->group(function () {
                Route::post('', [UserController::class, 'store'])
                    ->middleware(
                        UserHydrator::NAME
                    );
            });
        });

        Route::post('/register-market-organizer', [UserController::class]);
    });
});
