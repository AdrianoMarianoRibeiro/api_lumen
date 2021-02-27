<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * ResponseApi
 */
abstract class ResponseApi
{
    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function success(string $message, $data, int $httpCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'code' => $httpCode,
            'message' => $message,
            'data' => $data,
        ], $httpCode, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function warning(string $message, $data, int $httpCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'code' => $httpCode,
            'message' => $message,
            'data' => $data,
        ], $httpCode, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function error(string $message, $data, int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'code' => $httpCode,
            'message' => $message,
            'data' => $data,
        ], $httpCode, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
