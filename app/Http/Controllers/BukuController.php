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

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.anggota.detail-buku', compact('buku'));
    }

    public function index(Request $request)
    {
        $q = $request->query('q');
        $kategori = $request->query('kategori');

        $query = Buku::query();

        if ($q) {
            $query->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%{$q}%")
                   ->orWhere('judul', 'like', "%{$q}%")
                   ->orWhere('author', 'like', "%{$q}%")
                   ->orWhere('penulis', 'like', "%{$q}%");
            });
        }

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $bukus = $query->orderBy('judul')->orderBy('title')->get();

        $user = Auth::user();

        $requestedBooks = Peminjaman::whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
            ->pluck('buku_id')
            ->toArray();

        $userPeminjaman = Peminjaman::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'dipinjam', 'request_kembali'])
            ->get()
            ->keyBy('buku_id');

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

    // ✅ PINDAH KE SINI (DI LUAR INDEX)
    public function store(Request $request)
    {
        $fileName = null;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
        }

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'cover' => $fileName,
        ]);

        return redirect()->route('buku');
    }
}