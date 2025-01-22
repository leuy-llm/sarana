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
            // Drop the columns
            $table->dropColumn('total_adults');
            $table->dropColumn('total_children');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add the columns back (if needed for rollback)
            $table->integer('total_adults')->default(0);
            $table->integer('total_children')->default(0);
        });
    }
};
