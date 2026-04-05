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
 * PetugasController
 * Mengelola aktivitas petugas: dashboard, biodata, manajemen buku, kategori, 
 * anggota, peminjaman, dan pengembalian buku
 */
class PetugasController extends Controller
{
    /**
     * Dashboard Petugas - Tampilkan statistik dan riwayat peminjaman terbaru
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

        return view('page.petugas.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalBelumKembali',
            'recentPeminjaman'
        ));
    }

    /**
     * Biodata - Halaman edit profil petugas
     */
    public function biodata()
    {
        $user = Auth::user();
        return view('page.petugas.biodata', compact('user'));
    }

    /**
     * Update Biodata - Simpan perubahan data profil petugas
     */
    public function updateBiodata(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'kelas' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->kelas = $request->kelas;
        $user->no_telp = $request->no_telp;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Biodata berhasil diperbarui.');
    }

    /**
     * Dashboard Kepala - Data overview untuk kepala perpustakaan (jika akses dari petugas)
     */
    public function kepalaDashboard()
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
     * Laporan Kepala - Generate laporan untuk kepala perpustakaan
     */
    public function kepalaLaporan()
    {
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $totalPeminjaman = Peminjaman::count();

        return view('page.kepala.laporan', compact(
            'totalBuku',
            'totalAnggota',
            'totalPetugas',
            'totalPeminjaman'
        ));
    }

    /**
     * List Buku untuk Kepala - Tampilkan semua buku dengan kategorinya
     */
    public function kepalaBuku()
    {
        $books = Buku::with('category')->get();
        $kategoris = Category::all();

        return view('page.kepala.data-buku', compact('books', 'kategoris'));
    }

    /**
     * List Petugas untuk Kepala - Tampilkan semua petugas dan admin
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
     * List Buku - Tampilkan semua buku dengan kategorinya
     */
    public function buku()
    {
        $books = Buku::with('category')->get();
        $kategoris = Category::all();

        return view('page.petugas.data-buku', compact('books', 'kategoris'));
    }

    /**
     * Form Tambah Buku - Halaman untuk input buku baru
     */
    public function createBuku()
    {
        $categories = Category::orderBy('name')->get();
        return view('page.petugas.buku-create', compact('categories'));
    }

    /**
     * Store Buku - Simpan buku baru ke database
     */
    public function storeBuku(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:tersedia,dipinjam',
        ]);

        Buku::create([
            'title' => $request->title,
            'author' => $request->author,
            'penulis' => $request->author,
            'kategori' => $request->category_id
                ? Category::find($request->category_id)->name
                : null,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'available' => $request->status == 'tersedia' ? 1 : 0,
        ]);

        return redirect()->route('petugas.buku')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Form Edit Buku - Halaman untuk edit data buku
     */
    public function editBuku($id)
    {
        $buku = Buku::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('page.petugas.buku-edit', compact('buku', 'categories'));
    }

    /**
     * Update Buku - Simpan perubahan data buku
     */
    public function updateBuku(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:tersedia,dipinjam',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->update([
            'title' => $request->title,
            'author' => $request->author,
            'penulis' => $request->author,
            'kategori' => $request->category_id
                ? Category::find($request->category_id)->name
                : $buku->kategori,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'available' => $request->status == 'tersedia' ? 1 : 0,
        ]);

        return redirect()->route('petugas.buku')->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Delete Buku - Hapus buku dari database
     */
    public function destroyBuku($id)
    {
        Buku::findOrFail($id)->delete();
        return redirect()->route('petugas.buku')->with('success', 'Buku berhasil dihapus');
    }

    /**
     * Store Kategori - Tambah kategori buku baru
     */
    public function storeKategori(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name']);
        Category::create(['name' => $request->name]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Update Kategori - Edit nama kategori
     */
    public function updateKategori(Request $request, $id)
    {
        $kategori = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $kategori->id
        ]);

        $kategori->update(['name' => $request->name]);

        return back()->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Delete Kategori - Hapus kategori
     */
    public function deleteKategori($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }

    /**
     * List Anggota - Tampilkan semua anggota perpustakaan
     */
    public function anggota()
    {
        $anggota = User::where('role', 'anggota')->get();
        return view('page.petugas.data-anggota', compact('anggota'));
    }

    /**
     * List Peminjaman - Tampilkan permintaan peminjaman yang pending dan riwayat
     */
    public function peminjaman()
    {
        $permintaan = Peminjaman::where('status', 'pending')->with(['user', 'buku'])->get();
        $riwayat = Peminjaman::whereIn('status', ['dipinjam', 'kembali', 'dikembalikan'])->with(['user', 'buku'])->get();
        return view('page.petugas.peminjaman', compact('permintaan', 'riwayat'));
    }

    /**
     * Konfirmasi Peminjaman - Setujui request peminjaman dari anggota
     * Update status menjadi 'dipinjam' dan set tanggal pinjam + due date
     */
    public function konfirmasiPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('info', 'Peminjaman sudah diproses.');
        }

        $peminjaman->update([
            'status' => 'dipinjam',
            'borrowed_at' => now(),
            'due_date' => now()->addDays(3),
        ]);

        if ($peminjaman->buku) {
            $peminjaman->buku->update([
                'status' => 'dipinjam',
                'available' => 0
            ]);
        }

        return back()->with('success', 'Peminjaman berhasil dikonfirmasi');
    }

    /**
     * List Pengembalian - Tampilkan permintaan pengembalian yang pending dan riwayat
     */
    public function pengembalian()
    {
        $permintaan = Peminjaman::where('status', 'request_kembali')->get();
        $riwayat = Peminjaman::where('status', 'dikembalikan')->get();

        return view('page.petugas.pengembalian', compact('permintaan', 'riwayat'));
    }

    /**
     * Konfirmasi Pengembalian - Terima pengembalian buku dan hitung denda jika ada
     * Update status menjadi 'dikembalikan' dan update status buku menjadi 'tersedia'
     */
    public function konfirmasiPengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'request_kembali') {
            return back()->with('info', 'Belum bisa dikonfirmasi.');
        }

        $dueDate = Carbon::parse($peminjaman->due_date);
        $returnedAt = Carbon::now();

        $denda = 0;
        if ($returnedAt->isAfter($dueDate)) {
            $daysLate = $dueDate->diffInDays($returnedAt);
            $denda = $daysLate * 3000;
        }

        $peminjaman->update([
            'returned_at' => now(),
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);

        if ($peminjaman->buku) {
            $peminjaman->buku->update([
                'status' => 'tersedia',
                'available' => 1
            ]);
        }

        return back()->with('success', 'Pengembalian berhasil');
    }
}