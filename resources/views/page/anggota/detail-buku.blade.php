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

        /* ===== CONTENT (DETAIL BUKU) ===== */
        
 .container {
    width: 700px;
    background: #1e293b;
    border-radius: 12px;
    padding: 60px 60px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    height: fit-content;

    margin: 40px auto; /* 🔥 INI KUNCINYA (center + turun dikit) */
}

        /* Judul */
        .title {
            text-align: center;
            color: #60a5fa;
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 25px;
        }

        /* Layout isi */
        .content {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        /* Gambar buku */
        .book-img {
            width: 140px;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        /* Info buku */
        .info {
            flex: 1;
        }

        .info h2 {
            margin-bottom: 12px;
            font-size: 22px;
            color: #f8fafc;
        }

       .label {
    color: #94a3b8;
    font-weight: 600;
    font-size: 15px;
}

.info p {
    font-size: 16px;
    color: #f1f5f9; /* lebih terang */
}

        /* Garis */
        hr {
            border: none;
            border-top: 1px solid #334155;
            margin: 25px 0;
        }

        /* Deskripsi */
        .desc-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #f1f5f9;
            font-size: 26px;
        }

        .desc {
            font-size: 16px;
            line-height: 1.7;
            color: #cbd5f5;
            text-align: justify;
        }

        .back-btn {
            margin-top: 20px;
            text-align: center;
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background: #334155;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .back-btn a:hover {
            background: #475569;
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
<div class="container">
    <div class="title">Detail Buku</div>

    <div class="content">
        <img src="{{ asset('images/' . $buku->cover) }}" alt="cover" class="book-img">

        <div class="info">
            <h2>{{ $buku->judul }}</h2>
            <p><span class="label">Penulis:</span> {{ $buku->penulis }}</p>
            <p><span class="label">Penerbit:</span> {{ $buku->penerbit }}</p>
            <p><span class="label">Tahun Terbit:</span> {{ $buku->tahun }}</p>
            <p><span class="label">Kategori:</span> {{ $buku->kategori }}</p>
        </div>
    </div>

    <hr>

    <div class="desc-title">Deskripsi:</div>
    <div class="desc">
        {{ $buku->deskripsi }}
    </div>

    <div class="back-btn">
        <a href="{{ route('buku') }}">Kembali</a>
    </div>
</div>