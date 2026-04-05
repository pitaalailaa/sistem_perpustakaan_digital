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

        .content {
            flex: 1;
            color: white;
        }

        h3 {
            margin-left: 5px;
        }

        /* tombol hover */
        button:hover {
            opacity: 0.8;
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

        /* CONTENT */
        /* TABLE KHUSUS DATA BUKU */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
                    <a href="/logout" style="color:#f87171;">Logout</a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content" style="padding:20px; overflow:auto; width:100%;">

                <h2 style="text-align:center; color:white;">Data Peminjaman</h2>

                <!-- 📥 PERMINTAAN -->
                <h3 style="color:#facc15; margin-top:30px;">Permintaan Peminjaman</h3>

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
                                <form action="{{ route('petugas.peminjaman.konfirmasi', $p->id) }}" method="POST">
                                    @csrf
                                    <button
                                        style="background:#22c55e; border:none; padding:8px 12px; border-radius:6px; color:white; cursor:pointer;">
                                        Konfirmasi
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada permintaan.</td>
                        </tr>
                    @endforelse
                </table>


                <!-- ✅ RIWAYAT -->
                <h3 style="color:#38bdf8; margin-top:40px;">Riwayat Peminjaman</h3>

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
                                <span style="background:#22c55e; padding:5px 10px; border-radius:6px;">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada riwayat.</td>
                        </tr>
                    @endforelse
                </table>

            </div>

        </div>
    </div>

</body>

</html>
