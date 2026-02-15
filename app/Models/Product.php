<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug', // <--- Penting: Slug masuk fillable
        'category',
        'price',
        'discount',
        'description',
        'image_urls',
        'sales_count', 
        'product_link',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'float',
        'sales_count' => 'integer',
        'image_urls' => 'array',
    ];

    /**
     * Boot logic: Otomatis membuat slug saat produk disimpan/diupdate
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($product) {
            // Jika slug kosong, buat dari nama
            if (empty($product->slug)) {
                $slug = Str::slug($product->name);
                
                // Cek jika slug sudah ada di database (selain produk ini sendiri)
                $count = static::where('slug', $slug)
                    ->where('id', '!=', $product->id)
                    ->count();
                
                // Jika duplikat, tambahkan timestamp agar unik
                if ($count > 0) {
                    $slug .= '-' . time();
                }
                
                $product->slug = $slug;
            }
        });
    }

    public function getThumbnailUrlAttribute()
    {
        $images = $this->image_urls; 
        if (!empty($images) && is_array($images)) {
            $firstImage = reset($images);
            return $firstImage['url'] ?? 'https://via.placeholder.com/400';
        }
        return 'https://via.placeholder.com/400';
    }

    /**
     * Mengatur agar Route Model Binding menggunakan kolom 'slug'
     * bukan 'id'. (Contoh: /product/belajar-laravel)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}