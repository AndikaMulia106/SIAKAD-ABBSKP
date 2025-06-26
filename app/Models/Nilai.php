<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai'; // Tentukan nama tabel jika berbeda
    protected $fillable = [
        'siswa_id',
        'mapel_id',
        'guru_id',
        'nilai',
        'semester',
        'tahun_ajaran',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke MataPelajaran
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }
    public function guru()
    {
        return $this->belongsTo(\App\Models\Guru::class, 'guru_id');
    }
}