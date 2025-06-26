<?php

use Illuminate\Database\Seeder;

class Developmentseeder extends Seeder
{
    public function run()
    {
        // Contoh: generate 50 user siswa random
        \App\Models\User::factory(50)->create()->each(function($user) {
            $user->assignRole('siswa');
            // buat data siswa terkait, dst.
        });
    }
}