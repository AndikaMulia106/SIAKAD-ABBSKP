<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        TahunAjaran::create([
            'nama' => '2023/2024',
            'tanggal_mulai' => '2023-07-17',
            'tanggal_selesai' => '2024-06-14',
            'status' => 'aktif'
        ]);

        TahunAjaran::create([
            'nama' => '2024/2025',
            'tanggal_mulai' => '2024-07-15',
            'tanggal_selesai' => '2025-06-13',
            'status' => 'nonaktif'
        ]);
    }
}
