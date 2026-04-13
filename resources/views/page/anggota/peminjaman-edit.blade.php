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
            color: #fe0606;
            font-weight: bold;
        }

        .content {
            flex: 1;
            padding: 30px;
            color: white;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        .card {
            background: #1e293b;
            border-radius: 14px;
            padding: 20px;
        }

        .input-field {
            margin-bottom: 10px;
        }

        .input-field label {
            display: block;
            margin-bottom: 5px;
        }

        .input-field input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: #334155;
            color: white;
        }

        .btn {
            padding: 10px 14px;
            border-radius: 8px;
            border: none;
            color: white;
            cursor: pointer;
        }

        .btn-primary {
            background: #3b82f6;
        }

        .btn-back {
            background: #6b7280;
        }

        .alert {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
        }

        .alert-error {
            background: #7f1d1d;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="header">
            <div class="header-content">
                <div class="left-box">
                    <div class="logo"><img src="{{ asset('images/logoperpus.png') }}" alt="Logo"></div>
                    <h3 class="judul">Sistem Perpustakaan Digital</h3>
                </div>
                <div class="user-box"><img src="{{ asset('images/profil.png') }}" alt="anggota"><span>anggota</span>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="sidebar"><a href="{{ route('dashboard') }}">Dashboard</a><a
                    href="{{ route('biodata') }}">Biodata</a><a href="{{ route('buku') }}">Cari Buku</a><a
                    href="{{ route('peminjaman') }}">Peminjaman</a><a
                    href="{{ route('pengembalian') }}">Pengembalian</a>
                <div class="divider"></div>
                <div class="logout"><a href="/logout">Logout</a></div>
            </div>
            <div class="content">
                <div class="card">
                    <h2>Edit Peminjaman</h2>
                    @if ($errors->any())
                        <div class="alert alert-error">{{ $errors->first() }}</div>
                    @endif
                    <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}">
                        @csrf @method('PUT')
                        <div class="input-field"><label>Buku</label><input type="text"
                                value="{{ $peminjaman->book->title }}" disabled></div>
                        <div class="input-field"><label>Dari tanggal</label><input type="date" name="borrowed_at"
                                value="{{ old('borrowed_at', $peminjaman->borrowed_at) }}" required></div>
                        <div class="input-field"><label>Sampai tanggal</label><input type="date" name="due_date"
                                value="{{ old('due_date', $peminjaman->due_date) }}" required></div>
                        <div class="input-field"><label>Status</label><select name="status">
                                <option value="dipinjam" {{ $peminjaman->status === 'dipinjam' ? 'selected' : '' }}>dipinjam
                                </option>
                                <option value="kembali" {{ $peminjaman->status === 'kembali' ? 'selected' : '' }}>kembali
                                </option>
                            </select></div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('peminjaman') }}" class="btn btn-back" style="margin-left:8px;">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
