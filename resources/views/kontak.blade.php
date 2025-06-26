@extends('layouts.tailwind-app')

@section('title', 'Kontak')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8 mt-12 text-center">
    <h1 class="text-2xl font-bold mb-4">Kontak</h1>
    <p class="mb-6 text-gray-700">Nama: <span class="font-semibold">Andika Valentino</span></p>
    <a href="https://wa.me/6285866458480" target="_blank"
       class="inline-flex items-center px-5 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
        <i class="fab fa-whatsapp mr-2"></i> Hubungi Saya via WhatsApp
    </a>
</div>
@endsection