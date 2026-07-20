<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds `role_id` and `is_active` columns to the `users` table.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role_id after the name column
            $table->foreignId('role_id')
                  ->nullable()
                  ->after('name')
                  ->constrained('roles')
                  ->onDelete('set null');

            // Add active status after role_id
            $table->boolean('is_active')
                  ->default(true)
                  ->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'is_active']);
        });
    }
};
