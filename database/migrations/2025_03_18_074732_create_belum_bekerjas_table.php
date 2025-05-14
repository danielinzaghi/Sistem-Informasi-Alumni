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
        Schema::create('belum_bekerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracer_study_id')->constrained('tracer_study')->onDelete('cascade');
            $table->enum('alasan_belum_bekerja', ['Masih mencari pekerjaan yang sesuai', 'Melanjutkan pendidikan', 'Tidak ada lowongan yang cocok', 'Masalah kesehatan', 'Lainnya'])->nullable();
            $table->string('alasan_lainnya')->nullable();
            $table->enum('kendala_mendapat_pekerjaan', ['Tidak Ada Lowongan yang Sesuai', 'Kurangnya Pengalaman Kerja', 'Persyaratan yang Tinggi', 'Lokasi yang Terbatas', 'Lainnya'])->nullable();
            $table->string('kendala_lainnya')->nullable();
            $table->enum('mengikuti_pelatihan', ['Ya', 'Tidak'])->nullable();
            $table->string('nama_pelatihan')->nullable();
            $table->string('durasi_pelatihan')->nullable();
            $table->string('sertifikasi_pelatihan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belum_bekerjas');
    }
};
