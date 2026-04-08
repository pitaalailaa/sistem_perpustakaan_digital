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
        }

        /* BUTTON */
        .btn-tambah {
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin: 5px;
        }

        .btn-edit {
            background: #1d4ed8;
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-hapus {
            background: #dc2626;
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background: #334155;
        }

        /* FORM KATEGORI */
        .form-kategori {
            display: none;
            margin-top: 15px;
            text-align: center;
        }

        .form-kategori input {
            padding: 8px;
            border-radius: 6px;
            border: none;
            width: 200px;
            margin-right: 10px;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #1e293b;
            margin: 15% auto;
            padding: 30px;
            border: 1px solid #475569;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            color: white;
        }

        .modal-content h3 {
            margin-top: 0;
            color: #3b82f6;
            text-align: center;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-content input {
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #334155;
            color: white;
        }

        .modal-content input:focus {
            outline: none;
            border: 1px solid #3b82f6;
        }

        .modal-content button {
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: white;
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
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="main">
     <!-- SIDEBAR -->
            <div class="sidebar">
                <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
                <a href="{{ route('petugas.biodata') }}">Biodata</a>
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

                <h2 style="text-align:center;">Data Buku</h2>

                <div style="text-align:center; margin-bottom:20px;">
                    <a href="{{ route('petugas.buku.create') }}">
                        <button class="btn-tambah">+ Tambah Buku</button>
                    </a>

                    <button onclick="openModal()" class="btn-tambah" style="background:#22c55e;">
                        + Tambah Kategori
                    </button>
                </div>

                @if (session('success'))
                    <p style="text-align:center; color:#4ade80;">{{ session('success') }}</p>
                @endif

                <!-- TABLE BUKU -->
                <table>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                    @foreach ($books as $i => $book)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category?->name ?? '-' }}</td>
                            <td>{{ $book->status }}</td>
                            <td>
                                <a href="{{ route('petugas.buku.edit', $book->id) }}">
                                    <button class="btn-edit">✏️</button>
                                </a>

                                <form action="{{ route('petugas.buku.destroy', $book->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <!-- TABLE KATEGORI -->
                <h3 style="margin-top:40px;">Data Kategori</h3>

                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>

                    @foreach ($kategoris as $i => $k)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <form action="{{ route('kategori.update', $k->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $k->name }}">
                                    <button class="btn-edit">✔️</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>

        <!-- MODAL TAMBAH KATEGORI -->
        <div id="kategoriModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Tambah Kategori Baru</h3>
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nama kategori" required>
                    <button type="submit" class="btn-tambah" style="background:#22c55e;">Simpan</button>
                </form>
            </div>
        </div>

        <script>
            function openModal() {
                document.getElementById('kategoriModal').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('kategoriModal').style.display = 'none';
            }

            window.onclick = function(event) {
                var modal = document.getElementById('kategoriModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        </script>

</body>

</html>
