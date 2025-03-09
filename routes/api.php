<?php

use Illuminate\Support\Facades\Route;

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')
    ->controller(\App\Http\Controllers\Api\CompanyController::class)
    ->group(function () {
        Route::post('/companies', 'store');
        Route::get('/companies', 'index');
    });
