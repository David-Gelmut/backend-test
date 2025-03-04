<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post   (
 *      path="/api/register",
 *      tags={"User"},
 *      summary="User registration",
 *      description="Registering a user and receiving a token",
 *      @OA\RequestBody (
 *          @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema (
 *                       @OA\Property (property="name",type="string",example="Tom"),
 *                       @OA\Property (property="email",type="string",example="tom@mail.com"),
 *                       @OA\Property (property="password",type="string",example="12345678"),
 *                       @OA\Property (property="password_confirmation",type="string",example="12345678"),
 *                   )
 *               }
 *          )
 *       ),
 *       @OA\Response (
 *           response=201,
 *           description="User created",
 *           @OA\JsonContent(
 *              allOf={
 *                    @OA\Schema (
 *                       @OA\Property (property="success",type="boolean",example="true"),
 *                       @OA\Property (property="data",type="object",
 *                               @OA\Property (property="name",type="string",example="Tom"),
 *                               @OA\Property (property="token",type="string",example="2|cNYrI1xzLYPw7CW56XaTASlTHSCAE1GWwD1x7qoq8b44e56w"),
 *                       ),
 *                       @OA\Property (property="message",type="string",example="User created!"),
 *                    )
 *              }
 *           )
 *        )
 *      ),
 *
 * @OA\Post (
 *     path="/api/login",
 *     tags={"User"},
 *     summary="User authorization",
 *     description="User authorization and obtaining a token",
 *     @OA\RequestBody (
 *         @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema (
 *                      @OA\Property (property="email",type="string",example="tom@mail.com"),
 *                      @OA\Property (property="password",type="string",example="12345678"),
 *                  )
 *              }
 *         )
 *      ),
 *      @OA\Response (
 *          response=200,
 *          description="User logged in",
 *          @OA\JsonContent(
 *             allOf={
 *                   @OA\Schema (
 *                      @OA\Property (property="success",type="boolean",example="true"),
 *                      @OA\Property (property="data",type="object",
 *                          @OA\Property (property="name",type="string",example="Tom"),
 *                          @OA\Property (property="token",type="string",example="2|cNYrI1xzLYPw7CW56XaTASlTHSCAE1GWwD1x7qoq8b44e56w"),
 *                      ),
 *                      @OA\Property (property="message",type="string",example="User logged in!"),
 *                   )
 *             }
 *          )
 *       )
 *     )
 */
class AuthController extends Controller
{
    //
}
