<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;

class BukuController extends Controller
{
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.anggota.detail-buku', compact('buku'));
    }

    public function index(Request $request)
    {
        $q = $request->query('q');
        $kategori = $request->query('kategori');

        $query = Buku::query();

        // 🔍 SEARCH
        if ($q) {
            $query->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%{$q}%")
                   ->orWhere('judul', 'like', "%{$q}%")
                   ->orWhere('author', 'like', "%{$q}%")
                   ->orWhere('penulis', 'like', "%{$q}%");
            });
        }

        // 📂 FILTER KATEGORI
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $bukus = $query->orderBy('judul')->orderBy('title')->get();

        // 🔥 AMBIL USER LOGIN
        $user = Auth::user();

        // 🔥 SEMUA BUKU YANG LAGI DIPROSES (GLOBAL)
        $requestedBooks = Peminjaman::whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
            ->pluck('buku_id')
            ->toArray();

        // 🔥 KHUSUS USER LOGIN
        $userPeminjaman = Peminjaman::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
            ->get()
            ->keyBy('buku_id');

        // 🔥 AMBIL KATEGORI UNIK
        $kategoris = Buku::distinct()->pluck('kategori')->filter()->sort();

        return view('page.anggota.cari-buku', compact(
            'bukus',
            'q',
            'kategori',
            'kategoris',
            'requestedBooks',
            'userPeminjaman'
        ));
    }
}