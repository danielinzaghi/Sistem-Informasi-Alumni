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
        Schema::table('wirausahas', function (Blueprint $table) {
            $table->string('omzet_per_bulan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wirausahas', function (Blueprint $table) {
            $table->decimal('omzet_per_bulan', 15, 2)->change(); 
        });
    }
};
