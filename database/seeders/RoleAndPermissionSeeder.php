<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'remove articles']);
        Permission::create(['name' => 'add articles']);
        Permission::create(['name' => 'edit portfolio']);
        Permission::create(['name' => 'remove portfolio']);
        Permission::create(['name' => 'add portfolio']);
        Permission::create(['name' => 'view messages']);

        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

    }
}
