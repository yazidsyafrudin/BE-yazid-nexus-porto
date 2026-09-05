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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('image')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('type'); // web, mobile, desktop
            $table->string('category'); // personal, freelance, internship, client
            $table->text('description_id');
            $table->text('description_en');
            $table->json('stack'); // Simpan array stack seperti ["React", "Laravel"]
            $table->json('reactions')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
