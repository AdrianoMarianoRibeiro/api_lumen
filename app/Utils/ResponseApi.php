<?php

namespace App\Utils;

/**
 * ResponseApi
 */
abstract class ResponseApi
{
    public static function success(string $message = "Ação realizada com sucesso", $data, $httpCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpCode);
    }

    public static function warning(string $message = "Não foi possível executar essa operação", $data, $httpCode = 400)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpCode);
    }

    public static function error($message = "Não foi possível executar essa operação", $data, $httpCode = 500)
    {
        return response()->json([
            'message' => $message,
            'dara' => $data,
        ], $httpCode);
    }
}
