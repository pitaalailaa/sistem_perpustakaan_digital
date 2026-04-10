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
  color:#f87171;
  font-weight:bold;
}

/* CONTENT */
.content {
  flex:1;
  padding:30px;
  color:white;
  overflow-y:auto;
}

/* HEADER LAPORAN */
.report-header {
  text-align: center;
  margin-bottom: 30px;
  border-bottom: 3px solid #3b82f6;
  padding-bottom: 20px;
}

.report-header h1 {
  font-size: 32px;
  color: white;
  margin-bottom: 5px;
}

.report-header p {
  color: #cbd5e1;
  font-size: 14px;
}

.report-date {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 15px;
  background: #1e293b;
  border-radius: 8px;
  font-size: 13px;
  color: #cbd5e1;
}

/* STATS GRID */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 40px;
}

.stat-card {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 25px;
  border-radius: 12px;
  color: white;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.stat-card.blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
.stat-card.green { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
.stat-card.orange { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
.stat-card.red { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }

.stat-card h4 {
  font-size: 13px;
  opacity: 0.9;
  margin-bottom: 10px;
}

.stat-card .number {
  font-size: 36px;
  font-weight: bold;
}

/* SECTION */
.section {
  margin-bottom: 40px;
}

.section-title {
  font-size: 18px;
  font-weight: bold;
  color: white;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #3b82f6;
}

/* INFO GRID */
.info-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 15px;
  margin-bottom: 30px;
}

.info-item {
  background: #1e293b;
  padding: 20px;
  border-radius: 10px;
  border-left: 4px solid #3b82f6;
}

.info-item label {
  display: block;
  font-size: 12px;
  color: #cbd5e1;
  margin-bottom: 8px;
  text-transform: uppercase;
}

.info-item .value {
  font-size: 24px;
  font-weight: bold;
  color: white;
}

/* TABLE */
.table-container {
  background: #1e293b;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 30px;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
}

thead {
  background: #0f172a;
  color: white;
}

thead th {
  padding: 15px;
  text-align: left;
  font-weight: 600;
}

tbody td {
  padding: 12px 15px;
  border-bottom: 1px solid #334155;
  color: #cbd5e1;
}

tbody tr:hover {
  background: #334155;
}

tbody tr:last-child td {
  border-bottom: none;
}

/* PRINT */
@media print {
  .sidebar, .no-print {
    display: none;
  }
  .content {
    padding: 20px;
  }
}

.print-btn {
  background: #3b82f6;
  color: white;
  border: none;
  padding: 10px 25px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  margin-bottom: 20px;
  display: inline-block;
}

.print-btn:hover {
  background: #2563eb;
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
        <img src="{{ asset('images/profil.png') }}" alt="kepala">
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
      <a href="{{ route('kepala.biodata') }}" class="active">Biodata</a>

      <div class="divider"></div>

      <div class="logout">
        <a href="/logout">Logout</a>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

      <button class="no-print print-btn" onclick="window.print()">📄 Cetak Laporan</button>

      <!-- HEADER -->
      <div class="report-header">
        <h1>📊 LAPORAN PERPUSTAKAAN DIGITAL</h1>
        <p>Ringkasan Statistik dan Analisis Data Sistem Perpustakaan</p>
      </div>

      <!-- TANGGAL -->
      <div class="report-date">
        <span><strong>Tanggal Laporan:</strong> {{ now()->format('d F Y') }}</span>
        <span><strong>Jam:</strong> {{ now()->format('H:i') }} WIB</span>
        <span><strong>Penggunaan Sistem:</strong> Tahun {{ now()->year }}</span>
      </div>

      <!-- STATS -->
      <div class="stats-grid">
        <div class="stat-card blue">
          <h4>TOTAL BUKU</h4>
          <div class="number">{{ $totalBuku }}</div>
        </div>
        <div class="stat-card green">
          <h4>TOTAL ANGGOTA</h4>
          <div class="number">{{ $totalAnggota }}</div>
        </div>
        <div class="stat-card orange">
          <h4>TOTAL PETUGAS</h4>
          <div class="number">{{ $totalPetugas }}</div>
        </div>
        <div class="stat-card red">
          <h4>TOTAL PEMINJAMAN</h4>
          <div class="number">{{ $totalPeminjaman }}</div>
        </div>
      </div>

      <!-- ANALISIS DETAIL -->
      <div class="section">
        <h2 class="section-title">📈 ANALISIS DETAIL</h2>

        <div class="info-grid">
          <div class="info-item">
            <label>Belum Dikembalikan</label>
            <div class="value" style="color: #ef4444;">{{ $belumKembali }}</div>
          </div>
          <div class="info-item">
            <label>Total Denda</label>
            <div class="value" style="color: #f59e0b;">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
          </div>
          <div class="info-item">
            <label>Buku Terlaris</label>
            <div class="value" style="color: #3b82f6; font-size: 18px;">{{ $topBook->buku->judul ?? '-' }}</div>
          </div>
          <div class="info-item">
            <label>Anggota Teraktif</label>
            <div class="value" style="color: #22c55e; font-size: 18px;">{{ $topUser->user->name ?? '-' }}</div>
          </div>
        </div>
      </div>

      <!-- TABEL PEMINJAMAN TERBARU -->
      <div class="section">
        <h2 class="section-title">📋 DATA PEMINJAMAN TERBARU (5 TRANSAKSI TERAKHIR)</h2>

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recent as $index => $r)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $r->user->name }}</td>
                <td>{{ $r->buku->judul }}</td>
                <td>{{ $r->borrowed_at ? \Carbon\Carbon::parse($r->borrowed_at)->format('d/m/Y') : '-' }}</td>
                <td>
                  <span style="
                    padding: 5px 10px;
                    border-radius: 6px;
                    font-weight: bold;
                    @if($r->status == 'pending') background: #fef3c7; color: #92400e;
                    @elseif($r->status == 'dipinjam') background: #dbeafe; color: #0c4a6e;
                    @elseif($r->status == 'kembali') background: #dcfce7; color: #166534;
                    @elseif($r->status == 'request_kembali') background: #fce7f3; color: #831843;
                    @elseif($r->status == 'dikembalikan') background: #d1d5db; color: #1f2937;
                    @endif
                  ">
                    {{ ucfirst($r->status) }}
                  </span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data peminjaman</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- FOOTER -->
      <div style="text-align: center; margin-top: 50px; padding-top: 20px; border-top: 1px solid #334155; color: #64748b; font-size: 12px;">
        <p>Laporan ini dibuat otomatis oleh Sistem Perpustakaan Digital</p>
        <p>{{ now()->format('d F Y H:i:s') }}</p>
      </div>

    </div>

  </div>

</div>

</body>
</html>
