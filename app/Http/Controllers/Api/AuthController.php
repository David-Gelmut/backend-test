<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::create($data);
        Auth::login($user);
        return response()->json([
            'message' => "Пользователь {$user->name} зарегистрирован",
            'token' => $user->createToken('Token')->plainTextToken
        ], Response::HTTP_CREATED
        );
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (!Auth::attempt($data)) {
            return response()->json('Ошибка авторизации',  Response::HTTP_UNAUTHORIZED);
        } else {
            $authUser = Auth::user();
            return response()->json([
                'message' => 'Пользователь ' . $authUser->name . ' авторизован',
                'token' => $authUser->createToken('Token', ['*'], now()->addDays(7))->plainTextToken
            ], Response::HTTP_OK);
        }
    }
}
