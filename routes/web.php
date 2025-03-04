<?php

use Illuminate\Support\Facades\Route;

Route::get('/login',[\App\Http\Controllers\Inretia\AuthController::class,'login'])->name('login');
Route::get('/register',[\App\Http\Controllers\Inretia\AuthController::class,'register'])->name('register');
