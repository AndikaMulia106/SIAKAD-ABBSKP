@extends('layouts.tailwind-app')

@section('title', 'Daftar Nilai Siswa')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Nilai Siswa</h1>
    <a href="{{ route('guru.nilai.create') }}" class="bg-gradient-primary text-white px-4 py-2 rounded shadow hover:opacity-90 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Nilai
    </a>
</div>

{{-- Filter Form --}}
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
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
            <label class="block text-gray-700 mb-1">Tahun Ajaran</label>
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

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Nama Siswa</th>
                    <th class="px-4 py-2 text-left">Mata Pelajaran</th>
                    <th class="px-4 py-2 text-left">Nilai</th>
                    <th class="px-4 py-2 text-left">Semester</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilai as $n)
                <tr>
                    <td class="px-4 py-2">{{ $n->siswa->nama }}</td>
                    <td class="px-4 py-2">{{ $n->mapel->nama }}</td>
                    <td class="px-4 py-2">{{ $n->nilai }}</td>
                    <td class="px-4 py-2">{{ $n->semester }}</td>
                    <td class="px-4 py-2">
                        <a href="#" class="text-yellow-600 hover:underline"><i class="fas fa-edit"></i> Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $nilai->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection