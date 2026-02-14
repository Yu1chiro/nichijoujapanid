<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PaymentMethod;

class ProductController extends Controller
{
    public function show($id)
    {
        // Security: Gunakan findOrFail untuk handling 404 otomatis yang aman
        // Jika menggunakan Route Model Binding (Product $product), ini sudah otomatis, 
        // tapi manual query memberikan kontrol lebih jika ingin cek 'is_active'.
        $product = Product::findOrFail($id);

        // Ambil metode pembayaran aktif saja (Best Practice)
        // Asumsi ada kolom is_active di PaymentMethod, jika tidak ada, ambil semua.
        $paymentMethods = PaymentMethod::all(); 
        
        // LOGIKA: Ambil 4 produk terbaru selain produk ini
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->latest() 
            ->take(4)  
            ->get();

        return view('products.show', compact('product', 'paymentMethods', 'relatedProducts'));
    }
}