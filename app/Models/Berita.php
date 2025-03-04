<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $fillable = ['users_id', 'kategori_id', 'judul', 'slug', 'deskripsi', 'img', 'views', 'status', 'tanggal'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
