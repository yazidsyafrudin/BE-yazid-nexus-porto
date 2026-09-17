<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->text('logo')->nullable()->change();
        });

        Schema::table('education', function (Blueprint $table) {
            $table->text('logo')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('logo', 255)->nullable()->change();
        });

        Schema::table('education', function (Blueprint $table) {
            $table->string('logo', 255)->nullable()->change();
        });
    }
};
