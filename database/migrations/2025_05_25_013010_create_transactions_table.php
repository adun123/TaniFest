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
        Schema::create('transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('address_id')->constrained()->onDelete('cascade');
    $table->string('delivery_day'); // "Hari ini", "Besok", dll
    $table->string('delivery_time'); // jam kirim
    $table->string('shipping_method'); // Reguler / Fast / Normal
    $table->string('payment_method'); // eWallet / Bank
    $table->integer('shipping_cost');
    $table->integer('total_price');
    $table->string('virtual_account')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
