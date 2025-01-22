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
            // Drop the foreign key constraint on room_id
            $table->dropForeign(['room_id']);

            // Drop the room_id column
            $table->dropColumn('room_id');

            // Drop the total_adults and total_children columns
            $table->dropColumn(['total_adults', 'total_children']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Recreate the room_id column
            $table->unsignedBigInteger('room_id')->nullable();

            // Recreate the foreign key constraint
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            // Recreate the total_adults and total_children columns
            $table->integer('total_adults')->nullable();
            $table->integer('total_children')->nullable();
        });
    }
};
