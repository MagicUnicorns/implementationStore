<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;
use App\Models\Patient;
use App\Models\PatientVisit;

use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = Customer::create([
            'first_name' => 'Hans',
            'last_name' => 'Huber',
            'email' => 'Hans.Huber@test.com',
            'phone' => '+4915112345678',
            'address_line1' => 'Huberweg 2',
            'city' => 'Huberhausen',
            'postal_code' => '12345',
            'country' => 'DE',
            'organization_id' => '1',
        ]);

        $patient = Patient::create([
            'gender' => 'male',
            'name' => 'Trixi',
            'customer_id' => $customer->id,
            'organization_id' => '1',
            'date_of_birth' => Carbon::create(2024, 8, 23),
        ]);

        $patient = Patient::create([
            'gender' => 'male',
            'name' => 'Hasi',
            'customer_id' => $customer->id,
            'organization_id' => '1',
            'date_of_birth' => Carbon::create(2024, 5, 11),
        ]);

        $patient = Patient::create([
            'gender' => 'female',
            'name' => 'Hundi',
            'customer_id' => $customer->id,
            'organization_id' => '1',
            'date_of_birth' => Carbon::create(2022, 8, 23),
        ]);

        $customer = Customer::create([
            'first_name' => 'Maria',
            'last_name' => 'Maier',
            'email' => 'Maria.Maier@test.com',
            'phone' => '+4915187654321',
            'address_line1' => 'Meierweg 122',
            'city' => 'Meierhausen',
            'postal_code' => '54321',
            'country' => 'DE',
            'organization_id' => '2',
        ]);

        $patient = Patient::create([
            'gender' => 'male',
            'name' => 'Trixi',
            'customer_id' => $customer->id,
            'organization_id' => '2',
            'date_of_birth' => Carbon::create(2021, 1, 21),
        ]);

        $patient = Patient::create([
            'gender' => 'male',
            'name' => 'Hasi',
            'customer_id' => $customer->id,
            'organization_id' => '2',
            'date_of_birth' => Carbon::create(2019, 5, 11),
        ]);

        $customer = Customer::create([
            'first_name' => 'Max',
            'last_name' => 'Schmid',
            'email' => 'Max.Schmid@test.com',
            'phone' => '+4915112348765',
            'address_line1' => 'Schmidstrasse 122',
            'city' => 'Schmidhausen',
            'postal_code' => '12354',
            'country' => 'DE',
            'organization_id' => '1',
        ]);

        $patient = Patient::create([
            'gender' => 'male',
            'name' => 'Trixi1',
            'customer_id' => $customer->id,
            'organization_id' => '2',
            'date_of_birth' => Carbon::create(2020, 1, 21),
        ]);

        $patient = Patient::create([
            'gender' => 'male',
            'name' => 'Hasi1',
            'customer_id' => $customer->id,
            'organization_id' => '1',
            'date_of_birth' => Carbon::create(1999, 5, 11),
        ]);
    }
}
