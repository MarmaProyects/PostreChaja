<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create_users',
            'edit_users',
            'delete_users',
            'create_products',
            'edit_products',
            'delete_products',
            'create_sections',
            'edit_sections',
            'delete_sections',
            'create_categories',
            'edit_categories',
            'delete_categories',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'create_clients',
            'edit_clients',
            'delete_clients',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName]);
        }
    }
}
