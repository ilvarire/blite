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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->boolean('checkout')->default(false);
            $table->boolean('maintenance')->default(false);
            $table->string('location');
            $table->string('email');
            $table->string('phone');
            $table->text('policy');
            $table->text('guide');
            $table->text('about');
            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('tiktok_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
