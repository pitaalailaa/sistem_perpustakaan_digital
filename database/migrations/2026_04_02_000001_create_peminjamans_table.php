<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('peminjamans')) {
            Schema::create('peminjamans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('buku_id')->constrained('books')->cascadeOnDelete();
                $table->date('borrowed_at')->nullable();
                $table->date('due_date')->nullable();
                $table->date('returned_at')->nullable();
                $table->enum('status', ['pending', 'dipinjam', 'kembali', 'request_kembali', 'dikembalikan'])->default('pending');
                $table->unsignedBigInteger('denda')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
