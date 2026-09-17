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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('logo')->default('💼');
            $table->string('role_id');
            $table->string('role_en');
            $table->string('location_id');
            $table->string('location_en');
            $table->string('period_id');
            $table->string('period_en');
            $table->string('duration_id');
            $table->string('duration_en');
            $table->string('employment_id');
            $table->string('employment_en');
            $table->string('arrangement_id');
            $table->string('arrangement_en');
            $table->json('tasks')->nullable();
            $table->json('learnings')->nullable();
            $table->json('impact')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
