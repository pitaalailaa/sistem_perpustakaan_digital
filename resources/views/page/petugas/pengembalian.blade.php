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

        html, body {
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
            margin: 388px 2px;
        }

        /* logout */
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
            overflow-x: hidden; /* 🔒 NO HORIZONTAL SCROLL */
            width: 100%;
            padding-bottom: 60px;
        }

        /* TITLE */
        .content h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        .content h3 {
            margin-top: 30px;
            margin-bottom: 15px;
        }

        /* TABLE - FULL WIDTH & RESPONSIVE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            table-layout: fixed; /* 🔒 TABLE GAK MELEBAR */
        }

        th, td {
            padding: 12px 8px;
            text-align: center;
            font-size: 13px;
        }

        th {
            background: #334155;
            font-size: 13px;
            color: #e2e8f0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        tr:hover {
            background: #273449;
        }

        /* BUTTON */
        button {
            background: #22c55e;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-size: 12px;
            transition: 0.3s;
        }

        button:hover {
            background: #16a34a;
        }

        /* STATUS */
        .status-badge {
            background: #22c55e;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
        }

        /* DENDA */
        .denda {
            color: #f59e0b;
            font-weight: bold;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            th, td {
                padding: 8px 4px;
                font-size: 11px;
            }
            .sidebar {
                width: 220px;
            }
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
                        <img src="{{ asset('images/logoperpus.png') }}" alt="Logo">
                    </div>
                    <h3 class="judul">
                        Sistem <br> Perpustakaan <br> Digital
                    </h3>
                </div>

                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}" alt="{{ auth()->user()->role }}">
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


            <!-- CONTENT - KUNCI! -->
            <div class="content">

                <h2>Data Pengembalian</h2>

                <!-- 📥 PERMINTAAN PENGEMBALIAN -->
                <h3 style="color:#facc15;">Permintaan Pengembalian</h3>

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
                            <td style="font-weight: bold;">{{ $p->buku->title ?? '-' }}</td>
                            <td>
                                <form action="{{ route('petugas.pengembalian.konfirmasi', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit">Konfirmasi</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="color:#94a3b8;">Tidak ada permintaan pengembalian.</td>
                        </tr>
                    @endforelse
                </table>

                <!-- ✅ RIWAYAT PENGEMBALIAN -->
                <h3 style="color:#38bdf8;">Riwayat Pengembalian</h3>

                <table>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Judul Buku</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                    @forelse($riwayat as $index => $r)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $r->user->name ?? '-' }}</td>
                            <td>{{ $r->user->kelas ?? '-' }}</td>
                            <td style="font-weight: bold;">{{ $r->buku->title ?? '-' }}</td>
                            <td>{{ $r->returned_at ?? '-' }}</td>
                            <td><span class="status-badge">{{ ucfirst($r->status ?? '-') }}</span></td>
                            <td class="denda">Rp {{ number_format($r->denda ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="color:#94a3b8;">Tidak ada riwayat pengembalian.</td>
                        </tr>
                    @endforelse
                </table>

            </div>

        </div>
    </div>
</body>
</html>
