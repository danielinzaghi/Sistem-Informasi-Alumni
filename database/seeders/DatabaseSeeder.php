<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DosenSeeder::class,
            JurusanSeeder::class,
            ProgramStudiSeeder::class,
            MahasiswaSeeder::class,
            KategoriSeeder::class,
            BeritaSeeder::class,
            AgendaSeeder::class,
            AlumniSeeder::class,
        ]);
    }
}
