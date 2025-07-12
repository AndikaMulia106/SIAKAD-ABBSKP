<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIAKAD SMAIT Abu Bakar')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('partials.custom-style')
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gradient-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                @auth
                <!-- Hamburger Button: di dalam navbar, sejajar logo -->
                <button id="sidebarToggle"
                    class="bg-blue-600 text-white rounded-full p-2 shadow hover:bg-blue-700 focus:outline-none mr-2"
                    title="Menu">
                    <i class="fas fa-bars"></i>
                </button>
                @endauth
                <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <i class="fas fa-school text-2xl"></i>
                    <h1 class="text-xl font-bold">SIAKAD SMAIT Abu Bakar</h1>
                </a>
            </div>
            <div class="relative">
            @auth
                @php
                    if(auth()->user()->hasRole('admin')) {
                        $dashboardUrl = route('admin.dashboard');
                    } elseif(auth()->user()->hasRole('guru')) {
                        $dashboardUrl = route('guru.dashboard');
                    } elseif(auth()->user()->hasRole('siswa')) {
                        $dashboardUrl = route('siswa.profil');
                    } else {
                        $dashboardUrl = url('/');
                    }
                @endphp
                <button id="userDropdownBtn" class="font-semibold px-4 py-2 rounded hover:bg-white hover:text-blue-700 transition focus:outline-none flex items-center">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-caret-down ml-2"></i>
                </button>
                <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded shadow-lg z-50">
                    <a href="{{ $dashboardUrl }}" class="block px-4 py-2 hover:bg-blue-50">Profil</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form-dropdown">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-blue-50">Logout</button>
                    </form>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const btn = document.getElementById('userDropdownBtn');
                        const menu = document.getElementById('userDropdownMenu');
                        btn.addEventListener('click', function (e) {
                            e.stopPropagation();
                            menu.classList.toggle('hidden');
                        });
                        document.addEventListener('click', function () {
                            menu.classList.add('hidden');
                        });
                    });
                </script>
            @else
                <a href="{{ route('login') }}" class="bg-white text-blue-700 font-semibold px-4 py-2 rounded shadow hover:bg-blue-100 transition ml-4">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            @endauth
            </div>
        </div>
    </nav>

    <div class="flex flex-1 min-h-0">
        @auth
        <!-- Overlay: muncul saat sidebar terbuka -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden"></div>

        <!-- Sidebar: hidden by default, muncul di atas konten -->
        <aside id="sidebar"
            class="fixed top-0 left-0 z-50 h-full w-64 bg-white shadow-lg border-r py-8 px-4 flex flex-col transition-transform duration-300 -translate-x-full"
            style="min-width:16rem;">
            <nav class="mt-8 space-y-2">
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="sidebar-text">Dashboard Admin</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span class="sidebar-text">Kelola Pengguna</span>
                    </a>
                    <a href="{{ route('admin.landing.edit') }}" class="sidebar-link {{ request()->routeIs('admin.landing.edit') ? 'active' : '' }}">
                        <i class="fas fa-edit"></i>
                        <span class="sidebar-text">Edit Landing Page</span>
                    </a>
                @elseif(auth()->user()->hasRole('guru'))
                    <a href="{{ route('guru.dashboard') }}" class="sidebar-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="sidebar-text">Dashboard Guru</span>
                    </a>
                    <a href="{{ route('guru.nilai.index') }}" class="sidebar-link {{ request()->routeIs('guru.nilai.index') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span class="sidebar-text">Lihat Nilai</span>
                    </a>
                    <a href="{{ route('guru.nilai.create') }}" class="sidebar-link {{ request()->routeIs('guru.nilai.create') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i>
                        <span class="sidebar-text">Input Nilai</span>
                    </a>
                @elseif(auth()->user()->hasRole('siswa'))
                    <a href="{{ route('siswa.profil') }}" class="sidebar-link {{ request()->routeIs('siswa.profil') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span class="sidebar-text">Profil Siswa</span>
                    </a>
                @endif
            </nav>
        </aside>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.getElementById('sidebarToggle');
                const overlay = document.getElementById('sidebarOverlay');

                function openSidebar() {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                }
                function closeSidebar() {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }

                toggleBtn && toggleBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    openSidebar();
                });
                overlay && overlay.addEventListener('click', function () {
                    closeSidebar();
                });
                document.addEventListener('keydown', function(e) {
                    if (e.key === "Escape") closeSidebar();
                });
            });
        </script>
        <style>
            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.5rem 0.75rem;
                border-radius: 0.375rem;
                transition: background 0.2s;
            }
            .sidebar-link:hover {
                background: #e0e7ff;
            }
            .sidebar-link.active {
                background: #f0f5ff;
                font-weight: bold;
            }
            .sidebar-text {
                transition: all 0.2s;
                white-space: nowrap;
            }
        </style>
        @endauth

        {{-- Main Content --}}
        <main class="flex-1 container mx-auto px-4 py-8">
            @yield('content')
        </main>
    </div>

    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto text-center text-gray-400 text-sm">
            &copy; 2023 SMAIT Abu Bakar. All rights reserved.
        </div>
    </footer>