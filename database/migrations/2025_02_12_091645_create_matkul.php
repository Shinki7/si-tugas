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
        Schema::create('matkul', function (Blueprint $table) {
            $table->id();
            $table->string('kd_mk')->unique();
            $table->string('nm_mk');
            $table->string('slug');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('matkul');
    }
};
