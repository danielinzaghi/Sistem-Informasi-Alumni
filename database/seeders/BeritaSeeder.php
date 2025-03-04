<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;
use App\Models\Kategori;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $berita = [
            ['judul' => 'Teknologi AI di Indonesia', 'slug' => 'teknologi-ai', 'deskripsi' => 'Deskripsi berita AI...', 'kategori' => 'Teknologi', 'user' => 'admin'],
            ['judul' => 'Pendidikan di Era Digital', 'slug' => 'pendidikan-digital', 'deskripsi' => 'Deskripsi berita pendidikan...', 'kategori' => 'Pendidikan', 'user' => 'admin'],
        ];

        foreach ($berita as $data) {
            $user = User::where('name', $data['user'])->first();
            $kategori = Kategori::where('nama', $data['kategori'])->first();

            Berita::create([
                'judul' => $data['judul'],
                'slug' => $data['slug'],
                'deskripsi' => $data['deskripsi'],
                'kategori_id' => $kategori->id ?? null,
                'users_id' => $user->id ?? null,
                'views' => 0,
                'status' => 'Draft',
                'tanggal' => now(),
            ]);
        }
    }
}
