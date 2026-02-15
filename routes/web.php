<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/terms', 'terms')->name('terms');

// FIX: Parameter sekarang {product} tapi karena model binding sudah diatur ke slug,
// Laravel otomatis handle: domain.com/product/belajar-kanji
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::post('/upload-proof', [CheckoutController::class, 'uploadProof'])->name('upload.proof');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Security Check sudah ada di dalam controller success
Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');