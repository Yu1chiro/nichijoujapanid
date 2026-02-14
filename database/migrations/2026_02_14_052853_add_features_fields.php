<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_email')->after('customer_name')->nullable(); // Wajib di form, tapi nullable di DB jaga2 data lama
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('product_link')->after('price')->nullable(); // Link Google Drive / File
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_email');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('product_link');
        });
    }
};