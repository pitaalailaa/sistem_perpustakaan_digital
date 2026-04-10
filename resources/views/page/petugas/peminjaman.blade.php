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

        .sidebar a.active {
            background: #3b82f6;
        }

        /* divider */
        .divider {
            border-top: 1px solid #475569;
            margin: 388px 2px;
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

        /* CONTENT - KUNCI TOTAL! */
        .content {
            flex: 1;
            padding: 30px;
            color: white;
            overflow-y: auto;
            /* Cuma vertikal yang bisa scroll */
            overflow-x: hidden;
            /* 🔒 LARANG GESER HORIZONTAL */
            width: 100%;
            padding-bottom: 60px;
        }

        /* TABLE - HAPUS MARGIN LEFT YANG BIKIN GESER */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            /* HAPUS: margin-left: 40px; */
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            table-layout: fixed;
            /* 🔒 TABLE GAK BISA MELEBAR */
        }

        /* TITLE CENTER */
        .content h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        /* H3 JUDUL */
        .content h3 {
            margin-top: 30px;
            margin-bottom: 15px;
        }

        /* RESPONSIVE TABLE */
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 8px 4px;
            }
        }

        th,
        td {
            padding: 14px;
            text-align: center;
        }

        th {
            background: #334155;
            font-size: 14px;
            color: #e2e8f0;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        tr:hover {
            background: #273449;
        }

        /* BUTTON AKSI */
        .btn-edit {
            background: #1d4ed8;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 5px;
        }

        .btn-hapus {
            background: #dc2626;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* BUTTON TAMBAH */
        .btn-tambah {
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-tambah:hover {
            background: #1d4ed8;
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
                    <h3 class="judul">
                        Sistem <br> Perpustakaan <br> Digital
                    </h3>
                </div>

                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}">
                    <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                </div>
            </div>
        </div>

        <!-- MAIN -->
        <div class="main">
     <!-- SIDEBAR -->
            <div class="sidebar">
                <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
                <a href="{{ route('petugas.biodata') }}">Biodata</a>
                <a href="{{ route('petugas.buku') }}">Data Buku</a>
                <a href="{{ route('petugas.anggota') }}">Data Anggota</a>
                <a href="{{ route('petugas.peminjaman') }}">Peminjaman</a>
                <a href="{{ route('petugas.pengembalian') }}">Pengembalian</a>
                <div class="divider"></div>


                <div class="logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>


          <!-- CONTENT - BERSIH & KUNCI! -->
<div class="content">

    <h2>Data Peminjaman</h2>

    <!-- 📥 PERMINTAAN -->
    <h3 style="color:#facc15;">Permintaan Peminjaman</h3>

    <table>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Judul Buku</th>
            <th>Aksi</th>
        </tr>
        @forelse($permintaan as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->user->name ?? '-' }}</td>
                <td>{{ $p->user->kelas ?? '-' }}</td>
                <td><b>{{ $p->buku->judul ?? '-' }}</b></td>
                <td>
                    <form action="{{ route('petugas.peminjaman.konfirmasi', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button style="background:#22c55e; border:none; padding:8px 12px; border-radius:6px; color:white; cursor:pointer; font-size:12px;">
                            Konfirmasi
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="color:#94a3b8;">Tidak ada permintaan.</td>
            </tr>
        @endforelse
    </table>

    <!-- ✅ RIWAYAT -->
    <h3 style="color:#38bdf8;">Riwayat Peminjaman</h3>

    <table>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
        </tr>
        @forelse($riwayat as $index => $r)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $r->user->name ?? '-' }}</td>
                <td>{{ $r->user->kelas ?? '-' }}</td>
                <td><b>{{ $r->buku->judul ?? '-' }}</b></td>
                <td>{{ $r->borrowed_at }}</td>
                <td>
                    <span style="background:#22c55e; padding:4px 8px; border-radius:6px; font-size:12px;">
                        {{ ucfirst($r->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="color:#94a3b8;">Tidak ada riwayat.</td>
            </tr>
        @endforelse
    </table>

</div>
