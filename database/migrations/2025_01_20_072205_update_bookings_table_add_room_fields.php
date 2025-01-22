<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        // Add room_id column first
        $table->unsignedBigInteger('room_id')->nullable()->after('guest_id'); // Allow NULL temporarily

        // Add total_adults and total_children fields
        $table->integer('total_adults')->default(0)->after('room_id');
        $table->integer('total_children')->default(0)->after('total_adults');
    });

    // Populate room_id with NULL or default values if necessary
    DB::table('bookings')->whereNotIn('room_id', function ($query) {
        $query->select('id')->from('rooms');
    })->update(['room_id' => null]); // Set invalid room_id values to NULL

    Schema::table('bookings', function (Blueprint $table) {
        // Add the foreign key constraint
        $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the foreign key and the added columns
            $table->dropForeign(['room_id']);
            $table->dropColumn(['room_id', 'total_adults', 'total_children']);
        });
    }
};
