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
        Schema::create('payments', function (Blueprint $table) {
            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade'); // Foreign key to the guests table
            $table->integer('amount'); // Amount in cents (e.g., 1000 for $10.00)
            $table->string('payment_intent_id'); // Stripe PaymentIntent ID
            $table->string('status'); // Payment status (e.g., succeeded, failed)
            $table->string('currency'); // Currency (e.g., USD)
            $table->string('payment_method'); // Payment method (e.g., card)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
