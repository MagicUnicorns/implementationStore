<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Invoice;
use App\Models\Customer;

use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define customer-organization mappings
        $customerOrganizations = [
            1 => 1,  // Customer 1 -> Organization 1
            2 => 2,  // Customer 2 -> Organization 2
            3 => 1,  // Customer 3 -> Organization 1
        ];

        foreach ($customerOrganizations as $customerId => $organizationId) {
            Invoice::create([
                'invoice_number' => 'INV-' . strtoupper($faker->unique()->bothify('##??##')),
                'customer_id' => $customerId,
                'organization_id' => $organizationId,
                'invoice_date' => $faker->date(),
                'due_date' => $faker->dateTimeBetween('+5 days', '+1 month')->format('Y-m-d'),
                'total_amount' => $faker->randomFloat(2, 50, 1000),
                'paid_amount' => $faker->randomFloat(2, 0, 500),
                'currency' => 'USD',
                'status' => $faker->randomElement(['unpaid', 'paid', 'partially_paid']),
                'line_items' => json_encode([
                    [
                        'description' => 'Consultation',
                        'quantity' => 1,
                        'price' => 150,
                    ],
                    [
                        'description' => 'Surgery',
                        'quantity' => 1,
                        'price' => 600,
                    ]
                ]),
                'notes' => $faker->sentence(),
                'payment_method' => $faker->randomElement(['Credit Card', 'Cash']),
                'billing_address' => $faker->address,
                'shipping_address' => $faker->optional()->address,
                'is_taxable' => $faker->boolean(70),
                'tax_amount' => $faker->randomFloat(2, 0, 100),
                'discount_amount' => $faker->randomFloat(2, 0, 50),
                'reference' => 'REF-' . $faker->bothify('##??'),
            ]);
        }
    }
}
