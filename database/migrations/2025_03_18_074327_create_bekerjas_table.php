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
        Schema::create('bekerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracer_study_id')->constrained('tracer_study')->onDelete('cascade');
            $table->integer('waktu_dapat_kerja')->nullable();
            $table->decimal('gaji_bulanan', 10, 2)->nullable();
            $table->string('lokasi_provinsi', 100)->nullable();
            $table->string('lokasi_kota', 100)->nullable();
            $table->string('lokasi_negara', 100)->nullable();
            $table->enum('jenis_perusahaan', ['Instansi Pemerintah', 'Organisasi non-profit', 'Perusahaan Swasta', 'Wiraswasta', 'Lainnya'])->nullable();
            $table->string('jenis_perusahaan_lainnya', 100)->nullable();
            $table->string('nama_perusahaan', 255)->nullable();
            $table->enum('tingkat_perusahaan', ['Lokal', 'Nasional', 'Multinasional'])->nullable();
            $table->enum('tingkat_pendidikan_pekerjaan', ['Setingkat Lebih Tinggi', 'Tingkat yang Sama', 'Setingkat Lebih Rendah', 'Tidak Perlu Pendidikan Tinggi'])->nullable();
            $table->text('alasan_ambil_pekerjaan')->nullable();
            $table->enum('bekerja_di_luar_bidang', ['Ya', 'Tidak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bekerjas');
    }
};
