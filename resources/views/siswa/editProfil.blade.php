@extends('layouts.tailwind-app')

@section('title', 'Edit Profil Siswa')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-8">
    <h1 class="text-2xl font-bold mb-6">Edit Profil Siswa</h1>
    <form action="{{ route('siswa.updateProfil') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 mb-2">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $siswa->email) }}" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="nis" class="block text-gray-700 mb-2">NIS</label>
            <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-gray-700 mb-2">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border rounded" required>
                <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <hr class="my-6">
        <h2 class="text-lg font-bold mb-4">Ubah Password</h2>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">Password Baru</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded" minlength="8">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded" minlength="8">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
            <i class="fas fa-save mr-2"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection