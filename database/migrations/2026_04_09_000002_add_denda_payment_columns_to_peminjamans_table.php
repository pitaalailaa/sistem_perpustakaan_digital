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
            if (!Schema::hasColumn('peminjamans', 'is_denda_paid')) {
                $table->boolean('is_denda_paid')->default(false)->after('denda');
            }

            if (!Schema::hasColumn('peminjamans', 'denda_paid_at')) {
                $table->timestamp('denda_paid_at')->nullable()->after('is_denda_paid');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            if (Schema::hasColumn('peminjamans', 'denda_paid_at')) {
                $table->dropColumn('denda_paid_at');
            }

            if (Schema::hasColumn('peminjamans', 'is_denda_paid')) {
                $table->dropColumn('is_denda_paid');
            }
        });
    }
};
