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
        Schema::create('pendidikan_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracer_study_id')->constrained('tracer_study')->onDelete('cascade');
            $table->enum('sumber_biaya_studi', ['Biaya Sendiri', 'Beasiswa'])->nullable();
            $table->string('universitas_lanjut', 255)->nullable();
            $table->string('program_studi_lanjut', 255)->nullable();
            $table->date('tanggal_masuk_lanjut')->nullable();
            $table->enum('hubungan_studi_pekerjaan', ['Sangat Erat', 'Erat', 'Cukup Erat', 'Kurang Erat', 'Tidak Sama Sekali'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_lanjuts');
    }
};
