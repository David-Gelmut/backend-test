<?php

namespace App\Http\Controllers\Inretia;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends BaseController
{

    public function login(): \Inertia\Response
    {
        return Inertia::render('Auth/Login',['title'=>'Login']);
    }

    public function register(): \Inertia\Response
    {
        return Inertia::render('Auth/Register',['title'=>'Register']);
    }

    /*public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::create($data);
        Auth::login($user);
        return $this->sendResponse([
            'name' => $user->name,
            'token' =>  $user->createToken('Token')->plainTextToken
        ], "User created!", Response::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $authUser = Auth::user();
            return $this->sendResponse([
                'name' => $authUser->name,
                'token' =>  $authUser->createToken('Token')->plainTextToken
            ], "User logged in!", Response::HTTP_OK);
        } else {
            return $this->sendError('Authorization error', [], Response::HTTP_UNAUTHORIZED);
        }
    }*/
}
