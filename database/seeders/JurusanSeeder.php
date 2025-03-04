<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Dosen;

class JurusanSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $kajur1 = Dosen::where('nidn', '1234567890')->first();
        $kajur2 = Dosen::where('nidn', '0987654321')->first();
        $kajur2 = Dosen::where('nidn', '3214567890')->first();


        Jurusan::create([
            'nama_jurusan' => 'Komputer dan Bisnis',
            'id_kajur' => $kajur1->id ?? null,
        ]);

        Jurusan::create([
            'nama_jurusan' => 'Rekayasa Mesin dan Industri Pertanian',
            'id_kajur' => $kajur2->id ?? null,
        ]);
        Jurusan::create([
            'nama_jurusan' => 'Rekayasa Elektro dan Mekatronika',
            'id_kajur' => $kajur3->id ?? null,
        ]);
    }
}
