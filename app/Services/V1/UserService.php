<?php

namespace App\Services\V1;

use App\Models\User;
use App\Utils\ResponseApi;
use Throwable;

/**
 * UserService
 */
abstract class UserService
{
    public static function findById(string $id)
    {
        try {
            $user = User::where('person_id', $id)->first();
            return ResponseApi::success('Detalhes do usuário', $user);
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }

    public static function findAll()
    {
        try {
            return ResponseApi::success('Lista de usuarios', User::all());
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }
}
