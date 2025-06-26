<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,guru,siswa',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles([$request->role]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,guru,siswa',
        ]);
        $user->syncRoles([$request->role]);
        return back()->with('success', 'Role berhasil diubah!');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('password123');
        $user->save();
        return back()->with('success', 'Password berhasil direset ke: password123');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }

    // Export users ke Excel
    public function export()
    {
    return Excel::download(new UsersExport, 'users.xlsx');
    }

    // Import users dari Excel
    public function import(Request $request)
    {
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);
    Excel::import(new UsersImport, $request->file('file'));
    return back()->with('success', 'Import user berhasil!');
    }
}
