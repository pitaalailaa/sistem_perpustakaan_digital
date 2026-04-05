# Study Guide - Ujian Kompetensi Perpustakaan Digital

**Purpose**: Persiapan menghadapi pertanyaan teknis coding untuk menjaga kredibilitas bahwa kode adalah karya sendiri.

---

## 📍 ROUTING & CONTROLLERS

### ANGGOTA (Member/User)
**File**: `routes/web.php` (Lines 45-59)

| Fitur | Route | Method | Controller | File |
|-------|-------|--------|------------|------|
| Dashboard | `/anggota` | GET | `AnggotaController@dashboard` | `page/anggota/dashboard.blade.php` |
| Biodata | `/biodata` | GET/POST | `AnggotaController@biodata/updateBiodata` | `page/anggota/biodata.blade.php` |
| Cari Buku | `/buku` | GET | `BukuController@index` | `page/anggota/cari-buku.blade.php` |
| Detail Buku | `/buku/{id}` | GET | `BukuController@show` | `page/anggota/detail-buku.blade.php` |
| Pinjam Buku | `/buku/{id}/pinjam` | POST | `AnggotaController@pinjam` | - |
| Riwayat Peminjaman | `/peminjaman` | GET | `AnggotaController@peminjaman` | `page/anggota/peminjaman.blade.php` |
| Kembalikan Buku | `/peminjaman/{id}/kembali` | POST | `AnggotaController@kembalikan` | - |
| Status Pengembalian | `/pengembalian` | GET | `AnggotaController@pengembalian` | `page/anggota/pengembalian.blade.php` |

**Key Questions**:
- P: "Bagaimana user bisa pinjam buku?"
- A: `POST /buku/{id}/pinjam` di AnggotaController, method `pinjam()` line X. Cek status buku di Buku model dulu.
- P: "Data peminjaman disimpan di mana?"
- A: Peminjaman model → `peminjamans` table. Method `peminjaman()` ambil data dengan `Peminjaman::where('user_id', $user->id)`
- P: "Pengembalian buku di route mana?"
- A: `POST /peminjaman/{id}/kembali` → method `kembalikan()` di AnggotaController

---

### PETUGAS (Staff)
**File**: `routes/web.php` (Lines 61-96)
**Prefix**: `/petugas`

| Fitur | Route | Method | Controller | File |
|-------|-------|--------|------------|------|
| Dashboard | `/dashboard` | GET | `PetugasController@dashboard` | `page/petugas/dashboard.blade.php` |
| Biodata | `/biodata` | GET/POST | `PetugasController@biodata/updateBiodata` | `page/petugas/biodata.blade.php` |
| **BUKU Management** |
| List Buku | `/buku` | GET | `PetugasController@buku` | `page/petugas/data-buku.blade.php` |
| Add Buku | `/buku/create` | GET | `PetugasController@createBuku` | `page/petugas/buku-create.blade.php` |
| Store Buku | `/buku` | POST | `PetugasController@storeBuku` | - |
| Edit Buku Form | `/buku/{id}/edit` | GET | `PetugasController@editBuku` | `page/petugas/buku-edit.blade.php` |
| Update Buku | `/buku/{id}` | PUT | `PetugasController@updateBuku` | - |
| Delete Buku | `/buku/{id}` | DELETE | `PetugasController@destroyBuku` | - |
| **KATEGORI Management** |
| Add Kategori | `/kategori` | POST | `PetugasController@storeKategori` | - |
| Update Kategori | `/kategori/{id}` | PUT | `PetugasController@updateKategori` | - |
| Delete Kategori | `/kategori/{id}` | DELETE | `PetugasController@deleteKategori` | - |
| **ANGGOTA** |
| List Anggota | `/anggota` | GET | `PetugasController@anggota` | `page/petugas/data-anggota.blade.php` |
| **PEMINJAMAN** |
| List Peminjaman | `/peminjaman` | GET | `PetugasController@peminjaman` | `page/petugas/peminjaman.blade.php` |
| Konfirmasi Peminjaman | `/peminjaman/{id}/konfirmasi` | POST | `PetugasController@konfirmasiPeminjaman` | - |
| **PENGEMBALIAN** |
| List Pengembalian | `/pengembalian` | GET | `PetugasController@pengembalian` | `page/petugas/pengembalian.blade.php` |
| Konfirmasi Pengembalian | `/pengembalian/{id}/konfirmasi` | POST | `PetugasController@konfirmasiPengembalian` | - |

