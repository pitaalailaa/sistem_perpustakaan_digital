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

        /* === PENGEMBALIAN === */

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

        /* box utama biar center & rapi */
        .pengembalian-box {
            width: 100%;
            margin: 0;
        }

        /* judul lebih clean */
        .pengembalian-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: bold;
            color: #3b82f6;
        }

        /* tabel */
        .pengembalian-table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 14px;
            overflow: hidden;
            font-size: 15px;
            border: 2px solid #3b82f6;
            font-size: 15px;   
        }

        /* header tabel */
        .pengembalian-table th {
            background: #0f172a;
            padding: 16px;
            font-size: 15px
        }

        /* isi tabel */
        .pengembalian-table td {
            padding: 16px;
            text-align: center;
        }

        /* garis antar row */
        .pengembalian-table tr:not(:last-child) {
            border-bottom: 1px solid #334155;
        }

        /* hover biar hidup */
        .pengembalian-table tr:hover {
            background: #273449;
        }

        .status-request {
            color: #fbbf24;
            font-weight: bold;
        }

        .status-dikembalikan {
            color: #22c55e;
            font-weight: bold;
        }

        .status-pinjam {
            color: #38bdf8;
            font-weight: bold;
        }

        .status-telat {
            color: #f97316;
            font-weight: bold;
        }

        .status-tepat {
            color: #34d399;
            font-weight: bold;
        }

        .btn-denda {
            background: #f59e0b;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 14px;
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

                <div class="pengembalian-box">

                    <div class="pengembalian-title">Pengembalian</div>

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

                    <table class="pengembalian-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Judul buku</th>
                                <th>Tgl pinjam</th>
                                <th>Tgl kembali</th>
                                <th>Status</th>
                                <th>denda</th>
                                <th>aksi denda</th>
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
                                    @php
                                        $statusClass = 'status-request';
                                        $statusLabel = 'Menunggu Persetujuan';
                                        if ($item->status === 'dikembalikan') {
                                            $statusClass = 'status-dikembalikan';
                                            $statusLabel = 'Dikembalikan';
                                        } elseif ($item->status === 'dipinjam') {
                                            $statusClass = 'status-pinjam';
                                            $statusLabel = 'Dipinjam';
                                        }
                                    @endphp
                                    <td class="{{ $statusClass }}">{{ $statusLabel }}</td>
                                    <td>
                                        Rp. {{ number_format($item->outstanding_denda, 0, ',', '.') }}
                                        @if ($item->is_denda_paid && $item->denda > 0)
                                            <div style="color:#22c55e;font-size:12px;margin-top:6px;">Lunas</div>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('peminjaman.bayar-denda', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="btn-denda" {{ $item->can_pay_denda ? '' : 'disabled' }}>
                                                Bayar Denda
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Belum ada data pengembalian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
