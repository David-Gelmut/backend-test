<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get  (
 *      path="/api/companies",
 *      tags={"Company"},
 *      summary="Список компаний",
 *      description="Список компаний авторизованного пользователя",
 *      security={{ "bearerAuth" :{} }},
 *       @OA\Response (
 *           response=200,
 *           description="Получение списка компаний авторизованного пользователя",
 *           @OA\JsonContent(
 *              allOf={
 *                    @OA\Schema (
 *                       @OA\Property (property="success",type="boolean",example="true"),
 *                       @OA\Property (property="data",type="array",
 *                          @OA\Items(
 *                              @OA\Property (property="id",type="integer",example="10"),
 *                              @OA\Property (property="inn",type="string",example="7707083893"),
 *                              @OA\Property (property="name",type="string",example="ПАО СБЕРБАНК"),
 *                          ),
 *                       ),
 *                       @OA\Property (property="message",type="string",example="Список компаний пользователя с ID = 1"),
 *                    )
 *              }
 *           )
 *        )
 *      ),
 *
 * @OA\Post (
 *     path="/api/companies",
 *     tags={"Company"},
 *     summary="Создание компании",
 *     description="Создание компании по ИНН авторизованным пользователем",
 *     security={{ "bearerAuth" :{} }},
 *      @OA\RequestBody (
 *         @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema (
 *                      @OA\Property (property="inn",type="string",example="7707083893"),
 *                  )
 *              }
 *         )
 *      ),
 *      @OA\Response (
 *          response=201,
 *          description="Company created",
 *          @OA\JsonContent(
 *             allOf={
 *                   @OA\Schema (
 *                      @OA\Property (property="success",type="boolean",example="true"),
 *                      @OA\Property (property="data",type="object",
 *                          @OA\Property (property="id",type="integer",example="10"),
 *                          @OA\Property (property="inn",type="string",example="7707083893"),
 *                          @OA\Property (property="name",type="string",example="ПАО СБЕРБАНК"),
 *                      ),
 *                      @OA\Property (property="message",type="string",example="Компания была создана для пользователя с ID = 1"),
 *                   )
 *             }
 *          )
 *       )
 *     )
 */
class CompanyController extends Controller
{
    //
}
