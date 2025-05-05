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
            // First, drop the existing column
            $table->dropColumn('acute_disease_detected');
            
            // Then add it back as TEXT
            $table->text('acute_disease_detected')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // First, drop the TEXT column
            $table->dropColumn('acute_disease_detected');
            
            // Then add it back as LONGTEXT
            $table->longText('acute_disease_detected')->nullable();
        });
    }
}; 