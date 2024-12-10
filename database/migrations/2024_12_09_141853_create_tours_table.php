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
        Schema::create('tours', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Tour name
            $table->text('description'); // Tour description
            $table->string('image')->nullable(); // Primary image
            $table->decimal('price', 8, 2); // Price of the tour
            $table->string('duration')->nullable(); // Tour duration
            $table->string('location')->nullable(); // Tour location
            $table->boolean('is_featured')->default(false); // Featured flag
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
