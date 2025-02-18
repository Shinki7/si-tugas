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
        Schema::create('tugas_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained()->onDelete('cascade');
        $table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');
        $table->decimal('nilai', 5, 2)->nullable(); // Misalnya nilai dalam skala 0-100
        $table->text('catatan')->nullable(); // Untuk feedback dari dosen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_nilai');
    }
};
