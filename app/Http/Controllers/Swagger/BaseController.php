<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Info (
 *      title="Doc API",
 *      version="1.0.0"
 * ),
 * @OA\PathItem (
 *     path="/"
 * ),
 * @OA\Components (
 *     @OA\SecurityScheme (
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer"
 *     )
 * )
 */
class BaseController extends Controller
{
    //
}
