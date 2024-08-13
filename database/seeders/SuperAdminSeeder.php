<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization1 = Organization::create([
            'name' => 'testOrg1'
        ]);
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Test1 Tester', 
            'email' => 'test1@test.com',
            'username' => 'test1er',
            'organization_id' => $organization1->id,
            'password' => Hash::make('12345678',)
        ]);
        // session(['team_id' => '1']);
        Log::error('This is an error message.');
        // session(['organization_id' => '2']);
        setPermissionsTeamId($organization1->id);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Test2 Tester', 
            'email' => 'test2@test.com',
            'username' => 'test2er',
            'organization_id' => $organization1->id,
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Test3 Tester', 
            'email' => 'test3@test.com',
            'username' => 'test3er',
            'organization_id' => $organization1->id,
            'password' => Hash::make('12345678')
        ]);
        $productManager->assignRole('Product Manager', $organization1->id);

        /**
         * Create a second organization with an Admin user
         */

        $organization2 = Organization::create([
            'name' => 'testOrg2'
        ]);

        setPermissionsTeamId($organization2->id);

        // Creating Admin User
        $admin = User::create([
            'name' => 'Test22 Tester', 
            'email' => 'test22@test.com',
            'username' => 'test22er',
            'organization_id' => $organization2->id,
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('Admin');
    }
}