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
        $productManager1 = Role::create(['name' => 'Product Manager', 'organization_id' => 2]);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-customer',
            'edit-customer',
            'delete-customer',
            'create-patient',
            'edit-patient',
            'delete-patient',
            'create-patient-visit',
            'edit-patient-visit',
            'delete-patient-visit',
            'create-invoice',
            'edit-invoice',
            'delete-invoice',
        ]);

        $admin1->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-customer',
            'edit-customer',
            'delete-customer',
            'create-patient',
            'edit-patient',
            'delete-patient',
            'create-patient-visit',
            'edit-patient-visit',
            'delete-patient-visit',
            'create-invoice',
            'edit-invoice',
            'delete-invoice',
        ]);

        // $productManager->givePermissionTo([
        //     'create-product',
        //     'edit-product',
        //     'delete-product'
        // ]);

        // $productManager1->givePermissionTo([
        //     'create-product',
        //     'edit-product',
        //     'delete-product'
        // ]);
    }
}
