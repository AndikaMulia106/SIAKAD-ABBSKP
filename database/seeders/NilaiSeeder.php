<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        DB::table('nilai')->insert([
            [
                'siswa_id' => 1,
                'mapel_id' => 1,
                'guru_id'  => 1,
                'nilai'    => 88,
                'semester' => 'Ganjil',
                'tahun_ajaran' => '2024/2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2,
                'mapel_id' => 2,
                'guru_id'  => 2,
                'nilai'    => 92,
                'semester' => 'Ganjil',
                'tahun_ajaran' => '2024/2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 1,
                'mapel_id' => 3,
                'guru_id'  => 1,
                'nilai'    => 80,
                'semester' => 'Genap',
                'tahun_ajaran' => '2023/2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data nilai lain sesuai kebutuhan
        ]);
    }
}