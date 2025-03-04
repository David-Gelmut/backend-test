<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get  (
 *      path="/api/companies",
 *      tags={"Company"},
 *      summary="List companies",
 *      description="List of companies of the authorized user",
 *      security={{ "bearerAuth" :{} }},
 *       @OA\Response (
 *           response=200,
 *           description="Getting a list of companies of an authorized user",
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
 *                       @OA\Property (property="message",type="string",example="List of user companies with ID = 1"),
 *                    )
 *              }
 *           )
 *        )
 *      ),
 *
 * @OA\Post (
 *     path="/api/companies",
 *     tags={"Company"},
 *     summary="Create company",
 *     description="Creating a company by INN by an authorized user",
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
 *                      @OA\Property (property="message",type="string",example="A company has been created for a user with ID = 1"),
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
