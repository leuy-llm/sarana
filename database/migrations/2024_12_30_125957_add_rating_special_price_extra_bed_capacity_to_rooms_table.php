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
        Schema::table('rooms', function (Blueprint $table) {
            //
            $table->unsignedDecimal('rating', 3, 2)->nullable()->after('room_size'); // For ratings like 4.5
            $table->unsignedDecimal('special_price', 10, 2)->nullable()->after('price'); // For discounted price
            $table->unsignedTinyInteger('extra_bed_capacity')->default(0)->after('max_person'); // Default to 0 extra beds
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
            $table->dropColumn(['rating', 'special_price', 'extra_bed_capacity']);
        });
    }
};
