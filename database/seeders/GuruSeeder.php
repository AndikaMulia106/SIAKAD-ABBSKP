<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $gurus = [
            [
                'name' => 'Dr. Ahmad Fauzi, M.Pd',
                'email' => 'fauzi@siakad-abbskp.test',
                'password' => Hash::make('guru123'),
                'nip' => '198003122006041001'
            ],
            [
                'name' => 'Drs. Budi Santoso',
                'email' => 'budi@siakad-abbskp.test',
                'password' => Hash::make('guru123'),
                'nip' => '197512102002121002'
            ]
        ];

        foreach ($gurus as $guru) {
            $user = User::firstOrCreate(
                ['email' => $guru['email']],
                [
                    'name'     => $guru['name'],
                    'password' => $guru['password'],
                ]
            );
            $user->assignRole('guru');

            Guru::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nip'   => $guru['nip'],
                    'nama'  => $guru['name'],
                    'email' => $guru['email'],
                ]
            );
        }
    }
}