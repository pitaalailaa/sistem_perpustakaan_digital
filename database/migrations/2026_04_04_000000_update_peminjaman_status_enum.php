<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah ENUM status untuk menambah value baru
        DB::statement("ALTER TABLE peminjamans MODIFY status ENUM('pending', 'dipinjam', 'kembali', 'request_kembali', 'dikembalikan') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE peminjamans MODIFY status ENUM('pending', 'dipinjam', 'kembali') DEFAULT 'pending'");
    }
};
