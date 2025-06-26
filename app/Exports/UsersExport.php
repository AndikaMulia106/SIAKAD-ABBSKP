<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::with('roles')->get()->map(function ($user) {
            return [
                'name'     => $user->name,
                'email'    => $user->email,
                'role'     => $user->roles->pluck('name')->implode(','), // multi role dipisah koma
            ];
        });
    }

    public function headings(): array
    {
        return ['name', 'email', 'role'];
    }
}