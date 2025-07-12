<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
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

        return view('siswa.profil', compact('siswa', 'nilais'));
    }

    /**
     * Edit profil siswa
     */
    public function edit()
    {
        $siswa = Auth::user()->siswa;
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }
        return view('siswa.editProfil', compact('siswa'));
    }

    /**
     * Update profil siswa dan password
     */
    public function update(Request $request)
    {
        $siswa = Auth::user()->siswa;
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nis' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'nullable|confirmed|min:8',
        ]);
        $siswa->update($request->only('nama', 'email', 'nis', 'jenis_kelamin'));
        // Update password jika diisi
        if ($request->filled('password')) {
            $siswa->user->update([
                'password' => bcrypt($request->password)
            ]);
        }
        return redirect()->route('siswa.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}