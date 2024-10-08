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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // This creates an unsignedBigInteger primary key
            $table->unsignedBigInteger('room_type_id');
            $table->string('room_number')->unique();
            $table->integer('floor')->nullable();
            $table->enum('status', ['Available', 'Booked', 'Maintenance'])->default('Available');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable(); // Optional price override

            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
