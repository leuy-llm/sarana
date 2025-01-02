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
            $table->string('status')->change();
        });

        // Step 2: Update the existing values
        DB::table('bookings')->where('status', 'pending')->update(['status' => 'Pending']);
        DB::table('bookings')->where('status', 'confirmed')->update(['status' => 'Approved']);
        DB::table('bookings')->where('status', 'checked-in')->update(['status' => 'Checked-In']);
        DB::table('bookings')->where('status', 'checked-out')->update(['status' => 'Checked-Out']);
        DB::table('bookings')->where('status', 'cancelled')->update(['status' => 'Cancelled']);

        // Step 3: Change the column back to ENUM with the new values
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status', [
                'Pending',
                'Approved',
                'Checked-In',
                'Checked-Out',
                'Completed',
                'Cancelled'
            ])->default('Pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse to the old enum values
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('status')->change();
        });

        // Step 2: Update the values back to the old enum values
        DB::table('bookings')->where('status', 'Pending')->update(['status' => 'pending']);
        DB::table('bookings')->where('status', 'Approved')->update(['status' => 'confirmed']);
        DB::table('bookings')->where('status', 'Checked-In')->update(['status' => 'checked-in']);
        DB::table('bookings')->where('status', 'Checked-Out')->update(['status' => 'checked-out']);
        DB::table('bookings')->where('status', 'Cancelled')->update(['status' => 'cancelled']);

        // Step 3: Change the column back to the old ENUM
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status', [
                'pending',
                'confirmed',
                'checked-in',
                'checked-out',
                'cancelled'
            ])->default('confirmed')->change();
        });
    }
};
