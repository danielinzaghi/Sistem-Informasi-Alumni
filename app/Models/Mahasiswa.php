<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = ['users_id', 'nim', 'nama', 'no_hp', 'angkatan', 'prodi', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    } //
}
