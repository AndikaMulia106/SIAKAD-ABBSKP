<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $siswas = [
            [
                'nis' => '202301001',
                'nama' => 'Muhammad Rizky',
                'email' => 'rizky@siakad-abbskp.test',
                'password' => Hash::make('siswa123'),
                'kelas_id' => 1,
                'jenis_kelamin' => 'L'
            ],
            [
                'nis' => '202301002',
                'nama' => 'Aisyah Nurul',
                'email' => 'aisyah@siakad-abbskp.test',
                'password' => Hash::make('siswa123'),
                'kelas_id' => 1,
                'jenis_kelamin' => 'P'
            ]
        ];
        foreach ($siswas as $siswa) {
            $user = User::firstOrCreate(
                ['email' => $siswa['email']],
                [
                    'name'     => $siswa['nama'],
                    'password' => $siswa['password'],
                ]
            );
            $user->assignRole('siswa');

            Siswa::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nis'           => $siswa['nis'],
                    'nama'          => $siswa['nama'],
                    'email'         => $siswa['email'],
                    'kelas_id'      => $siswa['kelas_id'],
                    'jenis_kelamin' => $siswa['jenis_kelamin'],
                    'password'     => $siswa['password'],
                ]
            );
        }
    }
}