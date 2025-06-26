<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Roles and Permissions First
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // 2. Seed Tahun Ajaran
        $this->call(TahunAjaranSeeder::class);

        // 3. Seed Academic Data (Kelas & Mata Pelajaran)
        $this->call([
            KelasSeeder::class,
            MataPelajaranSeeder::class,
        ]);

        // 4. Seed Admin User
        DB::table('users')->insertOrIgnore([
            'name' => 'Administrator',
            'email' => 'administrator@siakad-abbskp.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin = \App\Models\User::where('email', 'administrator@siakad-abbskp.test')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        // 5. Seed Sample Teachers & Students (butuh users, kelas)
        $this->call([
            GuruSeeder::class,
            SiswaSeeder::class,
        ]);

        // 6. Seed Jadwal Pelajaran (butuh kelas, guru, mapel)
        $this->call(JadwalPelajaranSeeder::class);

        // 7. Seed Sample Academic Records (butuh siswa, guru, mapel)
        $this->call([
            NilaiSeeder::class,
            PresensiSeeder::class,
        ]);

    }
}