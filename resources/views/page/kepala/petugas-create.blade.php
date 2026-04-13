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

      /* CONTENT */
        .content {
            flex: 1;
            padding: 30px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
    width: 100%;
    max-width: 500px; /* ini yang nentuin lebar button */
}

        /* CARD FORM */
        .form-card {
            width: 100%;
            max-width: 500px;
            background: rgba(30, 41, 59, 0.9);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
            transition: 0.3s;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .form-card p {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: #cbd5f5;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid transparent;
            background: #0f172a;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border: 1px solid #3b82f6;
            box-shadow: 0 0 8px rgba(59,130,246,0.5);
        }

        /* BUTTON */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg,#3b82f6,#1d4ed8);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }

        .form-group {
    width: 100%;
}

.form-group input {
    width: 100%;
    box-sizing: border-box;
}

.btn-submit {
    width: 100%;
    display: block;
    box-sizing: border-box;
}
        /* ERROR */
        .error-box {
            background: rgba(239,68,68,0.1);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            color: #f87171;
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
                    Sistem<br>Perpustakaan<br>Digital
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
            <div class="form-card">

                <h2>Tambah Akun Petugas</h2>
                <p>Isi data untuk membuat akun petugas baru</p>

                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('kepala.petugas.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required>
                    </div>

                   <div class="form-group">
    <button type="submit" class="btn-submit">Simpan Akun</button>
</div>

                </form>

            </div>
        </div>

    </div>
</div>
</body>
</html>