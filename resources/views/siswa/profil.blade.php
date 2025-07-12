@extends('layouts.tailwind-app')

@section('title', 'Profil Siswa')

@section('content')
<div class="bg-white rounded-lg shadow-md p-8 flex flex-col md:flex-row gap-8">
    <div class="flex flex-col items-center md:w-1/3">
        <img src="{{ asset('img/student-icon.png') }}" class="rounded-full mb-4 w-32 h-32 object-cover" alt="Foto Profil">
        <h4 class="text-xl font-bold">{{ $siswa->nama ?? '-' }}</h4>
        <p class="text-gray-500">NIS: {{ $siswa->nis ?? '-' }}</p>
        <!-- Tombol Edit Profil -->
        <a href="{{ route('siswa.editProfil') }}" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow flex items-center gap-2">
            <i class="fas fa-edit"></i> Edit Profil
        </a>
    </div>
    <div class="md:w-2/3">
        <div class="mb-6">
            <h5 class="font-bold text-lg mb-2">Informasi Akademik</h5>
            <div class="flex flex-wrap gap-8">
                <div>
                    <span class="font-semibold">Kelas:</span> {{ $siswa->kelas->nama ?? '-' }}
                </div>
            </div>
        </div>
        <h5 class="font-bold text-lg mb-2">Rekap Nilai</h5>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Mata Pelajaran</th>
                        <th class="px-4 py-2 text-left">Nilai</th>
                        <th class="px-4 py-2 text-left">Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilais as $nilai)
                    <tr>
                        <td class="px-4 py-2">{{ $nilai->mapel->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $nilai->nilai ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $nilai->semester ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center text-gray-400">Belum ada data nilai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection