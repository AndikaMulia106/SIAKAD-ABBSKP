@extends('layouts.tailwind-app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Pengguna</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Import & Export Excel -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center gap-4 mb-2">
            <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                @csrf
                <label class="text-sm font-semibold">Import User (Excel):</label>
                <input type="file" name="file" accept=".xlsx,.xls" required class="border px-2 py-1 rounded text-xs">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition text-xs flex items-center">
                    <i class="fas fa-file-import mr-1"></i> Import
                </button>
            </form>
            <a href="{{ route('admin.users.export') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-xs flex items-center">
                <i class="fas fa-file-export mr-1"></i> Export User
            </a>
        </div>
        <div class="text-xs text-gray-500 mt-2">
            <b>Format Excel:</b> Kolom <code>name</code>, <code>email</code>, <code>password</code>, <code>role</code>.<br>
            Contoh: <code>admin</code>, <code>guru</code>, <code>siswa</code> untuk kolom role.
        </div>
    </div>
    <!-- Form Tambah User -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('admin.users.store') }}" method="POST" class="flex flex-wrap gap-4 items-end">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1 text-sm">Nama</label>
                <input type="text" name="name" required class="px-3 py-2 border rounded w-48">
            </div>
            <div>
                <label class="block text-gray-700 mb-1 text-sm">Email</label>
                <input type="email" name="email" required class="px-3 py-2 border rounded w-48">
            </div>
            <div>
                <label class="block text-gray-700 mb-1 text-sm">Password</label>
                <input type="password" name="password" required class="px-3 py-2 border rounded w-48">
            </div>
            <div>
                <label class="block text-gray-700 mb-1 text-sm">Role</label>
                <select name="role" required class="px-3 py-2 border rounded w-40">
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                <i class="fas fa-user-plus mr-1"></i> Tambah User
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="px-2 py-1 border rounded text-xs">
                                    <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                                    <option value="guru" @if($user->hasRole('guru')) selected @endif>Guru</option>
                                    <option value="siswa" @if($user->hasRole('siswa')) selected @endif>Siswa</option>
                                </select>
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs">
                                    Simpan
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <form action="{{ route('admin.resetPassword', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-key mr-1"></i> Reset Password
                                </button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection