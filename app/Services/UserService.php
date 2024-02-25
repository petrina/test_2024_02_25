<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ServerErrorException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService extends BaseUserService
{

    public function getToken(string $login, string $password)
    {
        $user = User::whereEmail($login)->first();
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        if (!Hash::check($password, $user->password)) {
            throw new NotFoundException('User not found.');
        }
        $rememberToken = Str::random(60);
        $user->remember_token = $rememberToken;
        $user->save();
        return $rememberToken;
    }

    public function listUsers()
    {
        return User::all();
    }

    public function showUser(int $id)
    {
        return $this->getUserByIdOrException($id);
    }

    public function createUser(string $name, string $email, string $password, int $roleId)
    {
        $this->checkRole('admin');
        $user = User::where(['email' => $email])->first();
        if ($user) {
            throw new BadRequestException('Email already used');
        }
        if (!Role::where(['id' => $roleId])->exists()) {
            throw new BadRequestException('Role is undefined');
        }
        if ($roleId == session()->get('role')->id) {
            throw new BadRequestException('You can not create user with this role');
        }

        try {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role_id = $roleId;
            $user->save();
            return $user;
        } catch (\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }

    public function updateUser(int $userId, string $name, ?string $password)
    {
        $this->checkRole('admin');

        $user = $this->getUserByIdOrException($userId);

        try {
            $user->name = $name;
            if ($password) {
                $user->password = Hash::make($password);
            }
            $user->save();
            return $user;
        } catch(\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }

    public function deleteUser(int $id)
    {
        $this->checkRole('admin');

        $user = $this->getUserByIdOrException($id);
        if ($user->role_id == session()->get('role')->id) {
            throw new BadRequestException('You can not delete user with this role');
        }

        try {
            $user->delete();
            return true;
        } catch (\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }
}
