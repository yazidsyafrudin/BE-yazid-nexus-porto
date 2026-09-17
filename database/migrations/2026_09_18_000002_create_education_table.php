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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('logo')->default('🎓');
            $table->string('degree_id');
            $table->string('degree_en');
            $table->string('major_id');
            $table->string('major_en');
            $table->string('gpa')->nullable();
            $table->string('period');
            $table->string('location_id');
            $table->string('location_en');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
