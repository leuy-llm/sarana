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
        //
        Schema::dropIfExists('booking_rooms');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('room_id');
            $table->integer('total_children')->default(0);
            $table->integer('total_adults')->default(0);
            $table->timestamps();

            // Add foreign keys back if needed in rollback
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }
};
