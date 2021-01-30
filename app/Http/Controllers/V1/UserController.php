<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\UserService;
use Illuminate\Http\Request;

/**
 * UserController
 */
class UserController extends Controller
{
    public function index()
    {
        return response()->json(['id' => 1]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
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

    public function all()
    {
        return UserService::findAll();
    }
}
