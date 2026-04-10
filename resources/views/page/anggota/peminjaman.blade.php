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
            color: #f87171;
            font-weight: bold;
        }

        /* === PEMINJAMAN BESAR + TENGAH === */

        .content {
            flex: 1;
            padding: 30px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        .peminjaman-box.peminjaman-box {
            width: 100%;
            margin: 0;
        }

        .peminjaman-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: bold;
            color: #3b82f6;
        }

        .peminjaman-table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #3b82f6;
            font-size: 15px;
        }

        .peminjaman-table th {
            background: #0f172a;
            padding: 16px;
            font-size: 15px;
        }

        .peminjaman-table td {
            padding: 16px;
            text-align: center;
        }

        .peminjaman-table tr:not(:last-child) {
            border-bottom: 1px solid #334155;
        }

        .status-dipinjam {
            color: #3b82f6;
            font-weight: bold;
        }

        .btn-kembali {
            background: #3b82f6;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-kembali:hover {
            background: #2563eb;
        }

        .btn-denda {
            background: #f59e0b;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 14px;
            margin-top: 8px;
        }

        .btn-denda[disabled] {
            background: #64748b;
            cursor: not-allowed;
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
                    <img src="{{ asset('images/profil.png') }}" alt="anggota">
                    <span>{{ $user->name ?? 'Anggota' }}</span>
                </div>

            </div>
        </div>

        <!-- MAIN -->
        <div class="main">

            <!-- SIDEBAR -->
            <div class="sidebar">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('biodata') }}">Biodata</a>
                <a href="{{ route('buku') }}">Cari Buku</a>
                <a href="{{ route('peminjaman') }}">Peminjaman</a>
                <a href="{{ route('pengembalian') }}">Pengembalian</a>


                <div class="divider"></div>

                <div class="logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>

            <div class="content">

                <div class="peminjaman-box">

                    <div class="peminjaman-title">Peminjaman</div>

                    @if (session('success'))
                        <div style="background:#14532d;color:#dcfce7;padding:12px 16px;border-radius:10px;margin-bottom:16px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error') || session('info'))
                        <div style="background:#7c2d12;color:#ffedd5;padding:12px 16px;border-radius:10px;margin-bottom:16px;">
                            {{ session('error') ?? session('info') }}
                        </div>
                    @endif

                    <table class="peminjaman-table">
                        <thead>
                            <tr>
                                <th>nama</th>
                                <th>kelas</th>
                                <th>judul buku</th>
                                <th>tgl pinjam</th>
                                <th>tgl kembali</th>
                                <th>status</th>
                                <th>denda</th>
                                <th>aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($peminjamans as $item)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->kelas ?? 'Tidak diisi' }}</td>
                                    <td>{{ $item->buku->judul ?? '-' }}</td>
                                    <td>{{ $item->borrowed_at ?? '-' }}</td>
                                    <td>{{ $item->due_date ?? '-' }}</td>
                                    <td class="status-{{ $item->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                                    <td>
                                        Rp. {{ number_format($item->outstanding_denda, 0, ',', '.') }}
                                        @if ($item->is_denda_paid && $item->denda > 0)
                                            <div style="color:#22c55e;font-size:12px;margin-top:6px;">Lunas</div>
                                        @elseif($item->outstanding_denda > 0)
                                            <div style="color:#f59e0b;font-size:12px;margin-top:6px;">Terlambat</div>
                                        @else
                                            <div style="color:#94a3b8;font-size:12px;margin-top:6px;">Belum ada denda</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'dipinjam')
                                            <form method="POST" action="{{ route('peminjaman.kembali', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-kembali">Ajukan Pengembalian</button>
                                            </form>
                                            <form method="POST" action="{{ route('peminjaman.bayar-denda', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-denda" {{ $item->can_pay_denda ? '' : 'disabled' }}>
                                                    Bayar Denda
                                                </button>
                                            </form>
                                        @elseif($item->status === 'request_kembali')
                                            <div>Menunggu persetujuan petugas</div>
                                            <form method="POST" action="{{ route('peminjaman.bayar-denda', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-denda" {{ $item->can_pay_denda ? '' : 'disabled' }}>
                                                    Bayar Denda
                                                </button>
                                            </form>
                                        @elseif($item->status === 'pending')
                                            Menunggu persetujuan pinjam
                                        @else
                                            <div>Selesai</div>
                                            <form method="POST" action="{{ route('peminjaman.bayar-denda', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-denda" {{ $item->can_pay_denda ? '' : 'disabled' }}>
                                                    Bayar Denda
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Belum ada peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
</body>

</html>
