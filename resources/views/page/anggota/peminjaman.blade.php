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

        .divider {
            border-top: 1px solid #475569;
            margin: 440px 10px;
        }

        .logout {
            position: absolute;
            bottom: 2px;
            width: 100%;
            text-align: center;
        }

        .logout a {
            color: #fe0404;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        /* HEADER HALAMAN */
        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h2 {
            color: #3b82f6;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #94a3b8;
            font-size: 16px;
        }

        /* TABLE */
        .peminjaman-table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #3b82f6;
        }

        .peminjaman-table th {
            background: #0f172a;
            padding: 14px;
        }

        .peminjaman-table td {
            padding: 14px;
            text-align: center;
        }

        .peminjaman-table tr:not(:last-child) {
            border-bottom: 1px solid #334155;
        }

        /* STATUS */
        .status-dipinjam {
            color: #3b82f6;
            font-weight: bold;
        }

        /* BUTTON */
        .btn-kembali {
            background: #3b82f6;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            margin-bottom: 6px;
        }

        .btn-kembali:hover {
            background: #2563eb;
        }

        .btn-denda {
            background: #f59e0b;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
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

                <div class="left-box">
                    <div class="logo">
                        <img src="{{ asset('images/logoperpus.png') }}">
                    </div>
                    <h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3>
                </div>

                <div class="user-box">
                    <img src="{{ asset('images/profil.png') }}">
                    <span>{{ $user->name ?? 'Anggota' }}</span>
                </div>

            </div>
        </div>

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

            <!-- CONTENT -->
            <div class="content">

                <div class="page-header">
                    <h2>Data Peminjaman</h2>
                    <p>Daftar buku yang sedang atau pernah kamu pinjam.</p>
                </div>

                @if (session('success'))
                    <div style="background:#14532d;color:#dcfce7;padding:12px;border-radius:10px;margin-bottom:15px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error') || session('info'))
                    <div style="background:#7c2d12;color:#ffedd5;padding:12px;border-radius:10px;margin-bottom:15px;">
                        {{ session('error') ?? session('info') }}
                    </div>
                @endif

                <table class="peminjaman-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peminjamans as $item)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->kelas ?? '-' }}</td>
                                <td>{{ $item->buku->judul ?? '-' }}</td>
                                <td>{{ $item->borrowed_at ?? '-' }}</td>
                                <td>{{ $item->due_date ?? '-' }}</td>

                                <td class="status-{{ $item->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->outstanding_denda, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if ($item->status === 'dipinjam')
                                        <form method="POST" action="{{ route('peminjaman.kembali', $item->id) }}">
                                            @csrf
                                            <button class="btn-kembali">Kembalikan</button>
                                        </form>

                                        <form method="POST" action="{{ route('peminjaman.bayar-denda', $item->id) }}">
                                            @csrf
                                            <button class="btn-denda" {{ $item->can_pay_denda ? '' : 'disabled' }}>
                                                Bayar
                                            </button>
                                        </form>

                                    @elseif($item->status === 'pending')
                                        Menunggu Persetujuan

                                    @else
                                        Selesai
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