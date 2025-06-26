<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Menampilkan profil siswa
     */
    public function show()
    {
        $siswa = Auth::user()->siswa;
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }

        $nilais = Nilai::where('siswa_id', $siswa->id)
                    ->with('mapel')
                    ->get();

        $presensi = Presensi::where('siswa_id', $siswa->id)
                        ->selectRaw('COUNT(*) as total, 
                                    SUM(CASE WHEN status = "hadir" THEN 1 ELSE 0 END) as hadir')
                        ->first();

        return view('siswa.profil', compact('siswa', 'nilais', 'presensi'));
    }

    /**
     * Ubah password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        Auth::user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
