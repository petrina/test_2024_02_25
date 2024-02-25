<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'manager'];
        foreach ($roles as $role) {
            $roleEntity = new Role();
            $roleEntity->role_name = $role;
            $roleEntity->save();
        }
    }
}
