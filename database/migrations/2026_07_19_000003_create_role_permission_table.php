<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the `role_permission` pivot table (many-to-many).
     */
    public function up(): void
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->foreignId('role_id')
                  ->constrained('roles')
                  ->onDelete('cascade');

            $table->foreignId('permission_id')
                  ->constrained('permissions')
                  ->onDelete('cascade');

            // Composite primary key — prevent duplicate pairs
            $table->primary(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
