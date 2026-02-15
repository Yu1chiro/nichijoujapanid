<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PaymentMethod;

class ProductController extends Controller
{
    // Laravel otomatis melakukan 'Implicit Binding' menggunakan Slug
    // karena kita sudah set getRouteKeyName() di Model Product
    public function show(Product $product) 
    {
        $paymentMethods = PaymentMethod::all(); 
        
        // Ambil produk lain di kategori yang sama, kecuali produk ini
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('category', $product->category) 
            ->latest() 
            ->take(4)  
            ->get();

        return view('products.show', compact('product', 'paymentMethods', 'relatedProducts'));
    }
}