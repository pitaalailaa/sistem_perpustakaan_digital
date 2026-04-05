<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        /* BACKGROUND */
        .background {
            background-color: #051031;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            width: 100%;
            height: 100px;
            background-color: #170a6b40;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 20px;
        }

        /* KIRI (LOGO + JUDUL) */
        .left-box {
            display: flex;
            align-items: center;
            gap: 5px;
            /* 🔥 mepet ke logo */
        }

        .logo img {
            width: 90px;
            height: auto;
        }

        .judul {
            color: white;
            font-size: 20px;
            line-height: 1.2;
            margin: 0;
        }

        /* USER */
        .user-box {
            display: flex;
            align-items: center;
            gap: 20px;
            color: white;
        }

        .user-box img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        /* LAYOUT */
        .main {
            display: flex;
            height: calc(100vh - 100px);
        }

        /* SIDEBAR */
        .sidebar {
            width: 270px;
            background-color: #170a6b40;
            padding-top: 20px;
            position: relative;
        }

        .sidebar a {
            display: block;
            text-align: center;
            padding: 12px 20px;
            color: #f4f4f4;
            text-decoration: none;
            margin: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
        }

        .sidebar a:hover {
            background: #335077;
        }

        /* divider */
        .divider {
            border-top: 1px solid #475569;
            margin: 460px 10px;
        }

        /* logout bawah */
        .logout {
            position: absolute;
            bottom: 2px;
            width: 100%;
            text-align: center;
        }

        .logout a {
            color: #f87171;
            font-weight: bold;
        }

        /* === TAMBAHAN CARI BUKU === */

        .content {
            flex: 1;
            padding: 30px;
            color: white;

            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .search-box {
            width: 100%;
            max-width: 1100px;
            margin-bottom: 25px;
        }

        .search-box input {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: none;
            background: #1e293b;
            color: white;
            font-size: 16px;
        }

        .book-grid {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .book-card {
            display: flex;
            gap: 18px;
            background: #1e293b;
            padding: 20px;
            border-radius: 14px;
            min-height: 160px;
            transition: 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-card img {
            width: 110px;
            height: 150px;
            border-radius: 8px;
        }

        .book-title {
            font-weight: bold;
            font-size: 18px;
        }

        .book-author {
            font-size: 15px;
            margin-bottom: 10px;
            color: #cbd5f5;
        }

        .status {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .available {
            color: #22c55e;
        }

        .not-available {
            color: #ef4444;
        }

        .btn-small {
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            margin-right: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-detail {
            background: #334155;
            color: white;
        }

        .btn-pinjam {
            background: #3b82f6;
            color: white;
        }
    </style>
</head>

<body>

    <div class="background">

        <!-- HEADER -->
        <div class="header">
            <div class="header-content">

                <!-- KIRI -->
                <div class="left-box">
                    <div class="logo">
                        <img src="{{ asset('images/logoperpus.png') }}" alt="Logo">
                    </div>

                    <h3 class="judul">
                        Sistem <br>
                        Perpustakaan <br>
                        Digital
                    </h3>
                </div>

                <!-- KANAN -->
                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}" alt="anggota">
                    <span>{{ auth()->user()->name ?? 'Anggota' }}</span>
                </div>

            </div>
        </div>

        <!-- MAIN -->
        <div class="main">

            <!-- SIDEBAR -->
            <div class="sidebar">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('biodata') }}">Biodata</a>
                <a href="{{ route('buku') }}">Cari Buku</a>
                <a href="{{ route('peminjaman') }}">Peminjaman</a>
                <a href="{{ route('pengembalian') }}">Pengembalian</a>


                <div class="divider"></div>

                <div class="logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>

            <!-- CONTENT -->

            <div class="content">

                <!-- search -->
                <div class="search-box" style="display:flex; gap:10px; margin-bottom:20px;">
                    <form action="{{ route('buku') }}" method="GET" style="flex:1;">
                        <input type="text" name="q" value="{{ $q ?? '' }}"
                            placeholder="Cari judul atau penulis..."
                            style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
                        <input type="hidden" name="kategori" value="{{ $kategori ?? '' }}">
                    </form>

                    <form action="{{ route('buku') }}" method="GET" style="display:flex; align-items:center;">
                        <select name="kategori" onchange="this.form.submit()"
                            style="padding:10px; border-radius:8px; border:1px solid #ccc;">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kat)
                                <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>
                                    {{ $kat }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="q" value="{{ $q ?? '' }}">
                    </form>
                </div>

                <div class="book-grid">

                    @foreach ($bukus as $buku)
                        <div class="book-card">
                            <img src="{{ asset('images/' . $buku->cover) }}">

                            <div>
                                <div class="book-title">{{ $buku->judul }}</div>
                                <div class="book-author">{{ $buku->penulis }}</div>
                                <div class="book-author">Kategori: {{ $buku->kategori ?? '-' }}</div>

                                @php
                                    $pinjam = $userPeminjaman[$buku->id] ?? null;
                                @endphp

                                <!-- STATUS -->
                                <div class="status">
                                    @if ($pinjam)
                                        @if ($pinjam->status == 'pending')
                                            <span style="color:orange;">Menunggu Persetujuan</span>
                                        @elseif($pinjam->status == 'dipinjam')
                                            <span style="color:#38bdf8;">Sedang Dipinjam</span>
                                        @elseif($pinjam->status == 'request_kembali')
                                            <span style="color:violet;">Menunggu Pengembalian</span>
                                        @endif
                                    @elseif(in_array($buku->id, $requestedBooks))
                                        <span class="not-available">Tidak Tersedia</span>
                                    @else
                                        <span class="available">Tersedia</span>
                                    @endif
                                </div>

                                <!-- BUTTON -->
                                @if ($pinjam)
                                    @if ($pinjam->status == 'pending')
                                        <button class="btn-small" style="background:orange;" disabled>
                                            Menunggu
                                        </button>
                                    @elseif($pinjam->status == 'dipinjam')
                                        <button class="btn-small" style="background:#3b82f6;" disabled>
                                            Dipinjam
                                        </button>
                                    @elseif($pinjam->status == 'request_kembali')
                                        <button class="btn-small" style="background:purple;" disabled>
                                            Diproses
                                        </button>
                                    @endif
                                @elseif(in_array($buku->id, $requestedBooks))
                                    <button class="btn-small" style="background:red;" disabled>
                                        Tidak Tersedia
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('buku.pinjam', $buku->id) }}">
                                        @csrf
                                        <button type="submit" class="btn-small btn-pinjam">
                                            Pinjam
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    @endforeach

                </div>
