<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::where('email', $row['email'])->first();
        if (!$user) {
            $user = User::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'password' => isset($row['password']) && $row['password'] ? Hash::make($row['password']) : Hash::make('password123'),
            ]);
        } else {
            $user->update([
                'name'     => $row['name'],
                'password' => isset($row['password']) && $row['password'] ? Hash::make($row['password']) : $user->password,
            ]);
        }

        if (!empty($row['role'])) {
            $roles = explode(',', $row['role']);
            $user->syncRoles($roles);
        }

        return $user;
    }
}