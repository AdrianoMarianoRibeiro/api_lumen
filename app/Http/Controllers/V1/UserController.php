<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PostRequest;
use App\Services\V1\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\V1
 */
class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['id' => 1]);
    }

    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return UserService::all();
    }
}
