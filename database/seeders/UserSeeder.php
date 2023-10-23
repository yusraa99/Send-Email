<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $addUser='add user';
        $editUser='edit user';
        $deleteUser='delete user';
        $approveUser='approve user';
        
        $addFund='add fund';
        $editFund='edit fund';
        $deleteFund='delete fund';
        $approveFund='approve fund';


        $viewFund='view fund';
        $viewFundProject='view fund projects';


        // user permissions
        Permission::create(['name'=>$addUser]);
        Permission::create(['name'=>$editUser]);
        Permission::create(['name'=>$deleteUser]);
       

        // fund permissions
        Permission::create(['name'=>$addFund]);
        Permission::create(['name'=>$editFund]);
        Permission::create(['name'=>$deleteFund]);

        // approval permissions
        Permission::create(['name'=>$approveUser]);
        Permission::create(['name'=>$approveFund]);


        Permission::create(['name'=>$viewFund]);
        Permission::create(['name'=>$viewFundProject]);



        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'AB'])->givePermissionTo([
            $addFund,
            $editFund,
            $deleteFund,
        ]);
        Role::create(['name' => 'user'])->givePermissionTo([
            $viewFundProject,
        ]);


    }
}
