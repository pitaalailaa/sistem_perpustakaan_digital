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
        Schema::table('peminjamans', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjamans', 'returned_at')) {
                $table->date('returned_at')->nullable()->after('due_date');
            }
            if (!Schema::hasColumn('peminjamans', 'denda')) {
                $table->unsignedBigInteger('denda')->default(0)->after('returned_at');
            }
            if (!Schema::hasColumn('peminjamans', 'buku_id')) {
                $table->foreignId('buku_id')->constrained('books')->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            if (Schema::hasColumn('peminjamans', 'denda')) {
                $table->dropColumn('denda');
            }
            if (Schema::hasColumn('peminjamans', 'returned_at')) {
                $table->dropColumn('returned_at');
            }
            if (Schema::hasColumn('peminjamans', 'buku_id')) {
                $table->dropForeign(['buku_id']);
                $table->dropColumn('buku_id');
            }
        });
    }
};
