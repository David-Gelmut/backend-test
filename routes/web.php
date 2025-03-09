<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return !auth()->check()?redirect()->route('login'):redirect()->route('companies.index');
});

Route::get('/', function () {
    return !auth()->check()?redirect()->route('login'):redirect()->route('companies.index');
});

Route::middleware('guest')
    ->controller(\App\Http\Controllers\Inertia\AuthController::class)
    ->group(function () {
    Route::get('/login',  'login')->name('login');
    Route::post('/login',  'auth')->name('auth');
    Route::get('/register',  'register')->name('register');
    Route::post('/register',  'store')->name('store');
});
Route::middleware('auth')
    ->controller(\App\Http\Controllers\Inertia\CompanyController::class)
    ->name('companies.')
    ->group(function () {
        Route::get('/companies', 'index')->name('index');
        Route::post('/companies', 'store')->name('store');
        Route::get('/search', 'search')->name('search');
    });

Route::get('/logout', [\App\Http\Controllers\Inertia\AuthController::class, 'logout'])->middleware('auth')->name('logout');

