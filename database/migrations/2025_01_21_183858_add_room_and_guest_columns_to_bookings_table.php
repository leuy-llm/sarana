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
        Schema::table('bookings', function (Blueprint $table) {
            // Add the new columns
            $table->unsignedBigInteger('room_id')->nullable(); // Assuming 'rooms' table id is unsignedBigInteger
            $table->integer('total_children')->nullable();
            $table->integer('total_adults')->nullable();
    
            // Add the foreign key constraint
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Remove the foreign key constraint and columns if necessary
            $table->dropForeign(['room_id']);
            $table->dropColumn(['room_id', 'total_children', 'total_adults']);
        });
    }
};
