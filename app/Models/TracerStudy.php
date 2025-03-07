<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TracerStudy extends Model
{
    use HasFactory;

    protected $table = 'tracer_study';

    protected $fillable = [
        'alumni_id', 'status_saat_ini', 'waktu_dapat_kerja', 'gaji_bulanan', 'lokasi_provinsi',
        'lokasi_kota', 'jenis_perusahaan', 'jenis_perusahaan_lainnya', 'nama_perusahaan',
        'posisi_wirausaha', 'tingkat_perusahaan', 'sumber_biaya_studi', 'universitas_lanjut',
        'program_studi_lanjut', 'tanggal_masuk_lanjut', 'hubungan_studi_pekerjaan',
        'tingkat_pendidikan_pekerjaan', 'metode_cari_kerja', 'jumlah_lamaran', 'jumlah_wawancara',
        'alasan_ambil_pekerjaan'
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}
