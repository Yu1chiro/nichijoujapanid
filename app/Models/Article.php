<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $guarded = [];

    // Boot logic: Otomatis membuat slug saat article disimpan
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($article) {
            if (empty($article->slug)) {
                $slug = Str::slug($article->title);
                
                $count = static::where('slug', $slug)
                    ->where('id', '!=', $article->id)
                    ->count();
                
                if ($count > 0) {
                    $slug .= '-' . time();
                }
                
                $article->slug = $slug;
            }
        });
    }

    // Mengatur agar Route Binding menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}