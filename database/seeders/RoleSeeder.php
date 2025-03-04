<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //create role
        $adminRole = Role::create([
            'name' => 'admin',
        ]);
        $dosenRole = Role::create([
            'name' => 'dosen',
        ]);
        $alumniRole = Role::create([
            'name' => 'alumni',
        ]);

        //insert into user
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'avatar' => 'images/avatar-default.svg',
            'password' => bcrypt('password123'),
        ]);

        $userDosen = User::create([
            'name' => 'Bulianto Denis Notokusumo',
            'email' => 'bul@gmail.com',
            'avatar' => 'images/avatar-default.svg',
            'password' => bcrypt('password123'),
        ]);

        $userAlumni = User::create([
            'name' => 'alumni',
            'email' => 'alumni@gmail.com',
            'avatar' => 'images/avatar-default.svg',
            'password' => bcrypt('123'),
        ]);

        //assign role each user
        $userAdmin->assignRole($adminRole);
        // $userMahasiswa->assignRole($mahasiswaRole);
        $userDosen->assignRole($dosenRole);
        $userAlumni->assignRole($alumniRole);

        //add debug information
        Log::info('User created with ID: ' . $userAdmin->id);
        Log::info('Assigned role: ' . $userAdmin->name);
        Log::info('User roles after assigment: ' . $userAdmin->roles->pluck('name'));
    }
}
