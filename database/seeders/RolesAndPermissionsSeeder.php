<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Dashboard
            'view dashboard',

            // Categories
            'view categories',
            'manage categories',

            // Suppliers
            'view suppliers',
            'manage suppliers',

            // Products
            'view products',
            'manage products',

            // Stock
            'view stock',
            'manage stock',

            // Users
            'view users',
            'manage users',

            // Reports
            'view reports',
            'export reports',

            // POS
            'access pos',
            'view sales',
            'cancel sales',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Admin - Full access
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        // Manager - Everything except user management
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $managerRole->syncPermissions([
            'view dashboard',
            'view categories',
            'manage categories',
            'view suppliers',
            'manage suppliers',
            'view products',
            'manage products',
            'view stock',
            'manage stock',
            'view reports',
            'export reports',
            'access pos',
            'view sales',
            'cancel sales',
        ]);

        // Staff - Limited access
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $staffRole->syncPermissions([
            'view dashboard',
            'view categories',
            'view suppliers',
            'view products',
            'view stock',
            'manage stock',
            'access pos',
            'view sales',
        ]);
    }
}
