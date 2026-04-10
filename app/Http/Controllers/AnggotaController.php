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
        $totalDenda = Peminjaman::where('user_id', $user->id)
            ->get()
            ->sum('outstanding_denda');

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

   public function pinjam(Request $request, $id)
{
    $user = Auth::user();
    $buku = Buku::findOrFail($id);

    // ✅ validasi tanggal wajib diisi
    if ($buku->status !== 'tersedia') {
        return back()->with('error', 'Buku sedang tidak tersedia untuk dipinjam.');
    }

    if (($buku->stock ?? 0) < 1) {
        return back()->with('error', 'Stok buku sedang habis.');
    }

    $existingLoan = Peminjaman::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
        ->get();

    if ($existingLoan->contains('buku_id', (int) $id)) {
        return back()->with('error', 'Anda masih memiliki pinjaman aktif untuk buku ini.');
    }

    if ($existingLoan->count() >= 2) {
        return back()->with('error', 'Anda hanya bisa meminjam maksimal 2 buku berbeda sekaligus.');
    }

    $hasExistingRequest = Peminjaman::where('buku_id', $id)
        ->whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
        ->exists();

    if ($hasExistingRequest) {
        return back()->with('error', 'Buku ini telah sedang dalam proses peminjaman.');
    }

    // 🔥 HITUNG DUE DATE (5 HARI)
    $tanggalPinjam = Carbon::today();
    $dueDate = $tanggalPinjam->copy()->addDays(5);

    // 🔥 SIMPAN
    Peminjaman::create([
        'user_id' => $user->id,
        'buku_id' => $id,
        'borrowed_at' => $tanggalPinjam,
        'due_date' => $dueDate,
        'status' => 'pending',
        'denda' => 0,
        'is_denda_paid' => false,
    ]);

    $stockAfterRequest = max(0, ((int) $buku->stock) - 1);
    $buku->update([
        'stock' => $stockAfterRequest,
        'status' => $stockAfterRequest > 0 ? 'tersedia' : 'dipinjam',
        'available' => $stockAfterRequest > 0 ? 1 : 0,
    ]);

    return redirect()->route('buku')->with('success', 'Permintaan peminjaman dikirim. Menunggu persetujuan petugas.');
}

    /**
     * Bayar Denda - Menandai denda anggota sebagai lunas jika sudah terlambat
     */
    public function bayarDenda($id)
    {
        $user = Auth::user();

        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($peminjaman->is_denda_paid) {
            return back()->with('info', 'Denda untuk buku ini sudah dibayar.');
        }

        if ($peminjaman->outstanding_denda <= 0) {
            return back()->with('info', 'Belum ada denda yang perlu dibayar.');
        }

        $peminjaman->update([
            'denda' => $peminjaman->calculated_denda,
            'is_denda_paid' => true,
            'denda_paid_at' => now(),
        ]);

        return back()->with('success', 'Denda berhasil dibayar.');
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
