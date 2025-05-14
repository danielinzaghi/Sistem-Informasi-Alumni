<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wirausaha extends Model
{
    protected $table = 'wirausahas';

    protected $fillable = [
        'tracer_study_id',
        'nama_usaha',
        'bidang_usaha',
        'tahun_berdiri',
        'jumlah_karyawan',
        'posisi_wirausaha',
        'omzet_per_bulan',
        'bentuk_usaha',
        'npwp_usaha',
    ];

    public function tracerStudy()
    {
        return $this->belongsTo(TracerStudy::class);
    }
}
