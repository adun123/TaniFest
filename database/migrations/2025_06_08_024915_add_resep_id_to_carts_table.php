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
        if (! Schema::hasColumn('carts', 'resep_id')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->foreignId('resep_id')->nullable()->constrained()->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('carts', 'resep_id')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropConstrainedForeignId('resep_id');
            });
        }
    }
};
