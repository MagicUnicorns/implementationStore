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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('title_pre')->nullable();
            $table->string('first_name');
            $table->string('title_mid')->nullable();
            $table->string('last_name');
            $table->string('title_post')->nullable();
            $table->string('email')->nullable(); //we are not allowed to use ->unique() here since the very same customer can be registered twice for different organizations!
            $table->string('phone', 20);
            $table->string('secondary_phone', 20)->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20);
            $table->string('country', 100);
            $table->enum('preferred_contact_method', ['phone', 'mail', 'text'])->nullable();
            $table->text('notes')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            $table->unsignedBigInteger('organization_id')->default(0);
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->index('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
