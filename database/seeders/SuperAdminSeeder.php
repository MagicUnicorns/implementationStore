<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = Organization::create([
            'name' => 'testOrg'
        ]);
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Test1 Tester', 
            'email' => 'test1@test.com',
            'username' => 'test1er',
            'organization_id' => $organization->id,
            'password' => Hash::make('12345678')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Test2 Tester', 
            'email' => 'test2@test.com',
            'username' => 'test2er',
            'organization_id' => $organization->id,
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Test3 Tester', 
            'email' => 'test3@test.com',
            'username' => 'test3er',
            'organization_id' => $organization->id,
            'password' => Hash::make('12345678')
        ]);
        $productManager->assignRole('Product Manager');
    }
}