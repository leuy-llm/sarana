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
        Schema::table('user_queries', function (Blueprint $table) {
            //
            $table->tinyInteger('seen')->default(0); // Creates a TINYINT column for seen with a default value of 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_queries', function (Blueprint $table) {
            //
        });
    }
};
