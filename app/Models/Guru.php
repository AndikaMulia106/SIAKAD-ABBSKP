<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // Tentukan nama tabel jika berbeda
    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'name',
        'email',
        // Tambahkan atribut lain yang diperlukan
    ];
}
