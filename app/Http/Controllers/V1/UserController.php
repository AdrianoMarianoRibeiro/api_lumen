<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PostRequest;
use App\Http\Requests\User\PostRequestLegalPerson;
use App\Services\V1\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\V1
 */
class UserController extends Controller
{
    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        return UserService::save($request->all());
    }

    /**
     * @param PostRequestLegalPerson $request
     * @return JsonResponse
     */
    public function storeLegalPerson(PostRequestLegalPerson $request): JsonResponse
    {
        return UserService::save($request->all());
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return UserService::findById($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        return UserService::update($request->all());
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        return UserService::delete($id);
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return UserService::all();
    }

    /**
     * @return JsonResponse
     */
    public function allLegalPerson(): JsonResponse
    {
        return UserService::allLegalPerson();
    }
}
