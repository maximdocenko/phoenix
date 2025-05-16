<?php

namespace App\Http\Controllers\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Phoenix API",
 *     description="API documentation for Phoenix project"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class ApiInfo
{

}
