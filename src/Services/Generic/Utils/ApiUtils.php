<?php


namespace App\Service\Generic\Utils;


use Symfony\Component\HttpFoundation\JsonResponse;

class ApiUtils
{
    static function processJsonResponse($httpCode, $description)
    {
        return new JsonResponse([
            'code' => $httpCode,
            'desc' => $description
        ], $httpCode);
    }
}