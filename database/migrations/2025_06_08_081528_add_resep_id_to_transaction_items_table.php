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
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('resep_id')->nullable()->constrained('reseps');
        });

       
    }

    public function down(): void
    {
      

        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['resep_id']);
            $table->dropColumn(['product_id', 'resep_id']);
        });
    }
};
