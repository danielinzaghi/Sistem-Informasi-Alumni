<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = [
        'nama_jurusan',
        'id_kajur',
    ];

    /**
     * Relasi ke model Dosen (Kajur).
     */
    public function kajur()
    {
        return $this->belongsTo(Dosen::class, 'id_kajur');
    }
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'jurusan_id');
    }
}
