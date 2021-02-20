<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

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
    public static function success(string $message, $data, int $httpCode = 200): JsonResponse
    {
        return response()->json([
            'code' => $httpCode,
            'message' => $message,
            'data' => $data,
        ], $httpCode);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function warning(string $message, $data, int $httpCode = 400): JsonResponse
    {
        return response()->json([
            'code' => $httpCode,
            'message' => $message,
            'data' => $data,
        ], $httpCode);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function error(string $message, $data, int $httpCode = 500): JsonResponse
    {
        return response()->json([
            'code' => $httpCode,
            'message' => $message,
            'data' => $data,
        ], $httpCode);
    }
}
