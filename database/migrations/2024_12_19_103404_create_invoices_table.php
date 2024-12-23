<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // Unique invoice number
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade');
            $table->date('invoice_date'); // Date when the invoice was issued
            $table->decimal('total_amount', 10, 2); // Total invoice amount
            $table->enum('status', ['unpaid', 'paid', 'partially_paid', 'overdue', 'canceled'])->default('unpaid'); // Invoice status
            $table->decimal('paid_amount', 10, 2)->default(0.00); // Amount paid
            $table->string('currency', 3)->default('USD'); // ISO currency code
            $table->date('due_date');
            $table->text('notes')->nullable(); // Optional notes
            
            //TODO the following might be removed in the future
            $table->json('line_items'); // Line items (products/services) as JSON
            $table->string('payment_method')->nullable(); // Payment method, e.g., "Credit Card", "Cash"
            $table->string('billing_address')->nullable(); // Billing address
            $table->string('shipping_address')->nullable(); // Shipping address if applicable
            $table->boolean('is_taxable')->default(true); // Flag to indicate if tax applies
            $table->decimal('tax_amount', 10, 2)->default(0.00); // Tax amount
            $table->decimal('discount_amount', 10, 2)->default(0.00); // Discount amount
            $table->string('reference')->nullable(); // External reference or order ID

            $table->timestamps();
            $table->softDeletes(); // Optional soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
