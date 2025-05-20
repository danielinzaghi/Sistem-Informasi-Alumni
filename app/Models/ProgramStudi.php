<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $fillable = [
        // 'id_prodi',
        'jurusan_id',
        'nama_prodi',
        'id_kaprodi',
    ];

    /**
     * Relasi ke model Jurusan.
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    /**
     * Relasi ke model Dosen (KapProdi).
     */
    public function kaprodi()
    {
        return $this->belongsTo(Dosen::class, 'id_kaprodi');
    }


    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_prodi');
    }
}