**Key Questions**:
- P: "Bagaimana petugas menambah buku?"
- A: GET `/petugas/buku/create` → form di buku-create.blade.php → POST ke `/petugas/buku` → method `storeBuku()` di PetugasController
- P: "Data buku disimpan di model apa?"
- A: `Buku` model → table `bukus` (bisa cek di migration 2026_04_02_000000_create_books_table.php)
- P: "Kategori bisa diubah di mana?"
- A: Route `PUT /petugas/kategori/{id}` → method `updateKategori()` di PetugasController
- P: "Gimana request peminjaman dikonfirmasi oleh petugas?"
- A: Route `POST /petugas/peminjaman/{id}/konfirmasi` → method `konfirmasiPeminjaman()` → update status Peminjaman model

---

### KEPALA (Library Head/Admin)
**File**: `routes/web.php` (Lines 98-113)
**Prefix**: `/kepala`

| Fitur | Route | Method | Controller | File |
|-------|-------|--------|------------|------|
| Dashboard | `/dashboard` | GET | `KepalaController@dashboard` | `page/kepala/dashboard.blade.php` |
| Biodata | `/biodata` | GET | `KepalaController@biodata` | `page/kepala/biodata.blade.php` |
| Laporan | `/laporan` | GET | `KepalaController@laporan` | `page/kepala/laporan.blade.php` |
| List Buku | `/buku` | GET | `KepalaController@buku` | `page/kepala/data-buku.blade.php` |
| List Anggota | `/anggota` | GET | `KepalaController@anggotaList` | `page/kepala/data-anggota.blade.php` |
| List Petugas | `/petugas` | GET | `KepalaController@petugasList` | `page/kepala/data-petugas.blade.php` |
| Create Petugas | `/petugas/create` | GET | `KepalaController@createPetugas` | `page/kepala/petugas-create.blade.php` |

**Key Questions**:
- P: "Laporan ditampilkan di route mana?"
- A: GET `/kepala/laporan` → method `laporan()` di KepalaController → view di page/kepala/laporan.blade.php
- P: "Data apa saja yang ditampilkan di laporan?"
- A: totalBuku, totalAnggota, totalPetugas, totalPeminjaman, topBook (buku paling dipinjam), topUser (anggota paling aktif), belumKembali, totalDenda, recent transactions
- P: "Kepala bisa lihat list petugas di mana?"
- A: Route `GET /kepala/petugas` → method `petugasList()` di KepalaController

---

## 📂 MODELS & DATABASE

### Model Structure
**Location**: `app/Models/`

| Model | Table | Key Fields | Relations |
|-------|-------|-----------|-----------|
| **User** | `users` | id, name, email, password, role, kelas, no_telp | peminjamans (one-to-many) |
| **Buku** | `bukus` | id, judul, pengarang, penerbit, isbn, status, category_id | category (belongsTo), peminjamans (one-to-many) |
| **Category** | `categories` | id, nama | bukus (one-to-many) |
| **Peminjaman** | `peminjamans` | id, user_id, buku_id, borrowed_at, returned_at, status, denda | user (belongsTo), buku (belongsTo) |

**Questions about Models**:
- P: "User punya role apa saja?"
- A: 'anggota', 'petugas', 'admin' (kepala). Cek di User migration atau middleware role untuk validasi.
- P: "Status buku apa saja?"
- A: 'tersedia' atau 'dipinjam'. Cek saat user pinjam di AnggotaController method `pinjam()` - ada validasi `if ($buku->status !== 'tersedia')`
- P: "Status peminjaman yang bisa ada?"
- A: 'pending', 'dipinjam', 'request_kembali', 'kembali', 'dikembalikan' (cek di file migration 2026_04_04_000000_update_peminjaman_status_enum.php)
- P: "Denda disimpan di mana?"
- A: Di table `peminjamans` kolom `denda`. Bisa dihitung otomatis atau diset manual saat pengembalian.

