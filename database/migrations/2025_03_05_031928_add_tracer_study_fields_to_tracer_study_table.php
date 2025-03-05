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
        Schema::table('tracer_study', function (Blueprint $table) {
            $table->enum('melamar_pekerjaan', ['Ya', 'Tidak'])->nullable();
            $table->enum('alasan_belum_bekerja', ['Masih mencari pekerjaan yang sesuai', 'Melanjutkan pendidikan', 'Tidak ada lowongan yang cocok', 'Masalah kesehatan', 'Lainnya'])->nullable();
            $table->string('alasan_lainnya')->nullable();
            $table->enum('kendala_mendapat_pekerjaan', ['Tidak Ada Lowongan yang Sesuai', 'Kurangnya Pengalaman Kerja', 'Persyaratan yang Tinggi', 'Lokasi yang Terbatas', 'Lainnya'])->nullable();
            $table->string('kendala_lainnya')->nullable();
            $table->enum('bekerja_di_luar_bidang', ['Ya', 'Tidak'])->nullable();
            $table->enum('aktif_mencari_kerja', ['Ya', 'Tidak'])->nullable();
            $table->enum('mengikuti_pelatihan', ['Ya', 'Tidak'])->nullable();
            $table->string('nama_pelatihan')->nullable();
            $table->string('durasi_pelatihan')->nullable();
            $table->string('sertifikasi_pelatihan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracer_study', function (Blueprint $table) {
            $table->dropColumn([
                'melamar_pekerjaan',
                'alasan_belum_bekerja',
                'alasan_lainnya',
                'kendala_mendapat_pekerjaan',
                'kendala_lainnya',
                'bekerja_di_luar_bidang',
                'aktif_mencari_kerja',
                'mengikuti_pelatihan',
                'nama_pelatihan',
                'durasi_pelatihan',
                'sertifikasi_pelatihan'
            ]);
        });
    }
};
