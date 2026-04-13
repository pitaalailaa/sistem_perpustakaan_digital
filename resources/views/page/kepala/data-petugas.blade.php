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
            margin: 390px 10px;
        }

        /* logout bawah */
        .logout {
            position: absolute;
            bottom: 2px;
            width: 100%;
            text-align: center;
        }

        .logout a {
            color: #fb0808;
            font-weight: bold;
        }

        /* ================= CONTENT ================= */

        .content {
            flex: 1;
            padding: 30px;
            color: white;
            overflow-y: auto;
        }

        /* TITLE */
        .table-card h2 {
            text-align: center;
            color: #3b82f6;
            margin-bottom: 5px;
        }

        .table-card p {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        /* ACTION BAR */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        /* BUTTON */
        .btn-tambah {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-tambah:hover {
            transform: translateY(-2px);
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        th,
        td {
            padding: 14px;
            text-align: center;
        }

        th {
            background: #334155;
            color: #e2e8f0;
            font-size: 13px;
            text-transform: uppercase;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        tr:hover {
            background: #273449;
        }

        /* BADGE */
        .badge {
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: bold;
            background: #6366f1;
        }

        /* EMPTY */
        .empty {
            color: #94a3b8;
        }

        /* INFO */
        .info-text {
            color: #94a3b8;
            font-size: 13px;
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
                <a href="{{ route('kepala.dashboard') }}">Dashboard</a>
                <a href="{{ route('kepala.anggota') }}">Data Anggota</a>
                <a href="{{ route('kepala.petugas') }}">Data Petugas</a>
                <a href="{{ route('kepala.buku') }}">Data Buku</a>
                <a href="{{ route('kepala.laporan') }}">Laporan</a>
                <a href="{{ route('kepala.biodata') }}">Biodata</a>
                <div class="divider"></div>
                <div class="logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">

                <div class="table-card">

                    <h2>Data Petugas</h2>
                    <p>Daftar petugas yang mengelola sistem perpustakaan.</p>

                    <div class="action-bar">
                        <a href="{{ route('kepala.petugas.create') }}">
                            <button class="btn-tambah">+ Tambah Petugas</button>
                        </a>

                        <span class="info-text">
                            Total: {{ count($petugas) }} petugas
                        </span>
                    </div>

                    @if (session('success'))
                        <p style="text-align:center;color:#4ade80;">
                            {{ session('success') }}
                        </p>
                    @endif

                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                        </tr>

                        @forelse ($petugas as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->email }}</td>
                                <td>
                                    <span class="badge">
                                        {{ ucfirst($p->role) }}
                                    </span>
                                </td>
                                <td>{{ $p->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    Belum ada data petugas.
                                </td>
                            </tr>
                        @endforelse
                    </table>

                </div>

            </div>

        </div>
    </div>

</body>

</html>
