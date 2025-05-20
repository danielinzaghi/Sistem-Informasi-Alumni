<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendidikanLanjut extends Model
{
    protected $table = 'pendidikan_lanjuts';

    protected $fillable = [
        'tracer_study_id',
        'sumber_biaya_studi',
        'universitas_lanjut',
        'program_studi_lanjut',
        'tanggal_masuk_lanjut',
        'hubungan_studi_pekerjaan',
    ];

    public function tracerStudy()
    {
        return $this->belongsTo(TracerStudy::class);
    }
}
