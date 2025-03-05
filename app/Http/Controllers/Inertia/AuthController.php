<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends BaseController
{
    public function login(): \Inertia\Response
    {
        return Inertia::render('Auth/Login');
    }

    public function register(): \Inertia\Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(UserRegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('companies.index');
    }


    public function auth(UserLoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            return redirect()->route('companies.index');
        } else {
            return back()->withErrors(['email' => 'Пользователь не существует или данные введены неверено']);
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
