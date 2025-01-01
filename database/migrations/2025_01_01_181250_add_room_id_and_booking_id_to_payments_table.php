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
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();

            // Add foreign key constraints
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            // Then drop the columns
            $table->dropColumn('room_id');
            $table->dropColumn('booking_id');
        });
    }
};
