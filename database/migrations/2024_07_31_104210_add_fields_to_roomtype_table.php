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
        Schema::table('room_types', function (Blueprint $table) {
            //
            $table->text('description')->nullable(); // Adding description field
            $table->integer('max_persons')->nullable(); // Adding max_persons field
            $table->decimal('base_price', 8, 2)->nullable(); // Adding base_price field
            $table->json('amenities')->nullable(); // Adding amenities field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_types', function (Blueprint $table) {
            //
            $table->dropColumn('description');
            $table->dropColumn('max_persons');
            $table->dropColumn('base_price');
            $table->dropColumn('amenities');
        });
    }
};
