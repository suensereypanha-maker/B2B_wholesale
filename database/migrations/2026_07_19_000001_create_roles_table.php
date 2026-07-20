<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the `roles` table.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');                           // e.g. "Super Admin"
            $table->string('slug')->unique();                 // e.g. "super-admin"
            $table->text('description')->nullable();          // Human-readable description
            $table->string('color', 20)->default('#6B7280');  // Hex color for UI badge
            $table->boolean('is_system')->default(false);     // System roles cannot be deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
