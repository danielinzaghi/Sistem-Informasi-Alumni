<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bekerja extends Model
{
    protected $table = 'bekerjas';

    protected $fillable = [
        'tracer_study_id',
        'waktu_dapat_kerja',
        'gaji_bulanan',
        'lokasi_provinsi',
        'lokasi_kota',
        'jenis_perusahaan',
        'jenis_perusahaan_lainnya',
        'nama_perusahaan',
        'tingkat_perusahaan',
        'tingkat_pendidikan_pekerjaan',
        'alasan_ambil_pekerjaan',
        'bekerja_di_luar_bidang',
    ];

    public function tracerStudy()
    {
        return $this->belongsTo(TracerStudy::class);
    }
}
