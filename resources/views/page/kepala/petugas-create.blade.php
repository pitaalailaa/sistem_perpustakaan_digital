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
            margin: 0;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 20px;
            color: white;
            overflow-y: auto;
            padding-bottom: 60px;
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
            max-width: 500px;
            margin: 0 auto;
            background: #1e293b;
            padding: 20px;
            border-radius: 12px;
        }

        .form-card h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
        }

        .btn-submit {
            background: #22c55e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
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
                    <div class="logo"><img src="{{ asset('images/logoperpus.png') }}"></div>
                    <h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3>
                </div>
                <div class="user-box"><img src="{{ asset('images/profil.png') }}"><span>{{ auth()->user()->name }}
                        ({{ auth()->user()->role }})</span></div>
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
                <div class="form-card">
                    <h2>Tambah Akun Petugas</h2>
                    @if ($errors->any())
                        <div style="color:#f43f5e;margin-bottom:10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('kepala.petugas.store') }}">@csrf
                        <div class="form-group"><label>Nama</label><input type="text" name="name"
                                value="{{ old('name') }}" required></div>
                        <div class="form-group"><label>Email</label><input type="email" name="email"
                                value="{{ old('email') }}" required></div>
                        <div class="form-group"><label>Password</label><input type="password" name="password" required>
                        </div>
                        <div class="form-group"><label>Konfirmasi Password</label><input type="password"
                                name="password_confirmation" required></div>
                        <button type="submit" class="btn-submit">Simpan Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
