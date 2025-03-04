<?php

use Illuminate\Support\Facades\Route;

Route::post('/register',[\App\Http\Controllers\Api\AuthController::class,'register'])->name('register');
Route::post('/login',[\App\Http\Controllers\Api\AuthController::class,'login'])->name('login');

Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('/companies',[\App\Http\Controllers\Api\CompanyController::class,'store'])->name('companies.create');
    Route::get('/companies',[\App\Http\Controllers\Api\CompanyController::class,'index'])->name('companies.index');
});

