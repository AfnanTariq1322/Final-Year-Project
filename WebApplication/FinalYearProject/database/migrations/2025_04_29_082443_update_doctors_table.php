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
        Schema::table('doctors', function (Blueprint $table) {
            if (!Schema::hasColumn('doctors', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('doctors', 'password')) {
                $table->string('password')->after('email');
            }
            if (!Schema::hasColumn('doctors', 'otp_code')) {
                $table->string('otp_code')->nullable()->after('password');
            }
            if (!Schema::hasColumn('doctors', 'otp_expires_at')) {
                $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            }
            if (!Schema::hasColumn('doctors', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('otp_expires_at');
            }
            if (!Schema::hasColumn('doctors', 'status')) {
                $table->string('status')->default('pending')->after('is_verified');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['name', 'password', 'otp_code', 'otp_expires_at', 'is_verified', 'status']);
        });
    }
};
