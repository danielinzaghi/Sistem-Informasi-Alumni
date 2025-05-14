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
        Schema::create('wirausahas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracer_study_id')->constrained('tracer_study')->onDelete('cascade');
            $table->string('nama_usaha')->nullable();
            $table->string('bidang_usaha')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->integer('jumlah_karyawan')->nullable();
            $table->enum('posisi_wirausaha', ['Founder', 'Co-Founder', 'Staff', 'Freelancer'])->nullable();
            $table->decimal('omzet_per_bulan', 15, 2)->nullable();
            $table->enum('bentuk_usaha', ['PT', 'CV', 'Firma', 'Perorangan', 'Lainnya'])->nullable();
            $table->string('npwp_usaha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wirausahas');
    }
};
