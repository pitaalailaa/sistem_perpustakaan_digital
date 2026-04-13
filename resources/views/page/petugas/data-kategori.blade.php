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
            color: #ff0303;
            font-weight: bold;
        }

        .content {
            flex: 1;
            padding: 30px;
            color: white;
        }

        .form-card {
            max-width: 600px;
            margin: auto;
            background: #1e293b;
            padding: 25px;
            border-radius: 12px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #334155;
            color: white;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #3b82f6;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .table th,
        .table td {
            padding: 14px;
            text-align: center;
        }

        .table th {
            background: #334155;
            color: #e2e8f0;
        }

        .table tr:not(:last-child) {
            border-bottom: 1px solid #475569;
        }

        .action-btn {
            padding: 6px 10px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
        }

        .action-edit {
            background: #1d4ed8;
        }

        .action-delete {
            background: #dc2626;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="header">
            <div class="header-content">
                <div class="left-box">
                    <div class="logo"><img src="{{ asset('images/logoperpus.png') }}" alt="Logo"></div>
                    <h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3>
                </div>
                <div class="user-box"><img src="{{ asset('images/profil.png') }}"
                        alt="petugas"><span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span></div>
            </div>
        </div>
        <div class="main">
            <div class="sidebar"><a href="{{ route('petugas.dashboard') }}">Dashboard</a><a
                    href="{{ route('biodata') }}">Biodata</a><a href="{{ route('petugas.buku') }}">Data Buku</a><a
                    href="{{ route('petugas.anggota') }}">Data Anggota</a><a
                    href="{{ route('petugas.peminjaman') }}">Peminjaman</a><a
                    href="{{ route('petugas.pengembalian') }}">Pengembalian</a>
                <div class="divider"></div>
                <div class="logout"><a href="/logout">Logout</a></div>
            </div>
            <div class="content">
                <div class="form-card">
                    <h2 style="text-align:center;">Kelola Kategori</h2>
                    @if (session('success'))
                        <p style="color:#34d399; text-align:center;">{{ session('success') }}</p>
                    @endif
                    <form action="{{ route('petugas.kategori.store') }}" method="POST">
                        @csrf<div class="form-group"><label>Nama Kategori</label><input type="text" name="name"
                                value="{{ old('name') }}" required></div><button type="submit" class="btn">Tambah
                            Kategori</button></form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{ route('petugas.kategori.update', $category->id) }}" method="POST"
                                        style="display:inline-block; width: 60%;">@csrf @method('PUT')<input
                                            type="text" name="name" value="{{ $category->name }}"
                                            style="margin-right:4px;" required><button type="submit"
                                            class="action-btn action-edit">Ubah</button></form>
                                    <form action="{{ route('petugas.kategori.destroy', $category->id) }}"
                                        method="POST" style="display:inline-block;">@csrf @method('DELETE')<button
                                            type="submit" class="action-btn action-delete"
                                            onclick="return confirm('Hapus kategori ini?')">Hapus</button></form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
