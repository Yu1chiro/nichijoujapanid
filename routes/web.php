<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;

// Halaman Utama (Catalog / Bento Grid)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Terms & Conditions
Route::view('/terms', 'terms')->name('terms');

// Detail Produk
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Helper untuk Upload Bukti Bayar ke ImageKit (Via AJAX sebelum submit form)
Route::post('/upload-proof', [CheckoutController::class, 'uploadProof'])->name('upload.proof');

// Proses Checkout (Secure Logic)
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Halaman Sukses
Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');