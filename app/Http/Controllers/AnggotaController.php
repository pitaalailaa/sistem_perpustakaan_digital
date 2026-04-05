<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;

/**
 * AnggotaController
 * Mengelola aktivitas anggota (member): dashboard, biodata, peminjaman buku, dan pengembalian
 */
class AnggotaController extends Controller
{
    /**
     * Dashboard - Tampilkan statistik dan riwayat peminjaman terbaru
     */
    public function dashboard()
    {
        $user = Auth::user();

        $totalBuku = Buku::count();
        $dipinjam = Peminjaman::where('user_id', $user->id)->where('status', 'dipinjam')->count();
        $dikembalikan = Peminjaman::where('user_id', $user->id)->where('status', 'kembali')->count();
        $totalDenda = Peminjaman::where('user_id', $user->id)->sum('denda');

        $recentPeminjamans = Peminjaman::with('buku')
            ->where('user_id', $user->id)
            ->latest('borrowed_at')
            ->take(5)
            ->get();

        return view('page.anggota.dashboard', compact('user', 'totalBuku', 'dipinjam', 'dikembalikan', 'totalDenda', 'recentPeminjamans'));
    }

    /**
     * Biodata - Halaman edit profil anggota
     */
    public function biodata()
    {
        $user = Auth::user();
        return view('page.anggota.biodata', compact('user'));
    }

    /**
     * Update Biodata - Simpan perubahan data profil (nama, email, kelas, telepon, password)
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
     * Peminjaman - Riwayat semua peminjaman user
     */
    public function peminjaman()
    {
        $user = Auth::user();

        $peminjamans = Peminjaman::with('buku')
            ->where('user_id', $user->id)
            ->orderByDesc('borrowed_at')
            ->get();

        return view('page.anggota.peminjaman', compact('peminjamans', 'user'));
    }

    /**
     * Pengembalian - Tampilkan status buku yang sedang dalam proses pengembalian
     */
    public function pengembalian()
    {
        $user = Auth::user();

        $peminjamans = Peminjaman::with('buku')
            ->where('user_id', $user->id)
            ->whereIn('status', ['request_kembali', 'dikembalikan'])
            ->orderByDesc('returned_at')
            ->get();

        return view('page.anggota.pengembalian', compact('peminjamans', 'user'));
    }

    /**
     * Pinjam - Request peminjaman buku dengan validasi
     * Validasi: status buku, limit peminjaman, ketersediaan buku
     */
    public function pinjam($id)
    {
        $user = Auth::user();
        $buku = Buku::findOrFail($id);

        if ($buku->status !== 'tersedia') {
            return back()->with('error', 'Buku sedang tidak tersedia untuk dipinjam.');
        }

        $existingLoan = Peminjaman::where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->count();

        if ($existingLoan >= 5) {
            return back()->with('error', 'Anda tidak boleh meminjam lebih dari 5 buku sekaligus.');
        }

        $hasExistingRequest = Peminjaman::where('buku_id', $id)
            ->whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
            ->exists();

        if ($hasExistingRequest) {
            return back()->with('error', 'Buku ini telah sedang dalam proses peminjaman. Silakan pilih buku lain.');
        }

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $id,
            'borrowed_at' => null,
            'due_date' => null,
            'status' => 'pending',
            'denda' => 0,
        ]);

        return back()->with('success', 'Permintaan peminjaman dikirim, menunggu persetujuan petugas.');
    }

    /**
     * Konfirmasi Peminjaman - Digunakan oleh sistem untuk finalisasi peminjaman yang disetujui
     */
    public function konfirmasiPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('info', 'Sudah diproses.');
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
     * Kembalikan - Anggota request pengembalian buku (menunggu konfirmasi petugas)
     */
    public function kembalikan($id)
    {
        $user = Auth::user();

        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->firstOrFail();

        $peminjaman->update([
            'status' => 'request_kembali',
        ]);

        return redirect()->route('peminjaman')->with('success', 'Permintaan pengembalian terkirim. Menunggu persetujuan petugas.');
    }
}
