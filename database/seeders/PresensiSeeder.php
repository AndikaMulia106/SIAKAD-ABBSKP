<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresensiSeeder extends Seeder
{
    public function run()
    {
        DB::table('presensi')->insert([
            [
                'siswa_id' => 1,
                'tanggal'  => '2025-06-01',
                'status'   => 'hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 1,
                'tanggal'  => '2025-06-02',
                'status'   => 'izin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2,
                'tanggal'  => '2025-06-01',
                'status'   => 'hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data presensi lain sesuai kebutuhan
        ]);
    }
}