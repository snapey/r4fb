<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        Permission::allPermissions()->each(function($perm){
            Permission::create(['name' => $perm]);
        });

        // create roles and assign created permissions

        $role = Role::create(['name'=>'Super Admin']);

        $role->givePermissionTo(Permission::all());

        Role::create(['name'=>'User']);
        Role::create(['name'=>'Admin']);


        $user = User::create([
            'name'=> 'Mark Novate',
            'email'=>'mark@novate.co.uk',
            'password'=>bcrypt('password')
        ]);

        $user->assignRole('Super Admin');

        User::create([
            'name' => 'Mark Snape',
            'email' => 'mark@snapey.co.uk',
            'password' => bcrypt('password')
        ]);

    }
}