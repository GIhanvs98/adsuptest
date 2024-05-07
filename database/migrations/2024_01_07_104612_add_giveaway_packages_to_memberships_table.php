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
        Schema::table('memberships', function (Blueprint $table) {
            // Set the column as nullable
            $table->json('giveaway_packages')->nullable()->comment('packages listed here will be automatically assigned to a user.');
        });

        // Now, set the default values using a seeder or update existing records.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->dropColumn('giveaway_packages');
        });
    }
};
