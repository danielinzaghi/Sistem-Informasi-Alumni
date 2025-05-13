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
        Schema::create('tracer_study', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->onDelete('cascade');
            $table->enum('status_saat_ini', ['Bekerja', 'Belum bekerja', 'Wiraswasta', 'Melanjutkan Pendidikan', 'Mencari kerja']);
            $table->integer('waktu_dapat_kerja')->nullable();
            $table->bigInteger('gaji_bulanan')->nullable();
            $table->string('lokasi_provinsi', 100)->nullable();
            $table->string('lokasi_kota', 100)->nullable();
            $table->enum('jenis_perusahaan', ['Instansi Pemerintah', 'Organisasi non-profit', 'Perusahaan Swasta', 'Wiraswasta', 'Lainnya'])->nullable();
            $table->string('jenis_perusahaan_lainnya', 100)->nullable(); //apabila alumni mengisi lainnya pada jenis_perusahaan
            $table->string('nama_perusahaan', 255)->nullable();
            $table->enum('posisi_wirausaha', ['Founder', 'Co-Founder', 'Staff', 'Freelancer'])->nullable(); //apabila alumni memilih wiraswasta pada kolom status saat ini
            $table->enum('tingkat_perusahaan', ['Lokal', 'Nasional', 'Multinasional'])->nullable();
            $table->enum('sumber_biaya_studi', ['Biaya Sendiri', 'Beasiswa'])->nullable(); //apabila alumni mengisi melanjutkan pendidikan pada status saat ini
            $table->string('universitas_lanjut', 255)->nullable(); //apabila alumni mengisi melanjutkan pendidikan pada status saat ini
            $table->string('program_studi_lanjut', 255)->nullable(); //apabila alumni mengisi melanjutkan pendidikan pada status saat ini
            $table->date('tanggal_masuk_lanjut')->nullable(); //apabila alumni mengisi melanjutkan pendidikan pada status saat ini
            $table->enum('hubungan_studi_pekerjaan', ['Sangat Erat', 'Erat', 'Cukup Erat', 'Kurang Erat', 'Tidak Sama Sekali'])->nullable(); //apabila alumni mengisi melanjutkan pendidikan pada status saat ini
            $table->enum('tingkat_pendidikan_pekerjaan', ['Setingkat Lebih Tinggi', 'Tingkat yang Sama', 'Setingkat Lebih Rendah', 'Tidak Perlu Pendidikan Tinggi'])->nullable();
            $table->text('metode_cari_kerja')->nullable();
            $table->integer('jumlah_lamaran')->nullable();
            $table->integer('jumlah_wawancara')->nullable();
            $table->text('alasan_ambil_pekerjaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_study');
    }
};
