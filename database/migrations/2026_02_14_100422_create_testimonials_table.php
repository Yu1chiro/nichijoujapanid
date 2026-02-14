<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Client
            $table->string('product_purchased'); // Produk yg dibeli
            $table->string('origin')->nullable(); // Asal (Kota/Instansi)
            $table->text('content'); // Isi testimoni (RichEditor)
            $table->boolean('is_active')->default(true); // Untuk show/hide
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};