---

## 🔐 MIDDLEWARE & AUTH

**File**: `app/Http/Middleware/`

### Middleware Role
- `role:petugas` → hanya user dengan role 'petugas' bisa akses
- `role:admin` → hanya user dengan role 'admin' (kepala) bisa akses
- `auth` → harus login (berlaku untuk anggota juga)

**Questions**:
- P: "Bagaimana sistem memastikan petugas tidak bisa akses halaman kepala?"
- A: Middleware `role:petugas` dan `role:admin` di routes. Cek di routes/web.php Line 61 dan 98 - prefix `/petugas` pakai middleware `['auth', 'role:petugas']`
- P: "Anggota bisa akses dashboard petugas?"
- A: Tidak. Middleware `role:petugas` hanya izinkan role 'petugas'. Kalo user normal (anggota) coba akses, bakal di-reject.

---

## 📋 VIEWS & BLADE FILES

### ANGGOTA Views
| File | Purpose | Key Elements |
|------|---------|----------------|
| `dashboard.blade.php` | Beranda anggota | Stats (total buku, dipinjam, dikembalikan, denda), recent peminjaman |
| `biodata.blade.php` | Edit profil | Form (name, email, kelas, no_telp, password) |
| `cari-buku.blade.php` | Lihat daftar & cari buku | Table buku dengan search, filter kategori |
| `detail-buku.blade.php` | Info detil buku | Detail buku + tombol pinjam (jika tersedia) |
| `peminjaman.blade.php` | Riwayat peminjaman | Table peminjaman dengan status & tanggal |
| `peminjaman-edit.blade.php` | Edit request (bila ada) | - |
| `pengembalian.blade.php` | Status pengembalian | List pengembalian yang sedang diproses |

**Questions**:
- P: "Di halaman dashboard anggota, di mana kode menampilkan total buku?"
- A: dilihat Blade file `page/anggota/dashboard.blade.php` - biasanya di bagian stats, menampilkan variable `$totalBuku` yang dikirim dari controller method `dashboard()`
- P: "Tombol pinjam buku ada di view mana?"
- A: `detail-buku.blade.php` - ada form POST ke `route('buku.pinjam', $buku->id)` dengan tombol submit

### PETUGAS Views
| File | Purpose | Key Elements |
|------|---------|----------------|
| `dashboard.blade.php` | Beranda petugas | Stats, recent peminjaman |
| `biodata.blade.php` | Edit profil | Form yang sama dengan anggota |
| `data-buku.blade.php` | Management buku | Table buku + tombol Add/Edit/Delete + Modal kategori |
| `buku-create.blade.php` | Form tambah buku | Form (judul, pengarang, penerbit, isbn, kategori, status) |
| `buku-edit.blade.php` | Form edit buku | Sama dengan create, tapi pre-filled data lama |
| `data-anggota.blade.php` | List anggota | Table anggota dengan info (name, email, kelas) |
| `data-kategori.blade.php` | Management kategori | Table kategori + Modal add/edit/delete |
| `peminjaman.blade.php` | List peminjaman pending | Table dengan tombol konfirmasi |
| `pengembalian.blade.php` | List pengembalian | Table dengan tombol konfirmasi pengembalian |

**Questions**:
- P: "Gimana caranya hapus buku?"
- A: Button delete di `data-buku.blade.php` → form DELETE ke `route('petugas.buku.destroy', $buku->id)` → method `destroyBuku()` di PetugasController
- P: "Edit kategori di mana?"
- A: Modal di `data-kategori.blade.php` → form ke `route('kategori.update', $kategori->id)` dengan method PUT
- P: "Petugas konfirmasi peminjaman di halaman apa?"
- A: `peminjaman.blade.php` → ada tombol/form ke `route('petugas.peminjaman.konfirmasi', $peminjaman->id)` POST

