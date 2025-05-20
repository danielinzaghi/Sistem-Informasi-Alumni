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
            $table->enum('status_saat_ini', ['Bekerja', 'Belum bekerja', 'Wiraswasta', 'Melanjutkan Pendidikan', 'Mencari kerja'])->nullable()->change();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracer_study', function (Blueprint $table) {
            // Kembalikan jadi NOT NULL
            $table->enum('status_saat_ini', [
                'Bekerja', 
                'Belum bekerja', 
                'Wiraswasta', 
                'Melanjutkan Pendidikan', 
                'Mencari kerja'
            ])->nullable(false)->change();
        });
    }
};
