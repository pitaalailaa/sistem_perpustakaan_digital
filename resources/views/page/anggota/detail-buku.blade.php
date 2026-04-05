<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Detail Buku</title>

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

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #1e293b;
            padding: 30px;
            border-radius: 15px;
            color: white;
        }

        .top {
            display: flex;
            gap: 30px;
        }

        .top img {
            width: 180px;
            border-radius: 10px;
        }

        .available {
            color: #22c55e;
        }

        .not-available {
            color: #ef4444;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
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
                <h2>Dashboard</h2>
                <p>Selamat datang di perpustakaan digital!</p>

                <div class="container">

                    <div class="top">
                        <img src="{{ asset('images/' . $buku->cover) }}">

                        <div class="info">
                            <h2>{{ $buku->judul }}</h2>

                            <p><b>Penulis:</b> {{ $buku->penulis }}</p>
                            <p><b>Penerbit:</b> {{ $buku->penerbit }}</p>
                            <p><b>Tahun Terbit:</b> {{ $buku->tahun }}</p>
                            <p><b>Kategori:</b> {{ $buku->kategori }}</p>

                            <p>
                                <b>Status:</b>
                                <span class="{{ $buku->status == 'tersedia' ? 'available' : 'not-available' }}">
                                    ● {{ $buku->status }}
                                </span>
                            </p>

                            <hr>

                            <h3>Deskripsi:</h3>
                            <p>{{ $buku->deskripsi }}</p>

                            @if ($buku->status == 'tersedia')
                                <form method="POST" action="{{ route('buku.pinjam', $buku->id) }}">
                                    @csrf
                                    <button class="btn" type="submit">Pinjam Buku</button>
                                </form>
                            @else
                                <button class="btn" disabled style="background:#6b7280;">Buku sedang
                                    dipinjam</button>
                            @endif
                        </div>
                    </div>

                </div>
