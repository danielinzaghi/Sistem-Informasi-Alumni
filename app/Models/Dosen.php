<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $fillable = ['users_id', 'nama', 'nidn', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_kaprodi');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}
