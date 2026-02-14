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
        Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete(); // Keep history if product deleted
    $table->string('product_name'); // Snapshot data
    $table->decimal('product_price', 12, 2);
    $table->decimal('product_discount', 12, 2)->default(0);
    $table->text('product_thumbnail')->nullable();
    $table->integer('qty')->default(1);
    $table->decimal('subtotal', 12, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
