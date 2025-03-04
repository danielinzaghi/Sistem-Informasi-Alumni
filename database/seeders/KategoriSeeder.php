<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Teknologi', 'slug' => 'teknologi', 'views' => 0],
            ['nama' => 'Pendidikan', 'slug' => 'pendidikan', 'views' => 0],
            ['nama' => 'Kampus', 'slug' => 'kampus', 'views' => 0],
        ];

        foreach ($kategori as $data) {
            Kategori::create($data);
        }
    }
}
