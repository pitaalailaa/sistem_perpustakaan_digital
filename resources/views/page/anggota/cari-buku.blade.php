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

        /* divider */
        .divider {
            border-top: 1px solid #475569;
            margin: 440px 10px;
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

        .content {
            flex: 1;
            padding: 20px 40px;
            /* kasih space dikit biar ga nempel */
            color: white;
            display: flex;
            flex-direction: column;
        }

        .cari-buku-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: bold;
            color: #3b82f6;
        }

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
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            /* lebih gede */
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
            transition: all 0.3s ease;
        }

        /* HOVER EFFECT */
        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        /* GAMBAR */
        .book-card img {
            width: 120px;
            height: 170px;
            border-radius: 10px;
            object-fit: cover;
        }

        /* TEXT */
        .book-title {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 4px;
        }

        .book-author {
            font-size: 15px;
            color: #cbd5f5;
            margin-bottom: 4px;
        }

        /* STATUS */
        .status {
            font-size: 15px;
            margin-top: 5px;
            margin-bottom: 8px;
        }

        /* BUTTON AREA */
        .book-card div>div:last-child {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* BUTTON */
        .btn-small {
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        /* DETAIL */
        .btn-small[href] {
            background: #6c757d;
            color: white;
            text-decoration: none;
        }

        /* PINJAM */
        .btn-pinjam {
            background: #3b82f6;
            color: white;
        }

        /* DISABLED */
        button[disabled] {
            opacity: 0.8;
            cursor: not-allowed;
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

                <div class="cari-buku-title">Cari Buku</div>

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

                                @php
                                    $pinjam = $userPeminjaman[$buku->id] ?? null;
                                @endphp

                                <div>
                                    @if ($pinjam)
                                        <span style="color:orange;">{{ $pinjam->status }}</span>
                                    @elseif(in_array($buku->id, $requestedBooks))
                                        <span class="not-available">Tidak Tersedia</span>
                                    @else
                                        <span class="available">Tersedia</span>
                                    @endif
                                </div>

                                <div class="btn-area">

                                    <a href="{{ route('buku.detail', $buku->id) }}" class="btn-small btn-detail">
                                        Detail
                                    </a>

                                    @if ($pinjam)
                                        <button class="btn-small btn-disabled" disabled>{{ $pinjam->status }}</button>
                                    @elseif(in_array($buku->id, $requestedBooks))
                                        <button class="btn-small btn-disabled" disabled>Tidak Tersedia</button>
                                    @else
                                        <a href="{{ route('buku.pinjam.form', $buku->id) }}"
                                            class="btn-small btn-pinjam">
                                            Pinjam
                                        </a>

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
