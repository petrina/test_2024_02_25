<?php

namespace App\Services;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Models\User;

class BaseUserService
{

    public function checkRole(string $roleName)
    {
        if (session()->get('role')->role_name !== $roleName) {
            throw new ForbiddenException();
        }
    }

    public function getUserByIdOrException(int $id)
    {
        $user = User::where(['id' => $id])->first();
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }
}
