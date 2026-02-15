<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Product;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom slug sebagai nullable dulu
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // 2. Generate slug untuk produk yang sudah ada (Data Migration)
        // Agar produk lama tetap bisa dibuka
        $products = Product::all();
        foreach ($products as $product) {
            $slug = Str::slug($product->name);
            
            // Cek duplikat sederhana
            if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug .= '-' . $product->id;
            }

            // Update langsung ke DB tanpa trigger event model
            Product::where('id', $product->id)->update(['slug' => $slug]);
        }

        // 3. Ubah kolom menjadi unique dan tidak boleh null
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};