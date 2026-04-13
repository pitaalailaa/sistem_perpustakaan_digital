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

        .left-box {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logo img {
            width: 90px;
        }

        .judul {
            color: white;
            font-size: 20px;
            line-height: 1.2;
            margin: 0;
        }

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
            padding-top: 32px;
            position: relative;
            margin-top: 6px;
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

        .divider {
            border-top: 1px solid #475569;
            margin: 440px 10px;
        }

        .logout {
            position: absolute;
            bottom: 2px;
            width: 100%;
            text-align: center;
        }

        .logout a {
            color: #ff0505;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        /* HEADER HALAMAN */
        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h2 {
            color: #3b82f6;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #94a3b8;
            font-size: 16px;
        }

        /* SEARCH */
        .search-form {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .search-form input,
        .search-form select {
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #1e293b;
            color: white;
        }

        .search-form input {
            flex: 1;
        }

        /* GRID BUKU */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 25px;
        }

        /* CARD */
        .book-card {
            display: flex;
            gap: 20px;
            background: #1e293b;
            padding: 22px;
            border-radius: 16px;
            min-height: 190px;
            transition: 0.3s;
        }

        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        .book-card img {
            width: 120px;
            height: 170px;
            border-radius: 10px;
            object-fit: cover;
        }

        .book-title {
            font-weight: bold;
            font-size: 20px;
        }

        .book-author {
            font-size: 15px;
            color: #cbd5f5;
        }

        /* STATUS */
        .available {
            color: #22c55e;
        }

        .not-available {
            color: #ef4444;
        }

        /* BUTTON */
        .btn-area {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-small {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-detail {
            background: #64748b;
            color: rgb(14, 14, 14);
            text-decoration: none;
        }

        .btn-pinjam {
            background: #3b82f6;
            color: white;
        }

        button[disabled] {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .inline-form {
            display: inline;
        }
    </style>
</head>

<body>

    <div class="background">

        <!-- HEADER -->
        <div class="header">
            <div class="header-content">

                <div class="left-box">
                    <div class="logo">
                        <img src="{{ asset('images/logoperpus.png') }}">
                    </div>
                    <h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3>
                </div>

                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}">
                    <span>{{ auth()->user()->name ?? 'Anggota' }}</span>
                </div>

            </div>
        </div>

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

                <div class="page-header">
                    <h2>Katalog Buku</h2>
                    <p>Cari dan temukan buku yang ingin kamu baca atau pinjam dari perpustakaan.</p>
                </div>

                @if (session('success'))
                    <div style="background:#14532d;color:#dcfce7;padding:12px;border-radius:10px;margin-bottom:15px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div style="background:#7f1d1d;color:#fee2e2;padding:12px;border-radius:10px;margin-bottom:15px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('buku') }}" method="GET" class="search-form">
                    <input type="text" name="q" value="{{ $q ?? '' }}"
                        placeholder="Cari judul atau penulis...">

                    <select name="kategori" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div class="book-grid">

                    @foreach ($bukus as $buku)
                        <div class="book-card">

                            <img src="{{ asset('images/' . $buku->cover) }}">

                            <div>
                                <div class="book-title">{{ $buku->judul }}</div>
                                <div class="book-author">{{ $buku->penulis }}</div>
                                <div class="book-author">Kategori: {{ $buku->kategori ?? '-' }}</div>
                                <div class="book-author">Stok: {{ $buku->stock ?? 0 }}</div>

                                @php
                                    $pinjam = $userPeminjaman[$buku->id] ?? null;
                                    $isLimitReached = ($activeLoanCount ?? 0) >= 2;
                                    $isOutOfStock = ($buku->stock ?? 0) < 1;
                                @endphp

                                <div>
                                    @if ($pinjam)
                                        <span style="color:orange;">{{ $pinjam->status }}</span>
                                    @elseif($isOutOfStock)
                                        <span class="not-available">Tidak Tersedia</span>
                                    @elseif($isLimitReached)
                                        <span class="not-available">Batas 2 Buku</span>
                                    @else
                                        <span class="available">Tersedia</span>
                                    @endif
                                </div>

                                <div class="btn-area">

                                    <a href="{{ route('buku.detail', $buku->id) }}" class="btn-small btn-detail">
                                        Detail
                                    </a>

                                    @if ($pinjam)
                                        <button class="btn-small" disabled>Dipinjam</button>
                                    @elseif($isOutOfStock)
                                        <button class="btn-small" disabled>Tidak Tersedia</button>
                                    @elseif($isLimitReached)
                                        <button class="btn-small" disabled>Batas 2 Buku</button>
                                    @else
                                        <form method="POST" action="{{ route('buku.pinjam', $buku->id) }}"
                                            class="inline-form">
                                            @csrf
                                            <button type="submit" class="btn-small btn-pinjam">Pinjam</button>
                                        </form>
                                    @endif

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

</body>

</html>