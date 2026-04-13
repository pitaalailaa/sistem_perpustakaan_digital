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

        .background {
            background-color: #051031;
            min-height: 100vh;
        }

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

        .main {
            display: flex;
            height: calc(100vh - 100px);
        }

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
            margin: 390px 10px;
        }

        .logout {
            position: absolute;
            bottom: 2px;
            width: 100%;
            text-align: center;
        }

        .logout a {
            color: #ff0303;
            font-weight: bold;
        }

        .content {
            flex: 1;
            padding: 30px;
            color: white;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .content h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 5px;
            color: #3b82f6;
        }

        /* 🔥 DESKRIPSI */
        .content p {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .section-title {
            margin-top: 30px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .permintaan {
            color: #facc15;
        }

        .riwayat {
            color: #38bdf8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        th,
        td {
            padding: 14px;
            text-align: center;
        }

        th {
            background: #0f172a;
            color: #e2e8f0;
            font-size: 14px;
            text-transform: uppercase;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #334155;
        }

        tr:hover {
            background: #273449;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            background: #22c55e;
        }

        .btn-konfirmasi {
            background: #22c55e;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-konfirmasi:hover {
            background: #16a34a;
        }
    </style>
</head>

<body>

<div class="background">

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

    <div class="main">

        <!-- SIDEBAR TETAP -->
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

        <!-- CONTENT -->
        <div class="content">

            <h2>Data Peminjaman</h2>
            <p>Kelola permintaan dan riwayat peminjaman buku anggota perpustakaan.</p>

            <div class="section-title permintaan">Permintaan Peminjaman</div>

            <table>
                <tr>
                    <th>No</th>
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
                            <button class="btn-konfirmasi">Konfirmasi</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="color:#94a3b8;">Tidak ada permintaan.</td>
                </tr>
                @endforelse
            </table>

            <div class="section-title riwayat">Riwayat Peminjaman</div>

            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Judul Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>

                @forelse($riwayat as $index => $r)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $r->user->name ?? '-' }}</td>
                    <td>{{ $r->user->kelas ?? '-' }}</td>
                    <td><b>{{ $r->buku->judul ?? '-' }}</b></td>
                    <td>{{ $r->borrowed_at }}</td>
                    <td><span class="badge">{{ ucfirst($r->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="color:#94a3b8;">Tidak ada riwayat.</td>
                </tr>
                @endforelse
            </table>

        </div>

    </div>

</div>

</body>
</html>