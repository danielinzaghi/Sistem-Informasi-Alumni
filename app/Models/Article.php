<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 


class Article extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'slug',
        'deskripsi',
        'img',
        'views',
        'status',
        'tanggal',
    ];

    /**
     * Relasi ke tabel Users (Penulis Berita).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel Kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id'); 
    }

    
}
