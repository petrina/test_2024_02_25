<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

class UserController extends BaseController
{
    public function __construct(private UserService $userService)
    {
    }

    public function auth(AuthRequest $request)
    {
        $token = $this->userService->getToken($request->login, $request->password);

        $this->jsonResponse(['token' => $token]);
    }

    public function index()
    {
        $this->jsonResponse($this->userService->listUsers());
    }

    public function show(int $id)
    {
        $this->jsonResponse($this->userService->showUser($id));
    }

    public function store(CreateUserRequest $request)
    {
        $this->jsonResponse(
            $this->userService->createUser($request->name, $request->email, $request->password, $request->role_id)
        , 201);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $this->jsonResponse($this->userService->updateUser($id, $request->name, $request->password));
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);
        response('', 204)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->send();
    }
}
