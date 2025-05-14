<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PencarianKerja extends Model
{
    protected $table = 'pencarian_kerjas';

    protected $fillable = [
        'tracer_study_id',
        'melamar_pekerjaan',
        'metode_cari_kerja',
        'jumlah_lamaran',
        'jumlah_wawancara',
        'aktif_mencari_kerja',
    ];

    public function tracerStudy()
    {
        return $this->belongsTo(TracerStudy::class);
    }
}