### KEPALA Views
| File | Purpose | Key Elements |
|------|---------|----------------|
| `dashboard.blade.php` | dashboard kepala | Stats overview |
| `biodata.blade.php` | Edit profil | Form biodata |
| `laporan.blade.php` | Report lengkap | Stats, top book/user, denda, recent transactions |
| `data-buku.blade.php` | Lihat semua buku | Table buku (read-only) |
| `data-anggota.blade.php` | Lihat semua anggota | Table anggota (read-only) |
| `data-petugas.blade.php` | List petugas | Table petugas + tombol edit/delete |
| `petugas-create.blade.php` | Tambah petugas | Form create/edit petugas |

**Questions**:
- P: "Kepala bisa lihat buku paling sering dipinjam di halaman apa?"
- A: `laporan.blade.php` - ada variable `$topBook` yang ditampilkan. Dihitung di KepalaController method `laporan()` dengan `Peminjaman::select('buku_id')->groupBy('buku_id')->orderByDesc('total')->first()`
- P: "Edit petugas di route mana?"
- A: Biasanya form di `petugas-create.blade.php` yang bisa digunakan untuk both create dan edit, atau ada route GET `/kepala/petugas/{id}/edit` (perlu cek di controllers lebih detail)

---

## 💻 KEY CODE IMPLEMENTATIONS

### 1. Peminjaman Buku (Anggota)
```
Location: AnggotaController::pinjam() method
Logic:
  1. Cek status buku (harus 'tersedia')
  2. Cek apakah user sudah punya peminjaman yang sama yang belum dikembalikan
  3. Create Peminjaman record dengan status 'pending'
  4. Set borrowed_at = now, returned_at = null
  5. Update buku status ke 'dipinjam'
  6. Return dengan success message
```

**Questions**:
- P: "Di sana ada pengecekan apa aja sebelum peminjaman diproses?"
- A: Lihat AnggotaController method `pinjam()` → cek `$buku->status !== 'tersedia'` dan cek existing loan `Peminjaman::where('user_id', $user->id)->where('buku_id', $buku->id)->whereIn('status', ['pending', 'dipinjam'])->exists()`

### 2. Konfirmasi Peminjaman (Petugas)
```
Location: PetugasController::konfirmasiPeminjaman() method
Logic:
  1. Ambil record Peminjaman dari ID
  2. Update status dari 'pending' ke 'dipinjam'
  3. Set borrowed_at jika belum
  4. Update buku status ke 'dipinjam'
  5. Return success message
```

**Questions**:
- P: "Petugas konfirmasi peminjaman, apa yang berubah dari database?"
- A: Status peminjaman berubah dari 'pending' ke 'dipinjam', status buku berubah ke 'dipinjam'

### 3. Pengembalian Buku
```
Location: AnggotaController::kembalikan() method (untuk anggota request)
          PetugasController::konfirmasiPengembalian() method (untuk petugas konfirmasi)
Logic:
  1. Update status ke 'request_kembali' (anggota) atau 'dikembalikan' (petugas)
  2. Set returned_at = now
  3. Update buku status ke 'tersedia'
  4. Calculate denda jika ada keterlambatan
  5. Return success message
```

**Questions**:
- P: "Denda dihitung bagaimana?"
- A: Lihat AnggotaController method `kembalikan()` atau fungsi helper yg hitung: `Carbon::now()->diffInDays($peminjaman->borrowed_at) * harga_per_hari` (detail lihat di controller)

### 4. Management Buku (Petugas)
```
CREATE: POST /petugas/buku
  → PetugasController::storeBuku()
  → Validate input
  → Create Buku record & set status='tersedia'
  
READ: GET /petugas/buku
  → PetugasController::buku()
  → Fetch all books with category relation
  
UPDATE: PUT /petugas/buku/{id}
  → PetugasController::updateBuku()
  → Validate & update fields
  
DELETE: DELETE /petugas/buku/{id}
  → PetugasController::destroyBuku()
  → Delete record (soft delete or hard delete)
```

