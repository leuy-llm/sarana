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
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->text('address',50);
            $table->string('gmap');
            $table->string('pn1');
            $table->string('pn2');
            $table->string('pn3');
            $table->string('email');
            $table->string('fb');
            $table->string('insta'); 
            $table->string('tele');
            $table->string('tripa');
            $table->string('iframe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_details');
    }
};
