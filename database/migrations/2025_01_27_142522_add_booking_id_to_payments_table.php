<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add `booking_id` column after `payment_id`
            $table->unsignedBigInteger('booking_id')->nullable()->after('payment_id');


            // Add a foreign key constraint to `bookings` table
            $table->foreign('booking_id')
                ->references('id') // The primary key in the bookings table
                ->on('bookings')
                ->onDelete('cascade'); // Optional: Adjust as per your requirements
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['booking_id']);

            // Drop the `booking_id` column
            $table->dropColumn('booking_id');
        });
    }
};
