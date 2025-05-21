<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $fillable = ['user_id', 'nidn', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function programStudi()
    {
        return $this->hasOne(ProgramStudi::class, 'id_kaprodi');
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id_kajur');
    }
}
