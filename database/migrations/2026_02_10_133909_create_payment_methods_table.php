<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: BCA, Mandiri, QRIS Nichijou
            $table->string('category'); // 'qris' atau 'mbanking'
            $table->string('account_number')->nullable(); // Wajib jika mbanking
            $table->text('thumbnail_url')->nullable(); // Wajib jika qris (URL Gambar QR)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};