<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Models\Quiz;
use App\Models\User;

class BaseQuizService
{
    public function checkRole(string $roleName)
    {
        if (session()->get('role')->role_name !== $roleName) {
            throw new ForbiddenException();
        }
    }

    public function getQuizByIdOrException(int $id)
    {
        $user = Quiz::where(['id' => $id])->first();
        if (!$user) {
            throw new NotFoundException('Quiz not found');
        }
        return $user;
    }

    public function checkManager(int $userId)
    {
        $user = User::where(['id' => $userId])->first();
        if (!$user) {
            throw new BadRequestException('Manager is undefined');
        }

        if ($user->role->role_name !== 'manager') {
            throw new BadRequestException('Manager is undefined');
        }
    }
}
