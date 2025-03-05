<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $agendaData = [
            [
                'nama_acara' => 'Seminar Teknologi',
                'deskripsi' => 'Seminar tentang perkembangan teknologi terkini.',
                'lokasi' => 'Aula Kampus',
                'tanggal' => Carbon::parse('2025-04-10'),
                'tautan' => 'https://seminar-teknologi.com'
            ],
            [
                'nama_acara' => 'Workshop Laravel',
                'deskripsi' => 'Pelatihan pengembangan aplikasi menggunakan Laravel.',
                'lokasi' => 'Lab Komputer 3',
                'tanggal' => Carbon::parse('2025-05-15'),
                'tautan' => 'https://workshop-laravel.com'
            ],
            [
                'nama_acara' => 'Lomba Coding',
                'deskripsi' => 'Kompetisi coding bagi mahasiswa tingkat akhir.',
                'lokasi' => 'Ruang Rapat',
                'tanggal' => Carbon::parse('2025-06-20'),
                'tautan' => 'https://lomba-coding.com'
            ],
        ];

        foreach ($agendaData as $agenda) {
            Agenda::create($agenda);
        }
    }
}
