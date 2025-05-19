<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Role
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'dosen']);
        Role::firstOrCreate(['name' => 'alumni']);
        Role::firstOrCreate(['name' => 'mahasiswa']);

        // Insert User Admin
        $userAdmin = User::create([
            'name' => 'Rehan',
            'email' => 'afrizalfajri23@gmail.com',
            'password' => bcrypt('password123'),
        ]);
        $userAdmin->assignRole('admin');
    }
}
