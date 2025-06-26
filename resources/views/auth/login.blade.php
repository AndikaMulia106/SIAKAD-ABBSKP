<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD SMAIT Abu Bakar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('partials.custom-style')
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gradient-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:text-blue-200 transition">
                <i class="fas fa-school text-2xl"></i>
                <h1 class="text-xl font-bold">SIAKAD SMAIT Abu Bakar</h1>
            </a>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 mt-8 animate-fadein">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login ke SIAKAD</h2>
            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle mr-1"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required autofocus>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4 flex items-center">
                    <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-gray-700">Ingat saya</label>
                </div>
                <button type="submit" class="w-full bg-gradient-primary text-white font-semibold py-2 rounded hover:opacity-90 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
                @if (Route::has('password.request'))
                    <div class="text-right mt-3">
                        <a class="text-blue-600 hover:underline text-sm" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    </div>
                @endif
            </form>
            <div class="mt-6 text-center text-gray-600 text-sm">
                Belum punya akun?
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto text-center text-gray-400 text-sm">
            &copy; 2023 SMAIT Abu Bakar. All rights reserved.
        </div>
    </footer>
</body>
</html>