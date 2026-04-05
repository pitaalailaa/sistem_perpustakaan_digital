<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<style>
body{margin:0;font-family:sans-serif;}
html, body{margin:0;padding:0;height:100%;overflow:hidden;}
.background{background-color:#051031;min-height:100vh;}
.header{width:100%;height:100px;background-color:#170a6b40;}
.header-content{display:flex;align-items:center;justify-content:space-between;height:100%;padding:0 20px;}
.left-box{display:flex;align-items:center;gap:5px;}
.logo img{width:90px;}
.judul{color:white;font-size:20px;margin:0;}
.user-box{display:flex;align-items:center;gap:20px;color:white;}
.user-box img{width:45px;height:45px;border-radius:50%;}
.main{display:flex;height:calc(100vh - 100px);}
.sidebar{width:270px;background-color:#170a6b40;padding-top:20px;position:relative;}
.sidebar a{display:block;text-align:center;padding:12px 20px;color:#f4f4f4;text-decoration:none;margin:5px 10px;border-radius:8px;font-weight:bold;font-size:18px;}
.sidebar a:hover{background:#335077;}
.divider {border-top:1px solid #475569;margin:460px 10px;}
.logout {position:absolute;bottom:2px;width:100%;text-align:center;}
.logout a {color:#f87171;font-weight:bold;}
.content{flex:1;padding:30px;color:white;}
.btn-tambah{background:#2563eb;color:white;padding:10px 20px;border:none;border-radius:8px;font-weight:bold;cursor:pointer;margin-bottom:12px;}
table{width:100%;border-collapse:collapse;margin-top:20px;background:#1e293b;border-radius:12px;overflow:hidden;}
th, td{padding:12px;text-align:center;}
th{background:#334155;color:#e2e8f0;}
</style>
</head>
<body>
<div class="background">
<div class="header"><div class="header-content"><div class="left-box"><div class="logo"><img src="{{ asset('images/logoperpus.png') }}"></div><h3 class="judul">Sistem<br>Perpustakaan<br>Digital</h3></div><div class="user-box"><img src="{{ asset('images/profil.png') }}"><span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span></div></div></div>
<div class="main">
<div class="sidebar"><a href="{{ route('kepala.dashboard') }}">Dashboard</a><a href="{{ route('kepala.anggota') }}">Data Anggota</a><a href="{{ route('kepala.petugas') }}">Data Petugas</a><a href="{{ route('kepala.buku') }}">Data Buku</a><a href="{{ route('kepala.laporan') }}">Laporan</a><a href="{{ route('biodata') }}">Biodata</a><div class="divider"></div><div class="logout"><a href="/logout">Logout</a></div></div>
<div class="content"><h2 style="text-align:center;">Data Petugas</h2>
<a href="{{ route('kepala.petugas.create') }}"><button class="btn-tambah">+ Tambah Petugas</button></a>
@if(session('success'))<p style="text-align:center;color:#4ade80;">{{ session('success') }}</p>@endif
<table>
<tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th><th>Dibuat</th></tr>
@foreach($petugas as $i => $p)
<tr><td>{{ $i+1 }}</td><td>{{ $p->name }}</td><td>{{ $p->email }}</td><td>{{ ucfirst($p->role) }}</td><td>{{ $p->created_at->format('Y-m-d') }}</td></tr>
@endforeach
</table>
</div>
</div>
</div>
</body>
</html>