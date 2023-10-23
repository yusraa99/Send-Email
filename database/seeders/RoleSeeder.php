<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\UserSeeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::create(['name' => 'admin'])->givePermissionsTo(Permission::all());
        // Role::create(['name' => 'AB']);
        // Role::create(['name' => 'user']);
    }
}
