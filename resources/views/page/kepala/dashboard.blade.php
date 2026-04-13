<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<style>
body{
  margin:0;
  font-family:sans-serif;
}

html, body{
  margin:0;
  padding:0;
  height:100%;
  overflow:hidden;
}

/* BACKGROUND */
.background{
  background-color:#051031;
  min-height:100vh;
}

/* HEADER */
.header{
  width:100%;
  height:100px;
  background-color:#170a6b40;
}

.header-content{
  display:flex;
  align-items:center;
  justify-content:space-between;
  height:100%;
  padding:0 20px;
}

/* KIRI (LOGO + JUDUL) */
.left-box{
  display:flex;
  align-items:center;
  gap:5px;
}

.logo img{
  width:90px;
  height:auto;
}

.judul{
  color:white;
  font-size:20px;
  line-height:1.2;
  margin:0;
}

/* USER */
.user-box{
  display:flex;
  align-items:center;
  gap:20px;
  color:white;
}

.user-box img{
  width:45px;
  height:45px;
  border-radius:50%;
}

/* LAYOUT */
.main{
  display:flex;
  height:calc(100vh - 100px);
}

/* SIDEBAR */
.sidebar{
  width:270px;
  background-color:#170a6b40;
  padding-top:32px;
  position:relative;
  margin-top: 6px;
}

.sidebar a {
  display:block;
  text-align:center;
  padding:12px 20px;
  color:#f4f4f4;
  text-decoration:none;
  margin:5px 10px;
  border-radius:8px;
  font-weight:bold;
  font-size:18px;
}

.sidebar a:hover {
  background:#335077;
}

/* divider */
.divider {
  border-top:1px solid #475569;
  margin:390px 10px;
}

/* logout bawah */
.logout {
  position:absolute;
  bottom:2px;
  width:100%;
  text-align:center;
}

.logout a {
  color:#fb0808;
  font-weight:bold;
}

/* CONTENT */
.content{
  flex:1;
  padding:30px;
  color:white;
  overflow-y:auto;
  padding-bottom:60px;
}

/* TITLE */
.content h2{
  margin-bottom:5px;
}

.content p{
  color:#94a3b8;
  margin-bottom:20px;
}

/* CARDS */
.cards{
  display:flex;
  gap:20px;
  margin-bottom:25px;
}

.card{
  flex:1;
  border-radius:12px;
  padding:20px;
  color:white;
  display:flex;
  flex-direction:column;
  justify-content:center;
  box-shadow:0 8px 20px rgba(0,0,0,0.25);
  transition:0.3s;
}

.card:hover{
  transform:translateY(-5px);
}

/* warna beda tiap card */
.card1{
  background:linear-gradient(135deg,#3b82f6,#1d4ed8);
}

.card2{
  background:linear-gradient(135deg,#6366f1,#4338ca);
}

.card3{
  background:linear-gradient(135deg,#0ea5e9,#0369a1);
}

.card5{
  background:linear-gradient(135deg,#22c55e,#16a34a);
}

/* isi card */
.card h3{
  font-size:14px;
  margin-bottom:5px;
  color:#e2e8f0;
}

.card p{
  font-size:22px;
  font-weight:bold;
  margin:0;
  color:white;
}

/* ================= TABLE BARU ================= */

table{
  width:100%;
  border-collapse:collapse;
  margin-top:15px;
  background:#1e293b;
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.35);
  border:1px solid rgba(59,130,246,0.2);
}

th, td{
  padding:14px 10px;
  text-align:center;
  font-size:13px;
}

th{
  background:#0f172a;
  color:#cbd5f5;
  font-weight:600;
  text-transform:uppercase;
  letter-spacing:0.6px;
}

tr:not(:last-child){
  border-bottom:1px solid #334155;
}

tr:hover{
  background:#273449;
}

/* STATUS */
.status-badge{
  padding:5px 10px;
  border-radius:8px;
  font-size:11px;
  font-weight:bold;
}

.status-kembali{
  background:rgba(56,189,248,0.2);
  color:#38bdf8;
}

.status-pinjam{
  background:rgba(250,204,21,0.2);
  color:#facc15;
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

  <h2>Dashboard Kepala Perpustakaan</h2>
  <p>Selamat datang, {{ auth()->user()->name }}. Di sini Anda dapat memantau statistik utama perpustakaan.</p>

  <!-- CARDS -->
  <div class="cards">
    <div class="card card1">
      <h3>Total Buku</h3>
      <p>{{ number_format($totalBuku, 0, ',', '.') }}</p>
    </div>

    <div class="card card2">
      <h3>Total Anggota</h3>
      <p>{{ number_format($totalAnggota, 0, ',', '.') }}</p>
    </div>

    <div class="card card5">
      <h3>Peminjaman Aktif</h3>
      <p>{{ number_format($totalBelumKembali, 0, ',', '.') }}</p>
    </div>

    <div class="card card3">
      <h3>Total Peminjaman</h3>
      <p>{{ number_format($totalPeminjaman, 0, ',', '.') }}</p>
    </div>
  </div>

  <h3>Data Peminjaman Terbaru</h3>

  <table>
    <tr>
      <th>Nama</th>
      <th>Kelas</th>
      <th>Judul Buku</th>
      <th>Tgl Pinjam</th>
      <th>Tgl Kembali</th>
      <th>Status</th>
    </tr>

    @forelse($recentPeminjaman as $peminjaman)
      <tr>
        <td>{{ $peminjaman->user->name ?? '-' }}</td>
        <td>{{ $peminjaman->user->kelas ?? '-' }}</td>
        <td style="font-weight:600;">{{ $peminjaman->buku->judul ?? '-' }}</td>
        <td>{{ $peminjaman->borrowed_at ?? '-' }}</td>
        <td>{{ $peminjaman->due_date ?? '-' }}</td>
        <td>
          <span class="status-badge {{ $peminjaman->status === 'dikembalikan' ? 'status-kembali' : 'status-pinjam' }}">
            {{ ucfirst($peminjaman->status) }}
          </span>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6" style="color:#94a3b8;">Belum ada peminjaman.</td>
      </tr>
    @endforelse
  </table>

</div>
</div>
</div>

</body>
</html>