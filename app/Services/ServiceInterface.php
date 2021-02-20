<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

/**
 * Interface ServiceInterface
 * @package App\Services
 */
interface ServiceInterface
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function save(array $data): JsonResponse;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function update(array $data): JsonResponse;

    /**
     * @param string $id
     * @return JsonResponse
     */
    public static function delete(string $id): JsonResponse;

    /**
     * @param string $id
     * @return JsonResponse
     */
    public static function findById(string $id): JsonResponse;

    /**
     * @return JsonResponse
     */
    public static function all(): JsonResponse;
}