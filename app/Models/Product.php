<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Security: Gunakan $fillable (Whitelist) daripada $guarded (Blacklist)
    protected $fillable = [
        'name',
        'category',
        'price',
        'discount',
        'description',
        'image_urls',
        'sales_count', // Field baru untuk fitur best seller
        // Tambahkan field lain sesuai migration Anda (misal: 'stock', 'is_active', 'features')
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'float',
        'sales_count' => 'integer',
        'image_urls' => 'array', // Cast JSON ke Array
    ];

    // ACCESSOR
    public function getThumbnailUrlAttribute()
    {
        $images = $this->image_urls; 

        if (!empty($images) && is_array($images)) {
            // Ambil elemen pertama dengan aman
            $firstImage = reset($images); 
            
            // Security: Validasi output URL agar tidak broken/null
            $url = $firstImage['url'] ?? null;
            
            if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                return $url;
            }
        }

        return 'https://via.placeholder.com/400';
    }
}