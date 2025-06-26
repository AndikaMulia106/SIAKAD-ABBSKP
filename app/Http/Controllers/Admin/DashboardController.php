<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin
     */
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalAdmin = User::role('admin')->count();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalAdmin'));
    }

    /**
     * Manajemen User
     */
    public function manageUsers()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Reset Password User
     */
    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['password' => bcrypt('password123')]);
        
        return back()->with('success', 'Password berhasil direset!');
    }
}
