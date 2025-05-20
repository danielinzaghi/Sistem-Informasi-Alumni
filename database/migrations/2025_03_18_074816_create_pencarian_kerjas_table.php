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
        Schema::create('pencarian_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracer_study_id')->constrained('tracer_study')->onDelete('cascade');
            $table->enum('melamar_pekerjaan', ['Ya', 'Tidak'])->nullable();
            $table->text('metode_cari_kerja')->nullable();
            $table->integer('jumlah_lamaran')->nullable();
            $table->integer('jumlah_wawancara')->nullable();
            $table->enum('aktif_mencari_kerja', ['Ya', 'Tidak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencarian_kerjas');
    }
};
