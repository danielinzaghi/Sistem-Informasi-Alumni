<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelumBekerja extends Model
{
    protected $table = 'belum_bekerjas';

    protected $fillable = [
        'tracer_study_id',
        'alasan_belum_bekerja',
        'alasan_lainnya',
        'kendala_mendapat_pekerjaan',
        'kendala_lainnya',
        'mengikuti_pelatihan',
        'nama_pelatihan',
        'durasi_pelatihan',
        'sertifikasi_pelatihan',
    ];

    public function tracerStudy()
    {
        return $this->belongsTo(TracerStudy::class);
    }
}
