<?php

namespace App\Http\Controllers\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Book Store API",
 *     description="API для магазина книг с авторизацией и оплатой",
 *     @OA\Contact(email="your-email@example.com")
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
