<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Spatie\Permission\Models\Role;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role "alumni" sudah ada
        $alumniRole = Role::firstOrCreate(['name' => 'alumni']);

        // Ambil semua program studi dari database
        $prodiList = ProgramStudi::pluck('id')->toArray();

        // Simpan NIM yang sudah dibuat untuk memastikan unik
        $usedNIMs = [];

        // Tambahkan 30 alumni
        for ($i = 1; $i <= 30; $i++) {
            $angkatan = rand(2018, 2021);

            // Pastikan NIM unik
            do {
                $nim = $angkatan . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
            } while (in_array($nim, $usedNIMs));
            $usedNIMs[] = $nim;

            // Pilih prodi secara acak
            $randomProdiId = $prodiList[array_rand($prodiList)];
            $randomProdi = ProgramStudi::find($randomProdiId);

            // Buat user
            $userAlumni = User::create([
                'name' => "Alumni $i",
                'email' => "alumni$i@gmail.com",
                'password' => bcrypt('password123'),
            ]);
            $userAlumni->assignRole($alumniRole);

            // Masukkan ke tabel mahasiswa
            Mahasiswa::create([
                'users_id' => $userAlumni->id,
                'id_prodi' => $randomProdiId,
                'nim' => $nim,
                // 'nama' => $userAlumni->name,
                'angkatan' => $angkatan,
                // 'prodi' => $randomProdi->nama_prodi ?? 'Tidak Diketahui',
                'no_hp' => "08" . rand(1000000000, 9999999999),
                'status' => 'lulus',
            ]);
        }
        $userMahasiswa = User::create([
            'name' => "Mahasiswa",
            'email' => "mhs@gmail.com",
            'password' => bcrypt('password123'),
        ]);
        $userMahasiswa->assignRole('mahasiswa');

        Mahasiswa::create([
            'users_id' => $userMahasiswa->id,
            'id_prodi' => 1,
            'nim' => 2203102,
            // 'nama' => $userAlumni->name,
            'angkatan' => 2022,
            // 'prodi' => $randomProdi->nama_prodi ?? 'Tidak Diketahui',
            'no_hp' => "08" . rand(1000000000, 9999999999),
            'status' => 'aktif',
        ]);

    }
}
