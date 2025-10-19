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
        // Add is_featured to categories
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('name');
        });

        // Add sort_code to bankings
        Schema::table('bankings', function (Blueprint $table) {
            $table->string('sort_code')->nullable()->after('account_number');
        });

        // Add pickup_location and pickup_time to generals
        Schema::table('generals', function (Blueprint $table) {
            $table->string('pickup_location')->nullable()->after('location');
            $table->string('pickup_time')->nullable()->after('pickup_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

        Schema::table('bankings', function (Blueprint $table) {
            $table->dropColumn('sort_code');
        });

        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn(['pickup_location', 'pickup_time']);
        });
    }
};
