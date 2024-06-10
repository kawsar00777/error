<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // Create roles
            $adminRole = Role::create(['name' => 'admin']);
            $subAdminRole = Role::create(['name' => 'sub_admin']);
            $userRole = Role::create(['name' => 'user']);

            // Define permissions
            $permissions = [
                'manage users',
                'access admin dashboard',
                'access sub_admin dashboard',
                'access user dashboard',
            ];

            // Create permissions
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }

            // Assign permissions to roles
            $adminRole->givePermissionTo(Permission::all());
            $subAdminRole->givePermissionTo(['access sub_admin dashboard', 'access user dashboard']);
            $userRole->givePermissionTo('access user dashboard');
        }
    }
}
