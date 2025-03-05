<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';
    protected $fillable = ['mahasiswa_id', 'tahun_lulus', 'pekerjaan', 'instansi', 'npwp', 'nik'];
    
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'mahasiswa_id');
    }
}
