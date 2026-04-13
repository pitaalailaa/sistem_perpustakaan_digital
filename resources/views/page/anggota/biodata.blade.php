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
            margin: 440px 10px;
        }

        /* logout bawah */
        .logout {
            position: absolute;
            bottom: 2px;
            width: 100%;
            text-align: center;
        }

        .logout a {
            color: #ff0404;
            font-weight: bold;
        }

        /* ================= */
        /* 🔥 CONTENT FIXED */
        /* ================= */

        .content {
            flex: 1;
            padding: 30px;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            /* 🔥 responsive */
            max-width: 1200px;
            margin: 0 auto;
            color: white;
        }

        /* PROFILE */
        .profile-card {
            flex: 1;
            min-width: 280px;
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            transition: 0.3s;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        /* PROFILE HEADER */
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #3b82f6;
        }

        .name {
            font-size: 18px;
            font-weight: bold;
        }

        .role {
            font-size: 13px;
            color: #94a3b8;
        }

        /* INFO */
        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-row {
            background: #02061780;
            padding: 10px;
            border-radius: 8px;
        }

        .label {
            font-size: 12px;
            color: #94a3b8;
        }

        .value {
            font-size: 14px;
            font-weight: 600;
        }

        /* FORM */
        .form-card {
            flex: 2;
            min-width: 320px;
            background: #1e293b;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            transition: 0.3s;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #3b82f6;
        }

        /* FORM INPUT */
        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            font-size: 13px;
            color: #cbd5e1;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;

            border-radius: 6px;
            border: 1px solid transparent;

            background: #0f172a;
            /* lebih gelap & elegan */
            color: white;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border: 1px solid #3b82f6;
        }

        /* BUTTON */
        .btn {
            width: 100%;
            padding: 12px;
            background: #3b82f6;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #2563eb;
        }

        /* ALERT */
        .success-msg {
            text-align: center;
            color: #34d399;
        }

        .error-msg {
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
                    <h3 class="judul">Sistem <br> Perpustakaan <br> Digital</h3>
                </div>

                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}">
                    <span>{{ $user->name }}</span>
                </div>

            </div>
        </div>

        <div class="main">

            <!-- SIDEBAR -->
            @php $role = auth()->user()->role; @endphp
            <div class="sidebar">
                <a
                    href="{{ $role === 'petugas' ? route('petugas.dashboard') : ($role === 'kepala' ? route('kepala.dashboard') : route('dashboard')) }}">Dashboard</a>
                <a href="{{ route('biodata') }}">Biodata</a>

                @if ($role === 'anggota')
                    <a href="{{ route('buku') }}">Cari Buku</a>
                    <a href="{{ route('peminjaman') }}">Peminjaman</a>
                    <a href="{{ route('pengembalian') }}">Pengembalian</a>
                @elseif($role === 'petugas')
                    <a href="{{ route('petugas.buku') }}">Data Buku</a>
                    <a href="{{ route('petugas.anggota') }}">Data Anggota</a>
                    <a href="{{ route('petugas.peminjaman') }}">Peminjaman</a>
                    <a href="{{ route('petugas.pengembalian') }}">Pengembalian</a>
                @else
                    <a href="{{ route('kepala.anggota') }}">Data Anggota</a>
                    <a href="{{ route('kepala.petugas') }}">Data Petugas</a>
                    <a href="{{ route('kepala.buku') }}">Data Buku</a>
                    <a href="{{ route('kepala.laporan') }}">Laporan</a>
                @endif

                <div class="divider"></div>

                <div class="logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">

                <!-- LEFT PROFILE -->
                <div class="profile-card">

                    <div class="profile-header">
                        <img src="{{ asset('images/profil.png') }}">
                        <div class="name">{{ $user->name }}</div>
                        <div class="role">{{ ucfirst($user->role) }}</div>
                    </div>

                    <div class="profile-info">
                        <div class="info-row">
                            <div class="label">Email</div>
                            <div class="value">{{ $user->email }}</div>
                        </div>

                        <div class="info-row">
                            <div class="label">Tanggal Daftar</div>
                            <div class="value">{{ $user->created_at->format('d F Y') }}</div>
                        </div>

                        @if ($user->kelas)
                            <div class="info-row">
                                <div class="label">Kelas</div>
                                <div class="value">{{ $user->kelas }}</div>
                            </div>
                        @endif

                        @if ($user->no_telp)
                            <div class="info-row">
                                <div class="label">No. Telepon</div>
                                <div class="value">{{ $user->no_telp }}</div>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- RIGHT FORM -->
                <div class="form-card">

                    <h2>Edit Biodata</h2>

                    @if (session('success'))
                        <div class="success-msg">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-msg">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('biodata.update') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" name="kelas" value="{{ old('kelas', $user->kelas) }}">
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password">
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation">
                        </div>

                        <button class="btn">Simpan</button>
                    </form>

                </div>

            </div>

        </div>
    </div>

</body>

</html>
