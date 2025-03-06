<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Dosen;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $dosenKajur = Dosen::take(3)->pluck('id')->toArray(); // Ambil 3 dosen pertama untuk Kajur

        $jurusanData = [
            'Komputer dan Bisnis',
            'Rekayasa Mesin dan Industri Pertanian',
            'Rekayasa Elektro dan Mekatronika',
        ];

        foreach ($jurusanData as $index => $namaJurusan) {
            Jurusan::create([
                'nama_jurusan' => $namaJurusan,
                'id_kajur' => $dosenKajur[$index] ?? null,
            ]);
        }
    }
}
