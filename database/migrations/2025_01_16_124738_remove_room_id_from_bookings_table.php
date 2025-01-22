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
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the room_id column
            $table->dropForeign(['room_id']); // Use the column name as an array

            // Drop the room_id column
            $table->dropColumn('room_id');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add the room_id column back
            $table->unsignedBigInteger('room_id')->after('guest_id');

            // Re-add the foreign key constraint
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }
};
