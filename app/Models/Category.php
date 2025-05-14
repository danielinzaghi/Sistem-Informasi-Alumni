<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    // Nama tabel di database
    protected $table = 'kategori';

    // Kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'slug',
    
    ];

    // Opsi jika ingin menggunakan timestamps (true secara default)
    public $timestamps = true;
    public function Articles(): HasMany
    {
        return $this->hasMany(Article::class, 'kategori_id', 'id'); // Menyebutkan kolom foreign key jika diperlukan
    }

}
