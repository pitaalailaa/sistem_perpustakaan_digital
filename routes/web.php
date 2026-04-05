<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ================= HALAMAN AWAL =================
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }
        if (auth()->user()->role === 'admin') {
            return redirect()->route('kepala.dashboard');
        }
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

// ================= ANGGOTA =================
Route::middleware(['auth'])->group(function () {

    Route::get('/anggota', [AnggotaController::class, 'dashboard'])->name('dashboard');

    Route::get('/biodata', [AnggotaController::class, 'biodata'])->name('biodata');
    Route::post('/biodata', [AnggotaController::class, 'updateBiodata'])->name('biodata.update');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku');
    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');
    Route::post('/buku/{id}/pinjam', [AnggotaController::class, 'pinjam'])->name('buku.pinjam');

    Route::get('/peminjaman', [AnggotaController::class, 'peminjaman'])->name('peminjaman');
    Route::post('/peminjaman/{id}/kembali', [AnggotaController::class, 'kembalikan'])->name('peminjaman.kembali');

    Route::get('/pengembalian', [AnggotaController::class, 'pengembalian'])->name('pengembalian');
});

// ================= PETUGAS =================
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {

    // dashboard
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');

    // biodata
    Route::get('/biodata', [PetugasController::class, 'biodata'])->name('petugas.biodata');
    Route::post('/biodata', [PetugasController::class, 'updateBiodata'])->name('petugas.biodata.update');

    // ===== BUKU =====
    Route::get('/buku', [PetugasController::class, 'buku'])->name('petugas.buku');
    Route::get('/buku/create', [PetugasController::class, 'createBuku'])->name('petugas.buku.create');
    Route::post('/buku', [PetugasController::class, 'storeBuku'])->name('petugas.buku.store');
    Route::get('/buku/{id}/edit', [PetugasController::class, 'editBuku'])->name('petugas.buku.edit');
    Route::put('/buku/{id}', [PetugasController::class, 'updateBuku'])->name('petugas.buku.update');
    Route::delete('/buku/{id}', [PetugasController::class, 'destroyBuku'])->name('petugas.buku.destroy');

    // ===== KATEGORI (FIX DI SINI 🔥) =====
    Route::post('/kategori', [PetugasController::class, 'storeKategori'])->name('kategori.store');
    Route::put('/kategori/{id}', [PetugasController::class, 'updateKategori'])->name('kategori.update');
    Route::delete('/kategori/{id}', [PetugasController::class, 'deleteKategori'])->name('kategori.destroy');

    // ===== ANGGOTA =====
    Route::get('/anggota', [PetugasController::class, 'anggota'])->name('petugas.anggota');

    // ===== PEMINJAMAN =====
    Route::get('/peminjaman', [PetugasController::class, 'peminjaman'])->name('petugas.peminjaman');
    Route::post('/peminjaman/{id}/konfirmasi', [PetugasController::class, 'konfirmasiPeminjaman'])->name('petugas.peminjaman.konfirmasi');

    // ===== PENGEMBALIAN =====
    Route::get('/pengembalian', [PetugasController::class, 'pengembalian'])->name('petugas.pengembalian');
    Route::post('/pengembalian/{id}/konfirmasi', [PetugasController::class, 'konfirmasiPengembalian'])->name('petugas.pengembalian.konfirmasi');
});

// ================= KEPALA =================
Route::middleware(['auth', 'role:admin'])->prefix('kepala')->group(function () {

    Route::get('/dashboard', [KepalaController::class, 'dashboard'])->name('kepala.dashboard');

    // biodata
    Route::get('/biodata', [KepalaController::class, 'biodata'])->name('kepala.biodata');
    Route::get('/laporan', [KepalaController::class, 'laporan'])->name('kepala.laporan');
    Route::get('/buku', [KepalaController::class, 'buku'])->name('kepala.buku');
    Route::get('/anggota', [KepalaController::class, 'anggotaList'])->name('kepala.anggota');

    Route::get('/petugas', [KepalaController::class, 'petugasList'])->name('kepala.petugas');
    Route::get('/petugas/create', [KepalaController::class, 'createPetugas'])->name('kepala.petugas.create');
    Route::post('/petugas', [KepalaController::class, 'storePetugas'])->name('kepala.petugas.store');
});