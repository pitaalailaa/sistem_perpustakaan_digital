<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Tambah Buku</title>
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
            height: auto;
        }

        .judul {
            color: white;
            font-size: 20px;
            line-height: 1.2;
            margin: 0;
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

        .divider {
            border-top: 1px solid #475569;
            margin: 460px 10px;
        }

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

        .form-group input,
        .form-group select,
        .form-group textarea {
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
                    <h2>Tambah Buku</h2>
                    @if ($errors->any())
                        <div style="color:#f87171;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('petugas.buku.store') }}" method="POST">
                        @csrf<div class="form-group"><label>Judul</label><input type="text" name="title"
                                value="{{ old('title') }}" required></div>
                        <div class="form-group"><label>Penulis</label><input type="text" name="author"
                                value="{{ old('author') }}" required></div>
                        <div class="form-group"><label>Kategori</label><select name="category_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select></div>
                        <div class="form-group"><label>Penerbit</label><input type="text" name="penerbit"
                                value="{{ old('penerbit') }}"></div>
                        <div class="form-group"><label>Tahun</label><input type="text" name="tahun"
                                value="{{ old('tahun') }}"></div>
                        <div class="form-group"><label>Deskripsi</label>
                            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="form-group"><label>Cover (nama file)</label><input type="text" name="cover"
                                value="{{ old('cover') }}"></div>
                        <div class="form-group"><label>Status</label><select name="status" required>
                                <option value="tersedia">tersedia</option>
                                <option value="dipinjam">dipinjam</option>
                            </select></div><button type="submit" class="btn">Simpan Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
