<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = ['user_id', 'id_prodi', 'nim',  'no_hp', 'angkatan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Sesuaikan dengan nama kolom di DB
    }


    public function prodi() 
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }

    public function alumni()
    {
        return $this->hasOne(Alumni::class, 'mahasiswa_id', 'id'); // Sesuaikan nama kolom FK dan PK
    }

}
