<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Spatie\Permission\Models\Role;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role "dosen" sudah ada
        $dosenRole = Role::firstOrCreate(['name' => 'dosen']);

        // Data Dosen (3 untuk Kajur, 13 untuk Kaprodi)
        $dosenData = [
            // Kajur (3 orang)
            ['name' => 'Dr. Setiawan', 'email' => 'setiawan@gmail.com', 'nidn' => '87654321'],
            ['name' => 'Dr. Budi Santoso', 'email' => 'budi@gmail.com', 'nidn' => '12345678'],
            ['name' => 'Dr. Siti Nurhaliza', 'email' => 'siti@gmail.com', 'nidn' => '98765432'],

            // Kaprodi (13 orang)
            ['name' => 'Dr. Agus Salim', 'email' => 'agus@gmail.com', 'nidn' => '23456789'],
            ['name' => 'Dr. Indra Wijaya', 'email' => 'indra@gmail.com', 'nidn' => '34567890'],
            ['name' => 'Dr. Rahmat Hidayat', 'email' => 'rahmat@gmail.com', 'nidn' => '45678901'],
            ['name' => 'Dr. Anita Kusuma', 'email' => 'anita@gmail.com', 'nidn' => '56789012'],
            ['name' => 'Dr. Dedi Supriyadi', 'email' => 'dedi@gmail.com', 'nidn' => '67890123'],
            ['name' => 'Dr. Fadli Akbar', 'email' => 'fadli@gmail.com', 'nidn' => '78901234'],
            ['name' => 'Dr. Hendra Prasetyo', 'email' => 'hendra@gmail.com', 'nidn' => '89012345'],
            ['name' => 'Dr. Ika Sari', 'email' => 'ika@gmail.com', 'nidn' => '90123456'],
            ['name' => 'Dr. Joko Widodo', 'email' => 'joko@gmail.com', 'nidn' => '01234567'],
            ['name' => 'Dr. Kartini', 'email' => 'kartini@gmail.com', 'nidn' => '12345098'],
            ['name' => 'Dr. Lisa Mulyani', 'email' => 'lisa@gmail.com', 'nidn' => '23450987'],
            ['name' => 'Dr. Mahmud Syafii', 'email' => 'mahmud@gmail.com', 'nidn' => '34509876'],
            ['name' => 'Dr. Nurhadi', 'email' => 'nurhadi@gmail.com', 'nidn' => '45608765'],
        ];

        // Loop untuk menambah dosen ke tabel users dan assign role
        foreach ($dosenData as $data) {
            $userDosen = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password123'),
            ]);
            $userDosen->assignRole($dosenRole);

            Dosen::create([
                'users_id' => $userDosen->id,
                'nama' => $userDosen->name,
                'nidn' => $data['nidn'],
            ]);
        }
    }
}
