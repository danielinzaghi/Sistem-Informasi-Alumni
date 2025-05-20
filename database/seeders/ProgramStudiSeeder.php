<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;
use App\Models\Jurusan;
use App\Models\Dosen;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $kaprodiDosen = Dosen::skip(3)->take(13)->pluck('id')->toArray(); // Ambil 13 dosen untuk Kaprodi

        $programStudiData = [
            'Komputer dan Bisnis' => [
                'D3 Teknik Informatika',
                'D4 Rekayasa Keamanan Siber',
                'D4 Akuntansi Lembaga Keuangan Syariah',
                'D4 Teknologi Rekayasa Multimedia',
                'D4 Rekayasa Perangkat Lunak',
            ],
            'Rekayasa Mesin dan Industri Pertanian' => [
                'D3 Teknik Mesin',
                'D4 Teknik Pengendalian Pencemaran Lingkungan',
                'D4 Pengembangan Produk Agroindustri',
                'D4 Rekayasa Energi Terbarukan',
                'D4 Teknologi Rekayasa Kimia Industri',
            ],
            'Rekayasa Elektro dan Mekatronika' => [
                'D3 Teknik Elektronika',
                'D4 Teknologi Rekayasa Mekatronika',
                'D3 Teknik Listrik',
            ],
        ];

        $i = 0;
        foreach ($programStudiData as $jurusanName => $prodiList) {
            $jurusan = Jurusan::where('nama_jurusan', $jurusanName)->first();

            foreach ($prodiList as $namaProdi) {
                ProgramStudi::create([
                    'nama_prodi' => $namaProdi,
                    'jurusan_id' => $jurusan->id,
                    'id_kaprodi' => $kaprodiDosen[$i++] ?? null,
                ]);
            }
        }
    }
}
