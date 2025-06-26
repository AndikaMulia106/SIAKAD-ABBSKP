<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        // tambahkan kolom lain jika ada, misal: 'wali_kelas_id'
    ];

    // Contoh relasi ke siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Contoh relasi ke mata pelajaran (jika ada pivot)
    public function mataPelajaran()
    {
        return $this->belongsToMany(MataPelajaran::class, 'kelas_mata_pelajaran', 'kelas_id', 'mata_pelajaran_id');
    }
}