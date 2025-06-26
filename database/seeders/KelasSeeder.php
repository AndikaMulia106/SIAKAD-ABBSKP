<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        DB::table('kelas')->insert([
            [
                'id' => 1,
                'nama' => 'X IPA 1',
                'tingkat' => 'X',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'XI IPA 1',
                'tingkat' => 'XI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
}