<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return  redirect()->route('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [\App\Http\Controllers\Inertia\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Inertia\AuthController::class, 'auth'])->name('auth');
    Route::get('/register', [\App\Http\Controllers\Inertia\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Inertia\AuthController::class, 'store'])->name('store');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/companies', [\App\Http\Controllers\Inertia\CompanyController::class, 'index'])->name('companies.index');
    Route::post('/companies', [\App\Http\Controllers\Inertia\CompanyController::class, 'store'])->name('companies.store');
    Route::get('/search', [\App\Http\Controllers\Inertia\CompanyController::class, 'search'])->name('companies.search');
    Route::get('/logout', [\App\Http\Controllers\Inertia\AuthController::class, 'logout'])->name('logout');
});



