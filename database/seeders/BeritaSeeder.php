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
            ['judul' => 'Teknologi AI di Indonesia', 'slug' => 'teknologi-ai', 'deskripsi' => 'Deskripsi berita AI...', 'kategori' => 'Teknologi'],
            ['judul' => 'Pendidikan di Era Digital', 'slug' => 'pendidikan-digital', 'deskripsi' => 'Deskripsi berita pendidikan...', 'kategori' => 'Pendidikan'],
        ];

        // Ambil semua user dengan role dosen dan alumni
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['dosen', 'alumni']);
        })->pluck('id')->toArray();

        // Jika tidak ada user yang ditemukan, hentikan proses
        if (empty($users)) {
            return;
        }

        foreach ($berita as $data) {
            $kategori = Kategori::where('nama', $data['kategori'])->first();

            Berita::create([
                'judul' => $data['judul'],
                'slug' => $data['slug'],
                'deskripsi' => $data['deskripsi'],
                'kategori_id' => $kategori->id ?? null,
                'user_id' => $users[array_rand($users)], // Pilih user dosen/alumni secara acak
                'views' => 0,
                'status' => 'Draft',
                'tanggal' => now(),
            ]);
        }
    }
}
