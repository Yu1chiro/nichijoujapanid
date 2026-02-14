<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn('thumbnail_url');
            
            // Tambah kolom baru tipe JSON untuk menampung array URL
            $table->json('image_urls')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_urls');
            $table->text('thumbnail_url')->nullable();
        });
    }
};