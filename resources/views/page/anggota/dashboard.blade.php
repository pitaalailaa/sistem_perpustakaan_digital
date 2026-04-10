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

        /* CONTENT */
        .content {
            flex: 1;
            padding: 30px;
            color: white;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        /* TITLE */
        .content h2 {
            margin-bottom: 5px;
        }

        .content p {
            color: #94a3b8;
            margin-bottom: 20px;
        }

        /* CARDS */
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            flex: 1;
            border-radius: 12px;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* warna beda tiap card */
        .card1 {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .card2 {
            background: linear-gradient(135deg, #6366f1, #4338ca);
        }

        .card3 {
            background: linear-gradient(135deg, #0ea5e9, #0369a1);
        }

        /* isi card */
        .card h3 {
            font-size: 14px;
            margin-bottom: 5px;
            color: #e2e8f0;
        }

        .card p {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            color: white;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 14px;
            text-align: center;
        }

        th {
            background: #334155;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        /* hover row */
        tr:hover {
            background: #273449;
        }

        /* status */
        .status-kembali {
            color: #38bdf8;
            font-weight: bold;
        }

        .status-pinjam {
            color: #facc15;
            font-weight: bold;
        }

        /* aturan peminjaman */
        .rules-box {
            margin-top: 25px;
            background: #1e293b;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .rules-box h3 {
            margin-bottom: 12px;
            color: #3b82f6;
            font-size: 18px;
        }

        .rules-box ol {
            padding-left: 20px;
            color: #e2e8f0;
            line-height: 1.8;
            font-size: 14px;
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
                    <span>{{ $user->name ?? 'Anggota' }}</span>
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

                <!-- CARDS -->
                <div class="cards">
                    <div class="card card1">
                        <h3>Total Buku</h3>
                        <p>{{ $totalBuku ?? 0 }}</p>
                    </div>

                    <div class="card card2">
                        <h3>Dipinjam</h3>
                        <p>{{ $dipinjam ?? 0 }}</p>
                    </div>

                    <div class="card card3">
                        <h3>Dikembalikan</h3>
                        <p>{{ $dikembalikan ?? 0 }}</p>
                    </div>

                    <div class="card card2">
                        <h3> Total Denda </h3>
                        <p>Rp. {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if (isset($recentPeminjamans) && $recentPeminjamans->isNotEmpty())
                    <h3>Riwayat Peminjaman</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentPeminjamans as $pinjam)
                                <tr>
                                    <td>{{ $pinjam->buku->judul ?? '-' }}</td>
                                    <td>{{ $pinjam->borrowed_at }}</td>
                                    <td>{{ $pinjam->due_date }}</td>
                                    <td
                                        class="{{ $pinjam->status === 'kembali' ? 'status-kembali' : 'status-pinjam' }}">
                                        {{ ucfirst($pinjam->status) }}</td>
                                    <td>Rp. {{ number_format($pinjam->outstanding_denda, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada data peminjaman untuk akun ini.</p>
                @endif

                <h3>Informasi Aturan Peminjaman</h3>

                <div class="rules-box">

                    <ol>
                        <li>waktu peminjaman maksimal 5 hari.</li>
                        <li>jika pengembalian buku lebih dari waktu yang ditentukan akan diberikan denda rp.3.000/hari.
                        </li>
                        <li>jika terlambat mengembalikan buku dan mendapat denda, maka wajib langsung membayar.</li>
                    </ol>
                </div>
