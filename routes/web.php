<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ArticleController; // Import Article Controller

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/terms', 'terms')->name('terms');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show'); // Route Article

Route::post('/upload-proof', [CheckoutController::class, 'uploadProof'])->name('upload.proof');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');