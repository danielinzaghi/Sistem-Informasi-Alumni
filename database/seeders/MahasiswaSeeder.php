<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Gunakan locale Indonesia

        // Pastikan role "alumni" sudah ada
        $alumniRole = Role::firstOrCreate(['name' => 'alumni']);

        // Ambil semua program studi dari database
        $prodiList = ProgramStudi::pluck('id')->toArray();

        // Simpan NIM yang sudah dibuat untuk memastikan unik
        $usedNIMs = [];

        // Tahun saat ini
        $currentYear = now()->year;

        // Tambahkan 30 alumni
        for ($i = 1; $i <= 30; $i++) {
            $angkatan = rand(2008, 2024);

            // Pastikan NIM unik
            do {
                $nim = $angkatan . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
            } while (in_array($nim, $usedNIMs));
            $usedNIMs[] = $nim;

            // Pilih prodi secara acak
            $randomProdiId = $prodiList[array_rand($prodiList)];

            // Tentukan status kelulusan berdasarkan angkatan
            $status = ($angkatan < $currentYear) ? 'lulus' : 'aktif';

            // Generate nama acak
            $randomName = $faker->name;

            // Buat user
            $userAlumni = User::create([
                'name' => $randomName,
                'email' => strtolower(str_replace(' ', '', $randomName)) . "@gmail.com",
                'password' => Hash::make('password123'),
            ]);
            $userAlumni->assignRole($alumniRole);

            // Masukkan ke tabel mahasiswa
            Mahasiswa::create([
                'user_id' => $userAlumni->id,
                'id_prodi' => $randomProdiId,
                'nim' => $nim,
                'angkatan' => $angkatan,
                'no_hp' => "08" . rand(1000000000, 9999999999),
                'status' => $status, // Status akan menyesuaikan dengan tahun real-time
            ]);
        }
        $userMahasiswa = User::create([
            'name' => "Mahasiswa",
            'email' => "mhs@gmail.com",
            'password' => bcrypt('password123'),
        ]);
        $userMahasiswa->assignRole('mahasiswa');

        Mahasiswa::create([
            'user_id' => $userMahasiswa->id,
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
