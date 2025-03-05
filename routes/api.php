<?php

use Illuminate\Support\Facades\Route;

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/companies', [\App\Http\Controllers\Api\CompanyController::class, 'store']);
    Route::get('/companies', [\App\Http\Controllers\Api\CompanyController::class, 'index']);
});

