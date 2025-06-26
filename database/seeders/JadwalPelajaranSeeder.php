<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPelajaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('jadwal_pelajaran')->insert([
            [
                'kelas_id' => 1,
                'mapel_id' => 1,
                'guru_id'  => 1,
                'hari'     => 'Senin',
                'jam'      => '07:00-08:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 1,
                'mapel_id' => 2,
                'guru_id'  => 2,
                'hari'     => 'Selasa',
                'jam'      => '08:30-10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 2,
                'mapel_id' => 3,
                'guru_id'  => 1,
                'hari'     => 'Rabu',
                'jam'      => '10:15-11:45',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan jadwal lain sesuai kebutuhan
        ]);
    }
}