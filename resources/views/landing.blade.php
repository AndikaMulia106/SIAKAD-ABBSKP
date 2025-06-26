<?php
use Illuminate\Support\Facades\Storage;
?>
@php
    $data = [];
    if (Storage::exists('landing.json')) {
        $data = json_decode(Storage::get('landing.json'), true);
    }
    $hero_title = $data['hero_title'] ?? 'Sistem Informasi Akademik Terpadu';
    $hero_desc = $data['hero_desc'] ?? 'Platform digital untuk manajemen pembelajaran, penilaian, dan administrasi sekolah';
    $siswa = $data['siswa'] ?? '0';
    $guru = $data['guru'] ?? '0';
    $mapel = $data['mapel'] ?? '0';
    $kelas = $data['kelas'] ?? '0';
    $activities = $data['activities'] ?? [];
    $quick_actions = $data['quick_actions'] ?? [];
    $quick_links = $data['quick_links'] ?? [];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD SMAIT Abu Bakar - Demo Konsep</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('partials.custom-style')
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-gradient-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-school text-2xl"></i>
                <h1 class="text-xl font-bold">SIAKAD SMAIT Abu Bakar</h1>
            </div>
            <div>
                @auth
                    @php
                        if(auth()->user()->hasRole('admin')) {
                            $homeUrl = route('admin.dashboard');
                        } elseif(auth()->user()->hasRole('guru')) {
                            $homeUrl = route('guru.dashboard');
                        } elseif(auth()->user()->hasRole('siswa')) {
                            $homeUrl = route('siswa.profil');
                        } else {
                            $homeUrl = url('/');
                        }
                    @endphp
                    <a href="{{ $homeUrl }}" class="bg-white text-blue-700 font-semibold px-4 py-2 rounded shadow hover:bg-blue-100 transition mr-4">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-700 font-semibold px-4 py-2 rounded shadow hover:bg-blue-100 transition ml-4">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-white py-12">
        <div class="container mx-auto px-4 text-center animate-fadein">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $hero_title }}</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ $hero_desc }}</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="card-hover bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Siswa Terdaftar</h3>
                    <p class="text-2xl font-bold">{{ $siswa }}</p>
                </div>
            </div>
            <div class="card-hover bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Guru</h3>
                    <p class="text-2xl font-bold">{{ $guru }}</p>
                </div>
            </div>
            <div class="card-hover bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-book text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Mata Pelajaran</h3>
                    <p class="text-2xl font-bold">{{ $mapel }}</p>
                </div>
            </div>
            <div class="card-hover bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-calendar-alt text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Kelas Aktif</h3>
                    <p class="text-2xl font-bold">{{ $kelas }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Aktivitas Terkini</h2>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="divide-y divide-gray-200">
                    @foreach($activities as $act)
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-center space-x-3">
                                <div class="bg-{{ $act['color'] ?? 'blue' }}-100 p-2 rounded-full">
                                    <i class="fas {{ $act['icon'] ?? 'fa-bookmark' }} text-{{ $act['color'] ?? 'blue' }}-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">{{ $act['text'] ?? '' }}</p>
                                    <p class="text-sm text-gray-500">{{ $act['time'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        <!-- Quick Actions -->
        <section class="mt-12 mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Aksi Cepat</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a
                    @auth
                        href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : (auth()->user()->hasRole('guru') ? route('guru.dashboard') : (auth()->user()->hasRole('siswa') ? route('siswa.profil') : url('/'))) }}"
                    @else
                        href="{{ route('login') }}"
                    @endauth
                    class="card-hover bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center space-y-2 transition hover:bg-blue-50"
                >
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-sign-in-alt text-blue-600 text-xl"></i>
                    </div>
                    <span class="font-medium">
                        @auth Dashboard @else Login @endauth
                    </span>
                </a>
                <a href="{{ url('/panduan') }}" class="card-hover bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center space-y-2 transition hover:bg-green-50">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-book-open text-green-600 text-xl"></i>
                    </div>
                    <span class="font-medium">Panduan</span>
                </a>
                <a href="{{ url('/jadwal') }}" class="card-hover bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center space-y-2 transition hover:bg-yellow-50">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-calendar-alt text-yellow-600 text-xl"></i>
                    </div>
                    <span class="font-medium">Jadwal</span>
                </a>
                <a href="{{ url('/kontak') }}" class="card-hover bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center space-y-2 transition hover:bg-purple-50">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-phone-alt text-purple-600 text-xl"></i>
                    </div>
                    <span class="font-medium">Kontak</span>
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">SIAKAD SMAIT Abu Bakar</h3>
                    <p class="text-gray-400">Sistem Informasi Akademik Terpadu</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h4 class="font-bold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2">
                            @foreach($quick_links as $link)
                                <li>
                                    <a href="{{ $link['url'] ?? '#' }}" class="text-gray-400 hover:text-white transition">
                                        {{ $link['label'] ?? '' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Bantuan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Panduan</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Sosial Media</h4>
                        <div class="flex space-x-4">
                            <a href="https://abbskp.sch.id/" class="text-gray-400 hover:text-white transition"><i class="fas fa-globe"></i></a>
                            <a href="https://www.instagram.com/smaitabubakarkp?igsh=OGw2NGViYmV3bXFs" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                            <a href="https://youtube.com/@smaitabbskp?si=IgDCIwit0CJTwvFA" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 SMAIT Abu Bakar. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-fadein');
            animateElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s ease';
                });
            });
        });
    </script>
</body>