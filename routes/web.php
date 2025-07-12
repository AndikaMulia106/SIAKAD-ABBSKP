<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('landing');
});

// Auth Routes
Auth::routes();

// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Kontak Route
Route::view('/kontak', 'kontak');

/* Admin Routes */
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('manage-users', [App\Http\Controllers\Admin\DashboardController::class, 'manageUsers'])->name('admin.manageUsers');
        Route::post('/reset-password/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'resetPassword'])->name('admin.resetPassword');
        Route::get('/landing-edit', [App\Http\Controllers\Admin\LandingController::class, 'edit'])->name('admin.landing.edit');
        Route::post('/landing-edit', [App\Http\Controllers\Admin\LandingController::class, 'update'])->name('admin.landing.update');
        Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::patch('users/{user}/role', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.updateRole');
        Route::post('reset-password/{id}', [App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('admin.resetPassword');
        Route::delete('users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('admin/users/import', [App\Http\Controllers\Admin\UserController::class, 'import'])->name('admin.users.import');
        Route::get('admin/users/export', [App\Http\Controllers\Admin\UserController::class, 'export'])->name('admin.users.export');
    });

/* Guru Routes */
Route::prefix('guru')
    ->middleware(['auth', 'role:guru'])
    ->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('guru.dashboard');
        Route::resource('nilai', App\Http\Controllers\Guru\NilaiController::class, [
            'names' => [
                'index' => 'guru.nilai.index',
                'create' => 'guru.nilai.create',
                'store' => 'guru.nilai.store',
                'edit' => 'guru.nilai.edit',
                'update' => 'guru.nilai.update',
                'destroy' => 'guru.nilai.destroy',
                'show' => 'guru.nilai.show',
            ]
        ]);
        Route::post('/guru/nilai/import', [\App\Http\Controllers\Guru\NilaiController::class, 'import'])->name('guru.nilai.import');
    });

/* Siswa Routes */
Route::prefix('siswa')
    ->middleware(['auth', 'role:siswa'])
    ->group(function () {
        Route::get('profil', [App\Http\Controllers\Siswa\ProfilController::class, 'show'])->name('siswa.profil');
        Route::get('edit-profil', [App\Http\Controllers\Siswa\ProfilController::class, 'edit'])->name('siswa.editProfil');
        Route::put('update-profil', [App\Http\Controllers\Siswa\ProfilController::class, 'update'])->name('siswa.updateProfil');
    });

