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
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Mahasiswa::class, 'id', 'id', 'mahasiswa_id', 'users_id');
    }

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class, 'alumni_id', 'id');
    }


}
