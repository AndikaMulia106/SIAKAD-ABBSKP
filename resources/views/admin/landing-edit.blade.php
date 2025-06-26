@extends('layouts.tailwind-app')

@section('title', 'Edit Landing Page ')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Landing Page</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.landing.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Judul Halaman</label>
            <input type="text" name="hero_title" value="{{ old('hero_title', $data['hero_title'] ?? '') }}"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Deskripsi Halaman</label>
            <textarea name="hero_desc" rows="2" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('hero_desc', $data['hero_desc'] ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Jumlah Siswa</label>
            <input type="number" name="siswa" value="{{ old('siswa', $data['siswa'] ?? 0) }}"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Jumlah Guru</label>
            <input type="number" name="guru" value="{{ old('guru', $data['guru'] ?? 0) }}"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Jumlah Mapel</label>
            <input type="number" name="mapel" value="{{ old('mapel', $data['mapel'] ?? 0) }}"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Jumlah Kelas</label>
            <input type="number" name="kelas" value="{{ old('kelas', $data['kelas'] ?? 0) }}"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        @php
            $iconOptions = [
                'fa-bookmark' => 'fa-bookmark',
                'fa-check-circle' => 'fa-check-circle',
                'fa-bullhorn' => 'fa-bullhorn',
                'fa-calendar' => 'fa-calendar',
                'fa-user' => 'fa-user',
                'fa-envelope' => 'fa-envelope',
            ];
            $colorOptions = [
                'blue' => 'Biru',
                'green' => 'Hijau',
                'purple' => 'Ungu',
                'yellow' => 'Kuning',
                'red' => 'Merah',
                'gray' => 'Abu-abu',
            ];
            $colorHex = [
                'blue' => '#3B82F6',
                'green' => '#22C55E',
                'purple' => '#A78BFA',
                'yellow' => '#FACC15',
                'red' => '#EF4444',
                'gray' => '#6B7280',
            ];
        @endphp

        <h2 class="font-bold text-lg mt-8 mb-2">Aktivitas Terkini</h2>
        @for($i = 0; $i < 3; $i++)
        <div class="mb-2 flex gap-2 items-center">
            <!-- Icon Dropdown with icon preview -->
            <select name="activities[{{ $i }}][icon]" class="px-2 py-1 border rounded w-1/6 font-awesome icon-dropdown" data-preview="icon-preview-{{ $i }}">
                @foreach($iconOptions as $icon => $label)
                    <option value="{{ $icon }}" data-icon="{{ $icon }}" @if(old('activities.'.$i.'.icon', $data['activities'][$i]['icon'] ?? 'fa-bookmark') == $icon) selected @endif>
                        &#xf02e; {{ $icon }}
                    </option>
                @endforeach
            </select>
            <span id="icon-preview-{{ $i }}" class="text-xl ml-1">
                <i class="fas {{ old('activities.'.$i.'.icon', $data['activities'][$i]['icon'] ?? 'fa-bookmark') }}"></i>
            </span>
            <!-- Color Dropdown with color preview -->
            <select name="activities[{{ $i }}][color]" class="px-2 py-1 border rounded w-1/6 color-dropdown" data-preview="color-preview-{{ $i }}">
                @foreach($colorOptions as $color => $label)
                    <option value="{{ $color }}" data-color="{{ $colorHex[$color] }}" @if(old('activities.'.$i.'.color', $data['activities'][$i]['color'] ?? 'blue') == $color) selected @endif
                        style="background: {{ $colorHex[$color] }}; color: #fff;">
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <span id="color-preview-{{ $i }}" class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center"
                  style="background: {{ $colorHex[old('activities.'.$i.'.color', $data['activities'][$i]['color'] ?? 'blue')] }};">
            </span>
            <!-- Text & Time -->
            <input type="text" name="activities[{{ $i }}][text]" placeholder="Deskripsi" value="{{ old('activities.'.$i.'.text', $data['activities'][$i]['text'] ?? '') }}" class="w-2/6 px-2 py-1 border rounded" />
            <input type="text" name="activities[{{ $i }}][time]" placeholder="Waktu" value="{{ old('activities.'.$i.'.time', $data['activities'][$i]['time'] ?? '') }}" class="w-2/6 px-2 py-1 border rounded" />
        </div>
        @endfor

        <h2 class="font-bold text-lg mt-8 mb-2">Tautan Cepat</h2>
        @for($i = 0; $i < 3; $i++)
        <div class="mb-2 flex gap-2">
            <input type="text" name="quick_links[{{ $i }}][label]" placeholder="Label" value="{{ old('quick_links.'.$i.'.label', $data['quick_links'][$i]['label'] ?? '') }}" class="w-1/2 px-2 py-1 border rounded" />
            <input type="text" name="quick_links[{{ $i }}][url]" placeholder="URL" value="{{ old('quick_links.'.$i.'.url', $data['quick_links'][$i]['url'] ?? '') }}" class="w-1/2 px-2 py-1 border rounded" />
        </div>
        @endfor

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Icon preview
            document.querySelectorAll('.icon-dropdown').forEach(function(select) {
                select.addEventListener('change', function() {
                    var previewId = this.getAttribute('data-preview');
                    var icon = this.value;
                    var preview = document.getElementById(previewId);
                    if(preview) {
                        preview.innerHTML = '<i class="fas ' + icon + '"></i>';
                    }
                });
            });
            // Color preview
            document.querySelectorAll('.color-dropdown').forEach(function(select) {
                select.addEventListener('change', function() {
                    var previewId = this.getAttribute('data-preview');
                    var color = this.options[this.selectedIndex].getAttribute('data-color');
                    var preview = document.getElementById(previewId);
                    if(preview) {
                        preview.style.background = color;
                    }
                });
            });
        });
        </script>

        <button type="submit" class="bg-gradient-primary text-white px-6 py-2 rounded shadow hover:opacity-90 transition mt-6">
            <i class="fas fa-save mr-2"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection