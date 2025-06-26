@extends('layouts.tailwind-app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Guru</h1>

    <div class="flex gap-6 mb-8">
        <a href="{{ route('guru.nilai.create') }}"
           class="bg-gradient-primary text-white px-6 py-3 rounded shadow hover:opacity-90 transition font-semibold flex items-center gap-2">
            <i class="fas fa-plus"></i> Input Nilai
        </a>
        <a href="{{ route('guru.nilai.index') }}"
           class="bg-blue-600 text-white px-6 py-3 rounded shadow hover:opacity-90 transition font-semibold flex items-center gap-2">
            <i class="fas fa-list"></i> Lihat Nilai
        </a>
    </div>

    @if(request()->routeIs('guru.nilai.index'))
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('guru.nilai.index') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-gray-700 mb-1">Nama Siswa</label>
                <input type="text" name="nama_siswa" value="{{ request('nama_siswa') }}" class="px-3 py-2 border rounded w-48" placeholder="Cari nama siswa">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Kelas</label>
                <select name="kelas_id" class="px-3 py-2 border rounded w-40">
                    <option value="">Semua Kelas</option>
                    @foreach($daftarKelas as $kelas)
                        <option value="{{ $kelas->id }}" @if(request('kelas_id') == $kelas->id) selected @endif>{{ $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Mata Pelajaran</label>
                <select name="mapel_id" class="px-3 py-2 border rounded w-40">
                    <option value="">Semua Mapel</option>
                    @foreach($daftarMapel as $mapel)
                        <option value="{{ $mapel->id }}" @if(request('mapel_id') == $mapel->id) selected @endif>{{ $mapel->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Tahun Pelajaran</label>
                <select name="tahun_ajaran" class="px-3 py-2 border rounded w-40">
                    <option value="">Semua Tahun</option>
                    @foreach($daftarTahunAjaran as $tahun)
                        <option value="{{ $tahun->nama }}" @if(request('tahun_ajaran') == $tahun->nama) selected @endif>{{ $tahun->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-gradient-primary text-white px-5 py-2 rounded shadow hover:opacity-90 transition">
                <i class="fas fa-filter"></i> Filter
            </button>
        </form>
    </div>
    @endif

    {{-- Konten lain bisa ditambahkan di sini --}}
</div>
@endsection