**Questions**:
- P: "Field apa aja yang bisa diisi saat tambah buku?"
- A: judul, pengarang, penerbit, isbn, category_id. Status otomatis di-set 'tersedia' oleh controller.
- P: "Bisa hapus buku?"
- A: Ya, route DELETE `/petugas/buku/{id}` → method `destroyBuku()`. Tapi mungkin ada validasi jika buku sudah pernah dipinjam (soft delete).

### 5. Management Kategori (Petugas)
```
CREATE: POST /petugas/kategori
  → PetugasController::storeKategori()
  
UPDATE: PUT /petugas/kategori/{id}
  → PetugasController::updateKategori()
  
DELETE: DELETE /petugas/kategori/{id}
  → PetugasController::deleteKategori()
```

**Questions**:
- P: "Kategori dikelola di halaman mana?"
- A: `page/petugas/data-kategori.blade.php` - ada view yang menampilkan table kategori dengan modal untuk add/edit/delete
- P: "Bisa hapus kategori yang punya buku?"
- A: Tergantung relasi - biasanya ada validasi di controller, atau kategori di-cascade delete bersama bukunya.

### 6. Laporan (Kepala)
```
Location: KepalaController::laporan() method
Data yang dikumpulkan:
  - Total buku, anggota, petugas, peminjaman
  - Buku paling dipinjam (TOP BOOK):
    SELECT buku_id, COUNT(*) as total FROM peminjamans GROUP BY buku_id ORDER BY total DESC LIMIT 1
  - Anggota paling aktif (TOP USER):
    SELECT user_id, COUNT(*) as total FROM peminjamans GROUP BY user_id ORDER BY total DESC LIMIT 1
  - Total peminjaman belum dikembalikan (WHERE status = 'dipinjam')
  - Total denda (SUM denda)
  - Recent transactions (latest 5 peminjamans)
```

**Questions**:
- P: "Di laporan, bagaimana cara ambil data buku paling dipinjam?"
- A: `Peminjaman::select('buku_id')->with('buku')->selectRaw('count(*) as total')->groupBy('buku_id')->orderByDesc('total')->first()` - lihat di KepalaController method `laporan()`
- P: "Total denda di laporan itu apa?"
- A: Jumlah dari semua denda di table peminjamans: `Peminjaman::sum('denda')`

---

## 🛡️ VALIDASI & ERROR HANDLING

### Form Validations
**Biodata (Anggota & Petugas)**:
- name: required, string, max 255
- email: required, email, unique (except own ID)
- kelas: nullable, string, max 50
- no_telp: nullable, string, max 20  
- password: nullable, min 6, confirmed

**Buku (Petugas)**:
- judul: required, string
- pengarang: required, string
- penerbit: required, string
- isbn: required, unique
- category_id: required, exists in categories
- status: enum('tersedia', 'dipinjam')

**Questions**:
- P: "Validasi email di form biodata, validasi apa?"
- A: `required|email|unique:users,email,{id}` - wajib ada, format email valid, email unik kecuali email punya user sendiri
- P: "ISBN harus unik?"
- A: Ya, `unique` validation di storeBuku/updateBuku di PetugasController

### Error Handling
- Unauthorized akses → middleware role akan reject
- Model not found (404) → `ModelNotFound` exception
- Validation fails → redirect back dengan `errors`
- Business logic fails → `back()->with('error', 'message')`

**Questions**:
- P: "Kalau user anggota coba akses /petugas/buku apa yang terjadi?"
- A: Middleware `role:petugas` akan reject karena user role bukan 'petugas' → likely unauthorized response (403 atau redirect ke login)
- P: "Edit buku yang tidak ada gimana?"
- A: Controller: `Buku::findOrFail($id)` → akan throw ModelNotFoundException, biasanya Laravel handle jadi 404

---

## 🎨 STYLING & LAYOUT

