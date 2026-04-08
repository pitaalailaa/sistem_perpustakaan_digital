<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

<div class="container">

    <h2>Form Peminjaman</h2>

    <form action="{{ route('buku.pinjam', $buku->id) }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" value="{{ $user->name }}" readonly>

        <label>Kelas</label>
        <input type="text" value="{{ $user->kelas }}" readonly>

        <label>Judul Buku</label>
        <input type="text" value="{{ $buku->judul }}" readonly>

        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" onchange="hitungDenda()" required>

        <label>Denda</label>
        <p id="denda">Rp 0</p>

        <button type="submit">Pinjam</button>

    </form>

</div>

<script>
function hitungDenda() {
    let tanggal = document.getElementById('tanggal_pinjam').value;

    if (!tanggal) return;

    let tgl = new Date(tanggal);
    let today = new Date();

    let selisih = Math.floor((today - tgl) / (1000 * 60 * 60 * 24));

    let denda = 0;
    if (selisih > 5) {
        denda = (selisih - 5) * 3000;
    }

    document.getElementById('denda').innerText = "Rp " + denda;
}
</script>