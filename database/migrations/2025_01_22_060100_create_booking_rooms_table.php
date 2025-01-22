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
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('booking_id'); // Foreign key to bookings
            $table->unsignedBigInteger('room_id'); // Foreign key to rooms
            $table->integer('total_adults'); // Number of adults
            $table->integer('total_children'); // Number of children
            $table->timestamps(); // Created at and updated at timestamps

            // Add foreign key constraints
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rooms');
    }
};
