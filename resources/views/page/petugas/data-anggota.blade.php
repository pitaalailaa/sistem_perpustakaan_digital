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

        /* CONTENT */
        .content {
            flex: 1;
            padding: 30px;
            color: white;
        }

        /* TABLE KHUSUS DATA BUKU */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        th,
        td {
            padding: 16px 14px;
            text-align: center;
        }

        th {
            background: #334155;
            font-size: 16px;
            color: #e2e8f0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        tr:hover {
            background: #273449;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 12px 8px;
            }
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


            <!-- CONTENT -->
            <div class="content">
                <h2 style="text-align:center; color:#3b82f6; margin-bottom:10px; font-size:32px;">Data Anggota</h2>
                <p style="text-align:center; color:#94a3b8; margin-bottom:30px; font-size:16px;">
                    Daftar anggota perpustakaan yang terdaftar dalam sistem.
                </p>

                <table>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Kelas</th>
                    </tr>

                    @foreach ($anggota as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->no_telp ?? '-' }}</td>
                            <td>{{ $user->kelas ?? '-' }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
