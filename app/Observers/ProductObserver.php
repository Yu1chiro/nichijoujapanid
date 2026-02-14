<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    /**
     * Handle events after all transactions are committed.
     */
    public $afterCommit = true;

    // Dijalankan saat create atau update
    public function saved(Product $product): void
    {
        $this->clearCache();
    }

    // Dijalankan saat delete
    public function deleted(Product $product): void
    {
        $this->clearCache();
    }

    // Dijalankan saat restore (jika pakai soft deletes)
    public function restored(Product $product): void
    {
        $this->clearCache();
    }

    private function clearCache()
    {
        // Hapus cache lama agar frontend mengambil data baru dari DB
        Cache::forget('home_products');
    }
}