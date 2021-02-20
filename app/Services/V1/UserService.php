<?php

namespace App\Services\V1;

use App\Factories\PersonFactory;
use App\Factories\PhysicalPersonFactory;
use App\Models\User;
use App\Services\ServiceInterface;
use App\Utils\ResponseApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class UserService
 * @package App\Services\V1
 */
abstract class UserService implements ServiceInterface
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function save(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
            $person = PersonFactory::build();
            $person->id = $data['id'];
            $person->name = $data['name'];
            $person->save();

            if (strlen($person->id) === 11) {
                $physicalPerson = PhysicalPersonFactory::build();
                $physicalPerson->person_id = $data['person_id'];
                $physicalPerson->save();
            }
                DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function update(array $data): JsonResponse
    {
        // TODO: Implement update() method.
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public static function delete(string $id): JsonResponse
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public static function findById(string $id): JsonResponse
    {
        try {
            $user = User::where('person_id', $id)->first();
            return ResponseApi::success('Detalhes do usuário', $user);
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }

    /**
     * @return JsonResponse
     */
    public static function all(): JsonResponse
    {
        try {
            return ResponseApi::success('Lista de usuarios', User::all());
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }
}
