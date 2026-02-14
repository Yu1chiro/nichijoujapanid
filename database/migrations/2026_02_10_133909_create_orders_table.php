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
       Schema::create('orders', function (Blueprint $table) {
    $table->id(); // Order ID
    $table->string('customer_name');
    $table->string('customer_phone')->nullable();
    $table->string('payment_method'); // qris | mbaking
    $table->text('payment_proof')->nullable(); // URL dari ImageKit
    $table->string('status')->default('pending'); // pending | paid | confirmed
    $table->decimal('total_price', 12, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
