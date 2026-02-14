<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Popup;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Caching Strategy: Cache halaman depan selama 10 menit (600 detik)
        // Cache akan otomatis invalid jika waktu habis.
        // Anda juga bisa menambahkan perintah Cache::forget('home_products') di ProductObserver jika ada update produk.
        
        $products = Cache::remember('home_products', 600, function () {
            return Product::latest()->get(); 
        });

        $popup = Cache::remember('home_popup', 600, function () {
            return Popup::latest()->first();
        });
       $testimonials = Testimonial::where('is_active', true)->latest()->get(); 
        return view('welcome', compact('products', 'popup', 'testimonials'));
    }
}