### Layout Structure
**All pages use the same header + sidebar layout**:
- Header (100px height): Logo + Title di left, User info di right
- Sidebar (270px width): Navigation links, logout button at bottom
- Content area: Flex-1, occupied by main content

### CSS Organization
**Each Blade file memiliki `<style>` tag sendiri** yang contains:
- Layout styles (header, sidebar, content)
- Component styles (cards, buttons, tables, forms)
- Responsive utilities jika ada

**Questions**:
- P: "CSS disimpan di mana?"
- A: Setiap file Blade punya `<style>` tag di dalam HTML head - bukan di file eksternal. Misal dashboard anggota CSS ada di `page/anggota/dashboard.blade.php`
- P: "Header styling di mana?"
- A: Setiap Blade file yang punya header memiliki CSS untuk `.header`, `.header-content`, `.left-box`, `.user-box` style di tag `<style>` mereka

### Color Scheme
- Primary: Dark blue-purple (#051031, #170a6b40)
- Accent: Light blue, green, red untuk status/alerts
- Text: White (#f4f4f4, white)

**Questions**:
- P: "Warna background dashboard apa?"
- A: `#051031` (dark blue) - bisa lihat di `.background` class di CSS setiap halaman
- P: "Tombol logout warna apa dan di mana?"
- A: Red (#f87171) - ada di `.logout a` CSS. Positioning di bottom sidebar dengan `position:absolute; bottom:2px`

---

## 📞 RELATIONSHIP QUERY EXAMPLES

```php
// Ambil buku dengan kategorinya
$books = Buku::with('category')->get();

// Ambil peminjaman dengan user dan buku
$peminjamans = Peminjaman::with(['user', 'buku'])->get();

// Ambil user dengan semua peminjamanya
$user = User::with('peminjamans')->find($userId);

// Most borrowed book
$topBook = Peminjaman::select('buku_id')
    ->with('buku')
    ->selectRaw('count(*) as total')
    ->groupBy('buku_id')
    ->orderByDesc('total')
    ->first();

// Count peminjaman per user
$topUser = Peminjaman::select('user_id')
    ->selectRaw('count(*) as total')
    ->groupBy('user_id')
    ->orderByDesc('total')
    ->first();
```

**Questions**:
- P: "Gimana caranya ambil buku beserta kategorinya?"
- A: `Buku::with('category')->get()` - gunakan eager loading dengan `with()` method
- P: "Query untuk hitung berapa kali sebuah buku dipinjam gimana?"
- A: `Peminjaman::where('buku_id', $bukuId)->count()` atau pakai GROUP BY untuk semua buku sekaligus

---

## 🔍 COMMON DEBUGGING

### Sering Ditanya - Jawaban Siap:

**Q: "Form submit ke mana?"**
A: Cek `action` attribute di `<form>` tag - biasanya `route('route-name')` yang resolve ke POST/PUT/DELETE ke controller

**Q: "Data dari form mana disimpan?"**
A: Cek di controller method yang di-route - biasanya ada `$request->validate()` terus `Model::create()` atau `$model->update()`

**Q: "Update data gimana caranya?"**
A: GET form dengan data lama (pre-filled) → User edit → POST/PUT ke controller → Controller validate & update → Redirect back dengan success

**Q: "Buku tidak bisa dipinjam kenapa?"**
A: Cek status buku di database (harus 'tersedia'). Di controller ada `if ($buku->status !== 'tersedia') return error`

**Q: "Petugas lihat apa di dashboard?"**
A: Total buku, total anggota, total peminjaman, total belum kembali, recent peminjaman. Data dari PetugasController dashboard() method.

**Q: "Kategori bisa dihapus?"**
A: Tergantung di controller - cek apakah ada `DB::beginTransaction()` atau validasi jika kategori punya buku. Biasanya ada validasi di method `deleteKategori()`

---

## 📝 TIPS MENJAWAB DI UJIAN

1. **Selalu sebutkan file path & line number**: Biar terlihat tahu kode sendiri
   - "Lihat di `PetugasController` method `storeBuku()` line 150..."
   - "Di view `page/petugas/data-buku.blade.php` ada table..."

2. **Explain the flow**: Jangan hanya sebutkan route, explain step-by-step
   - "User klik tombol → form submit ke route POST /petugas/buku → PetugasController storeBuku() method → validate → create Buku model → redirect dengan success"

3. **Reference actual code**: Kalau bisa, buka file & tunjukkan
   - "Di sini cek `if ($buku->status !== 'tersedia')` - berarti buku harus tersedia baru bisa dipinjam"

4. **Know your database**: Hafal nama table, field, relasi
   - Users table: id, name, email, role, password, kelas, no_telp
   - Peminjamans table: id, user_id, buku_id, borrowed_at, returned_at, status, denda
   - Bukus table: id, judul, pengarang, penerbit, isbn, status, category_id

5. **Middleware & Auth**: Jelaskan bagaimana akses dikontrol
   - "Petugas akses /petugas/* protected sama middleware `role:petugas` - jadi anggota tidak bisa akses"

6. **Be specific about what happens**: Jangan vague
   - ✅ "Status peminjaman berubah dari 'pending' ke 'dipinjam' dan status buku berubah ke 'dipinjam'"
   - ❌ "Peminjaman dikonfirmasi"

---

## 📚 Quick Reference - Routes Summary

```
AUTH:
  GET    /login                               → AuthController@login
  POST   /login                               → AuthController@loginPost
  GET    /logout                              → AuthController@logout
  GET    /register                            → AuthController@register
  POST   /register                            → AuthController@registerPost

ANGGOTA (middleware: auth):
  GET    /anggota                             → AnggotaController@dashboard
  GET    /biodata                             → AnggotaController@biodata
  POST   /biodata                             → AnggotaController@updateBiodata
  GET    /buku                                → BukuController@index
  GET    /buku/{id}                           → BukuController@show
  POST   /buku/{id}/pinjam                    → AnggotaController@pinjam
  GET    /peminjaman                          → AnggotaController@peminjaman
  POST   /peminjaman/{id}/kembali             → AnggotaController@kembalikan
  GET    /pengembalian                        → AnggotaController@pengembalian

PETUGAS (middleware: auth, role:petugas):
  GET    /petugas/dashboard                   → PetugasController@dashboard
  GET    /petugas/biodata                     → PetugasController@biodata
  POST   /petugas/biodata                     → PetugasController@updateBiodata
  GET    /petugas/buku                        → PetugasController@buku
  GET    /petugas/buku/create                 → PetugasController@createBuku
  POST   /petugas/buku                        → PetugasController@storeBuku
  GET    /petugas/buku/{id}/edit              → PetugasController@editBuku
  PUT    /petugas/buku/{id}                   → PetugasController@updateBuku
  DELETE /petugas/buku/{id}                   → PetugasController@destroyBuku
  POST   /petugas/kategori                    → PetugasController@storeKategori
  PUT    /petugas/kategori/{id}               → PetugasController@updateKategori
  DELETE /petugas/kategori/{id}               → PetugasController@deleteKategori
  GET    /petugas/anggota                     → PetugasController@anggota
  GET    /petugas/peminjaman                  → PetugasController@peminjaman
  POST   /petugas/peminjaman/{id}/konfirmasi  → PetugasController@konfirmasiPeminjaman
  GET    /petugas/pengembalian                → PetugasController@pengembalian
  POST   /petugas/pengembalian/{id}/konfirmasi → PetugasController@konfirmasiPengembalian

KEPALA (middleware: auth, role:admin):
  GET    /kepala/dashboard                    → KepalaController@dashboard
  GET    /kepala/biodata                      → KepalaController@biodata
  GET    /kepala/laporan                      → KepalaController@laporan
  GET    /kepala/buku                         → KepalaController@buku
  GET    /kepala/anggota                      → KepalaController@anggotaList
  GET    /kepala/petugas                      → KepalaController@petugasList
```

---

**Last Updated**: April 4, 2026
**Purpose**: Personal Study Guide - Untuk Ujian Kompetensi
