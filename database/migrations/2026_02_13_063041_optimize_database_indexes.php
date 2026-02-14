<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mempercepat pencarian berdasarkan status (untuk admin dashboard)
            $table->index('status');
            // Mempercepat pencarian no hp (saat checkout / tracking)
            $table->index('customer_phone');
            // Mempercepat filter tanggal / reporting
            $table->index('created_at');
        });

        Schema::table('products', function (Blueprint $table) {
            // Mempercepat filter kategori di Homepage
            $table->index('category');
            // Mempercepat sorting harga
            $table->index('price');
        });
        
        // Optimasi Foreign Key (biasanya Laravel sudah otomatis, tapi untuk memastikan)
        Schema::table('order_items', function (Blueprint $table) {
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status', 'customer_phone', 'created_at']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category', 'price']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id', 'product_id']);
        });
    }
};