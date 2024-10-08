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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('full_name')->nullable()->after('name');
            $table->string('gender')->nullable()->after('full_name');
            $table->date('DateOfBirth')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('DateOfBirth');
            $table->text('address')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['full_name', 'gender', 'DateOfBirth', 'phone', 'address']);
        });
    }
};
