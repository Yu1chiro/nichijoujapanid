<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Popup;
use App\Models\Testimonial;
use App\Models\Article; // Tambahkan ini
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $products = Cache::remember('home_products', 600, function () {
            return Product::latest()->get();
        });

        $popup = Cache::remember('home_popup', 600, function () {
            return Popup::latest()->first();
        });

        $testimonials = Testimonial::where('is_active', true)->latest()->get();
        
        // Fetch All Articles, biarkan AlpineJS yang handle default 3 & load more di frontend
        $articles = Article::latest()->get();

        return view('welcome', compact('products', 'popup', 'testimonials', 'articles'));
    }
}