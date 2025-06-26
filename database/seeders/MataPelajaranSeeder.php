<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('mata_pelajaran')->insert([
            [
                'nama' => 'Matematika',
                'kode' => 'MAT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bahasa Indonesia',
                'kode' => 'BIN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bahasa Inggris',
                'kode' => 'BIG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Fisika',
                'kode' => 'FIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kimia',
                'kode' => 'KIM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan mata pelajaran lain sesuai kebutuhan
        ]);
    }
}