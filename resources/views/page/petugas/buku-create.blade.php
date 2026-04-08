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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* FORM CARD */
        .form-card {
            width: 100%;
            max-width: 1000px;
            background: #1e293b;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #3b82f6;
        }

        /* FORM GRID */
        .form-card form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group label {
            font-size: 13px;
            color: #cbd5e1;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 8px;
            background: #334155;
            color: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border: 1px solid #3b82f6;
        }

        /* FULL WIDTH */
        .full {
            grid-column: span 2;
        }

        /* BUTTON */
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

        .btn:hover {
            background: #2563eb;
        }

        * {
    box-sizing: border-box;
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
                    <h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3>
                </div>

                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}">
                    <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                </div>
            </div>
        </div>

        <div class="main">

            <!-- SIDEBAR -->
            <div class="sidebar">
                <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
                <a href="{{ route('biodata') }}">Biodata</a>
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
                <div class="form-card">

                    <h2>Tambah Buku</h2>

                    @if ($errors->any())
                        <div style="color:#f87171;" class="full">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('petugas.buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="author" value="{{ old('author') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}">
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" value="{{ old('tahun') }}">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" required>
                                <option value="tersedia">tersedia</option>
                                <option value="dipinjam">dipinjam</option>
                            </select>
                        </div>

                        <div class="form-group full">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="form-group full">
                            <label>Cover Buku</label>
                            <input type="file" name="cover" accept="image/*" required>
                            <small style="color:#94a3b8;"></small>
                        </div>

                        <button type="submit" class="btn full">Simpan Buku</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</body>

</html>