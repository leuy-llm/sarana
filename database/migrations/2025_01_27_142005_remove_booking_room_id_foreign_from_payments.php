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
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'booking_room_id')) {
                $table->dropColumn('booking_room_id');
            }
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Re-add the foreign key constraint
            $table->foreign('booking_room_id')
                ->references('id')
                ->on('booking_rooms')
                ->onDelete('cascade');
        });
    }
};
