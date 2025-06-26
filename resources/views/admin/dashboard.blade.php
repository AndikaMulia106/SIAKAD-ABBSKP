@extends('layouts.tailwind-app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="card-hover bg-green-100 rounded-lg shadow-md p-6 flex flex-col items-center">
        <i class="fas fa-user-graduate text-green-600 text-3xl mb-2"></i>
        <div class="text-gray-700 font-semibold">Total Siswa</div>
        <div class="text-2xl font-bold">{{ $totalSiswa ?? 0 }}</div>
    </div>
    <div class="card-hover bg-blue-100 rounded-lg shadow-md p-6 flex flex-col items-center">
        <i class="fas fa-chalkboard-teacher text-blue-600 text-3xl mb-2"></i>
        <div class="text-gray-700 font-semibold">Total Guru</div>
        <div class="text-2xl font-bold">{{ $totalGuru ?? 0 }}</div>
    </div>
    <div class="card-hover bg-yellow-100 rounded-lg shadow-md p-6 flex flex-col items-center">
        <i class="fas fa-user-shield text-yellow-600 text-3xl mb-2"></i>
        <div class="text-gray-700 font-semibold">Total Admin</div>
        <div class="text-2xl font-bold">{{ $totalAdmin ?? 0 }}</div>
    </div>
</div>
<a href="{{ route('admin.manageUsers') }}" class="bg-gradient-primary text-white px-6 py-2 rounded shadow hover:opacity-90 transition inline-block">
    <i class="fas fa-users-cog mr-2"></i> Kelola Pengguna
</a>
<a href="{{ route('admin.landing.edit') }}" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600 transition inline-block mr-2">
    <i class="fas fa-edit mr-2"></i> Edit Landing Page
</a>

@endsection