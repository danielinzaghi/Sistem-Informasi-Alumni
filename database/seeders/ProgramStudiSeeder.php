<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;
use App\Models\Jurusan;
use App\Models\Dosen;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // Data program studi dalam bentuk array
        $programStudiData = [
            ['nama_prodi' => 'D3 Teknik Informatika', 'jurusan' => 'Komputer dan Bisnis', 'nidn_kaprodi' => '1234567890'],
            ['nama_prodi' => 'D4 Rekayasa Keamanan Siber', 'jurusan' => 'Komputer dan Bisnis', 'nidn_kaprodi' => '1234567890'],
            ['nama_prodi' => 'D4 Akuntansi Lembaga Keuangan Syariah', 'jurusan' => 'Komputer dan Bisnis', 'nidn_kaprodi' => '1234567890'],
            ['nama_prodi' => 'D4 Teknologi Rekayasa Multimedia', 'jurusan' => 'Komputer dan Bisnis', 'nidn_kaprodi' => '1234567890'],
            ['nama_prodi' => 'D4 Rekayasa Perangkat Lunak', 'jurusan' => 'Komputer dan Bisnis', 'nidn_kaprodi' => '1234567890'],

            
            ['nama_prodi' => 'D3 Teknik Mesin', 'jurusan' => 'Rekayasa Mesin dan Industri Pertanian', 'nidn_kaprodi' => '0987654321'],
            ['nama_prodi' => 'D4 Teknik Pengendalian Pencemaran Lingkungan', 'jurusan' => 'Rekayasa Mesin dan Industri Pertanian', 'nidn_kaprodi' => '0987654321'],
            ['nama_prodi' => 'D4 Pengembangan Produk Agroindustri', 'jurusan' => 'Rekayasa Mesin dan Industri Pertanian', 'nidn_kaprodi' => '0987654321'],
            ['nama_prodi' => 'D4 Rekayasa Energi Terbarukan', 'jurusan' => 'Rekayasa Mesin dan Industri Pertanian', 'nidn_kaprodi' => '0987654321'],
            ['nama_prodi' => 'D4 Teknologi Rekayasa Kimia Industri', 'jurusan' => 'Rekayasa Mesin dan Industri Pertanian', 'nidn_kaprodi' => '0987654321'],


            ['nama_prodi' => 'D3 Teknik Elektronika', 'jurusan' => 'Rekayasa Elektro dan Mekatronika', 'nidn_kaprodi' => '3214567890'],
            ['nama_prodi' => 'D3 Teknik Elektronika', 'jurusan' => 'Rekayasa Elektro dan Mekatronika', 'nidn_kaprodi' => '3214567890'],
            ['nama_prodi' => 'D4 Teknologi Rekayasa Mekatronika', 'jurusan' => 'Rekayasa Elektro dan Mekatronika', 'nidn_kaprodi' => '3214567890'],

        ];

        // Looping untuk insert data ke tabel program_studi
        foreach ($programStudiData as $data) {
            $jurusan = Jurusan::where('nama_jurusan', $data['jurusan'])->first();
            $kaprodi = Dosen::where('nidn', $data['nidn_kaprodi'])->first();

            ProgramStudi::create([
                'nama_prodi' => $data['nama_prodi'],
                'jurusan_id' => $jurusan->id ?? null, // Jika jurusan tidak ditemukan, set null
                'id_kaprodi' => $kaprodi->id ?? null, // Jika kaprodi tidak ditemukan, set null
            ]);
        }
    }
}
