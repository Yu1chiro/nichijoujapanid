<?php

namespace App\Observers;

use App\Models\Order;
use App\Mail\OrderApprovedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
class OrderObserver
{
    public $afterCommit = true;

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Cek apakah status berubah menjadi 'paid' atau 'confirmed'
        // DAN pastikan status sebelumnya bukan 'paid'/'confirmed' (supaya tidak kirim double)
        if (
            ($order->status === 'paid' || $order->status === 'confirmed') && 
            ($order->getOriginal('status') !== 'paid' && $order->getOriginal('status') !== 'confirmed')
        ) {
            
            // Cek apakah ada email
            if ($order->customer_email) {
                try {
                    Mail::to($order->customer_email)->send(new OrderApprovedMail($order));
                    Log::info("Email produk terkirim ke: " . $order->customer_email);
                } catch (\Exception $e) {
                    Log::error("Gagal mengirim email produk: " . $e->getMessage());
                }
            }
            foreach ($order->items as $item) {
                // Menggunakan increment() adalah cara Atomic & Thread-safe
                // Mencegah race condition jika banyak yang beli bersamaan
                Product::where('id', $item->product_id)->increment('sales_count');
            }
        }
    }
}