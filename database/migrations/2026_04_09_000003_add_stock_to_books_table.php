<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'stock')) {
                $table->unsignedInteger('stock')->default(1)->after('available');
            }
        });

        DB::statement("UPDATE books SET stock = CASE WHEN available = 1 THEN 1 ELSE 0 END WHERE stock IS NULL OR stock = 0");
        DB::statement("UPDATE books SET status = CASE WHEN stock > 0 THEN 'tersedia' ELSE 'dipinjam' END");
        DB::statement("UPDATE books SET available = CASE WHEN stock > 0 THEN 1 ELSE 0 END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
};
