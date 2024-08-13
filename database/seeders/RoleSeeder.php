<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin', 'organization_id' => 1]);
        Role::create(['name' => 'Super Admin', 'organization_id' => 2]);
        $admin = Role::create(['name' => 'Admin', 'organization_id' => 1]);
        $admin1 = Role::create(['name' => 'Admin', 'organization_id' => 2]);
        $productManager = Role::create(['name' => 'Product Manager', 'organization_id' => 1]);
        $productManager = Role::create(['name' => 'Product Manager', 'organization_id' => 2]);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $admin1->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $productManager->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product'
        ]);
    }
}