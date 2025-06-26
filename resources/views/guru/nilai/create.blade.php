    @extends('layouts.tailwind-app')

@section('title', 'Input Nilai Baru')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Input Nilai Baru</h1>
        <!-- Tombol Import -->
        <button onclick="document.getElementById('importModal').classList.remove('hidden')" type="button"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow flex items-center gap-2">
            <i class="fas fa-file-import"></i> Import Nilai
        </button>
    </div>

    <!-- Modal Import Nilai -->
    <div id="importModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button onclick="document.getElementById('importModal').classList.add('hidden')" type="button"
                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
            <h2 class="text-lg font-bold mb-4">Import Nilai (Excel/CSV)</h2>
            <form action="{{ route('guru.nilai.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                    class="block w-full mb-4 border rounded px-3 py-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    <i class="fas fa-upload mr-1"></i> Upload
                </button>
            </form>
            <div class="mt-4 text-sm text-gray-500">
                Format kolom: <b>Nama Siswa, Nama Kelas, Mata Pelajaran, Semester, Tahun Ajaran, Nilai</b>
            </div>
        </div>
    </div>

    <!-- Form manual input nilai -->
    <form action="{{ route('guru.nilai.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="siswa_id" class="block text-gray-700 mb-2">Siswa</label>
            <select class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="siswa_id" name="siswa_id" required onchange="updateKelasInfo()">
                <option value="">Pilih Siswa</option>
                @foreach($siswas as $siswa)
                <option value="{{ $siswa->id }}" data-kelas="{{ $siswa->kelas->nama ?? '-' }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Kelas</label>
            <input type="text" id="kelas_info" class="w-full px-4 py-2 border rounded bg-gray-100" value="-" readonly>
        </div>
        <div class="mb-4">
            <label for="mapel_id" class="block text-gray-700 mb-2">Mata Pelajaran</label>
            <select class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="mapel_id" name="mapel_id" required>
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($mapels as $mapel)
                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="semester" class="block text-gray-700 mb-2">Semester</label>
            <select class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="semester" name="semester" required>
                <option value="">Pilih Semester</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="tahun_ajaran" class="block text-gray-700 mb-2">Tahun Ajaran</label>
            <select class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="tahun_ajaran" name="tahun_ajaran" required>
                <option value="">Pilih Tahun Ajaran</option>
                @foreach($daftarTahunAjaran as $tahun)
                <option value="{{ $tahun->nama }}">{{ $tahun->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="nilai" class="block text-gray-700 mb-2">Nilai</label>
            <input type="number" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="nilai" name="nilai" min="0" max="100" required>
        </div>
        <button type="submit" class="bg-gradient-primary text-white px-6 py-2 rounded shadow hover:opacity-90 transition">
            <i class="fas fa-save mr-2"></i> Simpan
        </button>
    </form>
</div>
<script>
    function updateKelasInfo() {
        const select = document.getElementById('siswa_id');
        const kelasInfo = document.getElementById('kelas_info');
        const selected = select.options[select.selectedIndex];
        kelasInfo.value = selected.getAttribute('data-kelas') || '-';
    }
    document.addEventListener('DOMContentLoaded', updateKelasInfo);
</script>
@endsection