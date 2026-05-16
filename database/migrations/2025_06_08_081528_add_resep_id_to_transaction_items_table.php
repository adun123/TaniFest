<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 👇 yang benar:
    // Tambahkan ini di dalam method (bukan pakai trait), seperti biasa:
    public function up(): void
    {
        if (! Schema::hasColumn('transaction_items', 'resep_id')) {
            Schema::table('transaction_items', function (Blueprint $table) {
                $table->foreignId('resep_id')->nullable()->constrained('reseps')->onDelete('cascade');
            });
        }

    }

    public function down(): void
    {

        if (Schema::hasColumn('transaction_items', 'resep_id')) {
            Schema::table('transaction_items', function (Blueprint $table) {
                $table->dropConstrainedForeignId('resep_id');
            });
        }
    }
};
