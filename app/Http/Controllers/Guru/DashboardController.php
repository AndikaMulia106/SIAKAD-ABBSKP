<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataPelajaran as Mapel;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        
        $guru = auth()->user()->guru; 
        $daftarKelas = $guru->kelas ?? Kelas::all();

        $daftarMapel = [];
        $kelasTerpilih = null;
        $mapelTerpilih = null;
        $siswaKelas = [];

        if ($request->kelas_id) {
            $kelasTerpilih = Kelas::find($request->kelas_id);
            $daftarMapel = $guru->mapel ?? Mapel::all();
        }

        if ($request->kelas_id && $request->mapel_id) {
            $mapelTerpilih = Mapel::find($request->mapel_id);
            $siswaKelas = $kelasTerpilih ? $kelasTerpilih->siswa : [];
        }

        return view('guru.dashboard', compact(
            'daftarKelas',
            'daftarMapel',
            'kelasTerpilih',
            'mapelTerpilih',
            'siswaKelas'
        ));
    }
}