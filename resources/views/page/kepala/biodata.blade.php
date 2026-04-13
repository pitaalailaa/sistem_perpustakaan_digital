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

        /* ========================= */
        /* 🔥 CONTENT MODERN */
        /* ========================= */

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
            color: white;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        /* CARD */
        .profile-card {
            width: 700px;
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
            overflow: hidden;
        }

        /* glow effect */
        .profile-card::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent 70%);
            transform: rotate(25deg);
        }

        /* HEADER PROFILE */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #3b82f6;
        }

        .name {
            font-size: 22px;
            font-weight: bold;
        }

        .role {
            font-size: 14px;
            color: #94a3b8;
        }

        /* TITLE */
        .profile-title {
            font-size: 24px;
            color: #3b82f6;
            margin-bottom: 25px;
        }

        /* GRID */
        .profile-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ITEM */
        .info-row {
            background: #02061780;
            padding: 15px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: 0.3s;
        }

        .info-row:hover {
            transform: translateY(-3px);
            border-color: #3b82f6;
        }

        .label {
            font-size: 13px;
            color: #94a3b8;
        }

        .value {
            font-size: 16px;
            font-weight: 600;
            color: #e2e8f0;
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
                    <span>{{ $user->name }} ({{ ucfirst($user->role) }})</span>
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
                <a href="{{ route('kepala.biodata') }}" class="active">Biodata</a>

                <div class="divider"></div>

                <div class="logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">

                <div class="profile-card">

                    <div class="profile-header">
                        <img src="{{ asset('images/profil.png') }}">
                        <div>
                            <div class="name">{{ $user->name }}</div>
                            <div class="role">{{ ucfirst($user->role) }}</div>
                        </div>
                    </div>

                    <div class="profile-title"> Profil Kepala Perpustakaan</div>

                    <div class="profile-info">

                        <div class="info-row">
                            <span class="label">Nama Lengkap</span>
                            <span class="value">{{ $user->name }}</span>
                        </div>

                        <div class="info-row">
                            <span class="label">Email</span>
                            <span class="value">{{ $user->email }}</span>
                        </div>

                        <div class="info-row">
                            <span class="label">Role</span>
                            <span class="value">{{ ucfirst($user->role) }}</span>
                        </div>

                        <div class="info-row">
                            <span class="label">Tanggal Daftar</span>
                            <span class="value">{{ $user->created_at->format('d F Y') }}</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
