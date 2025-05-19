<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;
use App\Models\Mahasiswa;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua mahasiswa yang sudah lulus
        $mahasiswaLulus = Mahasiswa::where('status', 'lulus')->get();
        $digits = '0123456789';

        foreach ($mahasiswaLulus as $mahasiswa) {
            // Cek apakah alumni sudah ada berdasarkan mahasiswa_id
            $existingAlumni = Alumni::where('mahasiswa_id', $mahasiswa->id)->first();

            if (!$existingAlumni) {
                Alumni::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'tahun_lulus' => $mahasiswa->angkatan + 3, // Asumsi lulus 3 tahun setelah masuk
                    'pekerjaan' => null, // Bisa diupdate sesuai kebutuhan
                    'instansi' =>null,
                    'npwp' => substr(str_shuffle(str_repeat($digits,15)), 0, 15),
                    'nik' => substr(str_shuffle(str_repeat($digits,16)), 0, 16),
                ]);
            }
        }
    }
}
