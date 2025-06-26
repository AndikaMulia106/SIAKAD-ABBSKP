<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Menampilkan daftar semua nilai siswa dengan filter
     */
    public function index(Request $request)
    {
        $query = Nilai::with(['siswa', 'mapel', 'guru']);

        if ($request->nama_siswa) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama_siswa . '%');
            });
        }
        if ($request->kelas_id) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }
        if ($request->mapel_id) {
            $query->where('mapel_id', $request->mapel_id);
        }
        if ($request->tahun_ajaran) {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        $nilai = $query->orderBy('created_at', 'desc')->paginate(10);

        // Data untuk filter
        $daftarKelas = Kelas::all();
        $daftarMapel = MataPelajaran::all();
        $daftarTahunAjaran = TahunAjaran::all();

        return view('guru.nilai.index', compact('nilai', 'daftarKelas', 'daftarMapel', 'daftarTahunAjaran'));
    }

    /**
     * Form input nilai baru (semua mapel & siswa)
     */
    public function create()
    {
        $siswas = Siswa::all();
        $mapels = MataPelajaran::all();
        $daftarTahunAjaran = TahunAjaran::orderBy('nama', 'desc')->get();
        return view('guru.nilai.create', compact('siswas', 'mapels', 'daftarTahunAjaran'));
    }

    /**
     * Menyimpan nilai baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'nilai'    => 'required|numeric|min=0|max=100'
        ]);

        $guruId = optional(auth()->user()->guru)->id;

        Nilai::create([
            'siswa_id'  => $request->siswa_id,
            'mapel_id'  => $request->mapel_id,
            'guru_id'   => $guruId,
            'nilai'     => $request->nilai,
            'semester'  => 'Ganjil',
            'tahun_ajaran' => date('Y')
        ]);

        return redirect()->route('guru.nilai.index')
                         ->with('success', 'Nilai berhasil ditambahkan!');
    }

    /* Form Import nilai */
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    $file = $request->file('file');
    $data = \Excel::toArray([], $file)[0]; // gunakan package Maatwebsite\Excel

    DB::beginTransaction();
    try {
        foreach ($data as $i => $row) {
            if ($i == 0) continue; // skip header
            // Asumsi urutan: Nama Siswa, Nama Kelas, Mata Pelajaran, Semester, Tahun Ajaran, Nilai
            [$namaSiswa, $namaKelas, $namaMapel, $semester, $tahunAjaran, $nilai] = $row;

            $siswa = Siswa::where('nama', $namaSiswa)->first();
            $mapel = MataPelajaran::where('nama', $namaMapel)->first();
            // Validasi data
            if (!$siswa || !$mapel) continue;

            Nilai::create([
                'siswa_id' => $siswa->id,
                'mapel_id' => $mapel->id,
                'semester' => $semester,
                'tahun_ajaran' => $tahunAjaran,
                'nilai' => $nilai,
            ]);
        }
        DB::commit();
        return redirect()->back()->with('success', 'Import nilai berhasil!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Import gagal: ' . $e->getMessage());
    }
}    

    
}