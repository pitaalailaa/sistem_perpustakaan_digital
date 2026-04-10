<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

/**
 * KepalaController
 * Mengelola aktivitas kepala perpustakaan: dashboard, biodata, laporan, 
 * manajemen data buku, anggota, petugas
 */
class KepalaController extends Controller
{
    /**
     * Dashboard - Tampilkan overview statistik perpustakaan
     */
    public function dashboard()
    {
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalPeminjaman = Peminjaman::count();
        $totalBelumKembali = Peminjaman::where('status', 'dipinjam')->count();

        $recentPeminjaman = Peminjaman::with(['user', 'buku'])
            ->latest('borrowed_at')
            ->take(6)
            ->get();

        return view('page.kepala.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalBelumKembali',
            'recentPeminjaman'
        ));
    }

    /**
     * Biodata - Halaman edit profil kepala
     */
    public function biodata()
    {
        $user = Auth::user();
        return view('page.kepala.biodata', compact('user'));
    }

    /**
     * Laporan - Generate laporan komprehensif dengan statistik dan analisis
     * Menampilkan: total buku/anggota/petugas, buku terpopuler, anggota paling aktif, 
     * total denda, dan transaksi terakhir
     */
    public function laporan()
    {
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $totalPeminjaman = Peminjaman::count();
        
        $topBook = Peminjaman::select('buku_id')
            ->with('buku')
            ->selectRaw('count(*) as total')
            ->groupBy('buku_id')
            ->orderByDesc('total')
            ->first();

        $topUser = Peminjaman::select('user_id')
            ->with('user')
            ->selectRaw('count(*) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->first();

        $belumKembali = Peminjaman::where('status', 'dipinjam')->count();
        $totalDenda = Peminjaman::sum('denda');

        $recent = Peminjaman::with(['user','buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('page.kepala.laporan', compact(
             'totalBuku',
            'totalAnggota',
            'totalPetugas',
            'totalPeminjaman',
            'topBook',
            'topUser',
            'belumKembali',
            'totalDenda',
            'recent'
        ));
    }

    /**
     * List Buku - Tampilkan semua data buku dengan kategorinya
     */
    public function buku()
    {
        $books = Buku::with('category')->get();
        $kategoris = Category::all();

        return view('page.kepala.data-buku', compact('books', 'kategoris'));
    }

    /**
     * List Anggota - Tampilkan semua anggota perpustakaan
     */
    public function anggotaList()
    {
        $anggota = User::where('role', 'anggota')->get();
        return view('page.kepala.data-anggota', compact('anggota'));
    }

    /**
     * List Petugas - Tampilkan semua petugas perpustakaan
     */
    public function petugasList()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('page.kepala.data-petugas', compact('petugas'));
    }

    /**
     * Form Tambah Petugas - Halaman form untuk membuat petugas baru
     */
    public function createPetugas()
    {
        return view('page.kepala.petugas-create');
    }

    /**
     * Store Petugas - Simpan petugas baru ke database
     */
    public function storePetugas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('kepala.petugas')->with('success', 'Petugas berhasil ditambahkan');
    }
}
