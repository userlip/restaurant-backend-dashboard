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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('contact_person');
            $table->string('contact_person_number');
            $table->date('next_payment_date');
            $table->boolean('is_invoice');
            $table->double('agreed_price');
            $table->longText('impressum');
            $table->string('whatsapp_number')->nullable();
            $table->timestamps();

            $table->index(['name', 'email']);
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
