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
            color: #f87171;
            font-weight: bold;
        }

        .content {
            flex: 1;
            padding: 30px;
            color: white;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        .table-card {
            background: #0f172a;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .table-card h2 {
            margin-top: 0;
            color: #3b82f6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
        }

        th,
        td {
            padding: 14px;
            text-align: center;
        }

        th {
            background: #334155;
            color: #e2e8f0;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        tr:hover {
            background: #273449;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            background: #2563eb;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="header">
            <div class="header-content">
                <div class="left-box">
                    <div class="logo">
                        <img src="{{ asset('images/logoperpus.png') }}" alt="Logo">
                    </div>
                    <h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3>
                </div>
                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}" alt="kepala">
                    <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="sidebar">
                <a href="{{ route('kepala.dashboard') }}">Dashboard</a>
                <a href="{{ route('kepala.anggota') }}">Data Anggota</a>
                <a href="{{ route('kepala.petugas') }}">Data Petugas</a>
                <a href="{{ route('kepala.buku') }}">Data Buku</a>
                <a href="{{ route('kepala.laporan') }}">Laporan</a>
                <a href="{{ route('kepala.biodata') }}" class="active">Biodata</a>
                <div class="divider"></div>
                <div class="logout"><a href="/logout">Logout</a></div>
            </div>
            <div class="content">
                <div class="table-card">
                    <h2>Data Anggota</h2>
                    @if (session('success'))
                        <p style="color:#4ade80;text-align:center;">{{ session('success') }}</p>
                    @endif
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>No. Telp</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                        @forelse($anggota as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->kelas ?? 'Belum diisi' }}</td>
                                <td>{{ $item->no_telp ?? 'Belum diisi' }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada data anggota.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
