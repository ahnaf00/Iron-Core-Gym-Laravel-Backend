<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions
        $permissions = [
            'manage members',
            'manage trainers',
            'manage classes',
            'manage pricing',
            'manage blogs',
            'manage messages',
            'manage settings',
            'view dashboard',
        ];

        foreach($permissions as $permission)
        {
            Permission::create(['name'=>$permission]);
        }

        $adminRole = Role::create(['name'=>'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $trainerRole = Role::create(['name'=>'trainer']);
        $trainerRole->givePermissionTo(['manage classes','view dashboard']);
    }
}
