<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function register(UserRegisterRequest $request): JsonResponse
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
    }
}
