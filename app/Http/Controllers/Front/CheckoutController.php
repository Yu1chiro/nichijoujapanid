<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\WhatsappNumber;
use App\Services\ImageKitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Menangani upload bukti pembayaran dengan validasi ketat MIME Type.
     */
    public function uploadProof(Request $request)
    {
        // Security: Validasi string dasar
        $request->validate(['image' => 'required|string']);

        $base64Image = $request->image;

        // Security: Validasi Signature File (Magic Bytes)
        // Mencegah user mengupload script PHP/JS yang disamarkan sebagai gambar
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            return response()->json(['error' => 'Format file tidak valid. Hanya gambar yang diperbolehkan.'], 422);
        }

        $extension = strtolower($type[1]); // jpg, png, jpeg
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            return response()->json(['error' => 'Format gambar harus JPG, PNG, atau WEBP.'], 422);
        }

        try {
            // Upload ke ImageKit (3rd Party)
            $url = ImageKitService::upload($base64Image, 'customer_proof');
            
            // Security: Validasi return URL harus valid
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \Exception('Invalid URL returned from Image Service');
            }

            return response()->json(['url' => $url]);
        } catch (\Exception $e) {
            // Security: Jangan mengekspos error asli 3rd party ke client
            Log::error("ImageKit Upload Error: " . $e->getMessage()); 
            return response()->json(['error' => 'Gagal mengupload gambar. Silakan coba lagi.'], 500);
        }
    }

    public function store(Request $request)
    {
        // 1. Validation & Sanitization
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'customer_name' => 'required|string|max:100|regex:/^[a-zA-Z\s\.\']*$/',
            'customer_email' => 'required|email:filter|max:255',
            'customer_phone' => 'required|numeric|digits_between:10,15',
            // FIX: Ubah validasi agar menerima Nama Payment Method (String) bukan cuma qris/mbanking
            'payment_method' => 'required|string|max:100', 
            'payment_proof_url' => 'required|url',
        ]);

        // Security: Sanitasi Input (XSS Prevention)
        $cleanName = strip_tags($validated['customer_name']);
        $cleanPaymentMethod = strip_tags($validated['payment_method']); // Sanitasi payment method

        // 2. Idempotency Key (Rate Limiting Logic)
        $fingerprint = md5($request->ip() . $request->userAgent() . $validated['customer_phone']);
        $idempotencyKey = 'order_lock_' . $fingerprint;

        if (Cache::has($idempotencyKey)) {
            return back()->withErrors(['error' => 'Transaksi sedang diproses. Mohon tunggu sebentar.']);
        }

        // Lock selama 15 detik
        Cache::put($idempotencyKey, true, 15);

        try {
            return DB::transaction(function () use ($validated, $cleanName, $cleanPaymentMethod, $idempotencyKey) {
                // 3. Race Condition Handling (Pessimistic Locking)
                $product = Product::where('id', $validated['product_id'])->lockForUpdate()->firstOrFail();

                // 4. Kalkulasi Server-Side (Trust No Client Input)
                $discountPercentage = $product->discount ?? 0;
                $discountAmount = ($product->price * $discountPercentage) / 100;
                $finalPrice = $product->price - $discountAmount;
                $qty = 1;
                $subtotal = $finalPrice * $qty;

                // 5. Create Order
                $order = Order::create([
                    'customer_name' => $cleanName,
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'],
                    'payment_method' => $cleanPaymentMethod, // Simpan Nama Bank/Method yang dipilih
                    'payment_proof' => $validated['payment_proof_url'], 
                    'total_price' => $subtotal, 
                    'status' => 'pending', 
                ]);

                // Create Item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'product_discount' => $discountAmount,
                    'product_thumbnail' => $product->thumbnail_url,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ]);

                // === LOGIC BARU (SALES COUNTER) ===
                $product->increment('sales_count', $qty);

                return redirect()->route('checkout.success', $order->id);
            });

        } catch (\Exception $e) {
            // Error Handling & Observability
            Log::error("Checkout Failed ID: " . ($validated['product_id'] ?? 'unknown') . " | Error: " . $e->getMessage());
            
            // Release Lock jika gagal
            Cache::forget($idempotencyKey);
            
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem. Transaksi dibatalkan demi keamanan.']);
        }
    }

    public function success(Order $order)
    {
        // Security: Mencegah ID Enumeration Attack sederhana
        $adminWa = Cache::remember('active_admin_wa', 3600, function () {
            return WhatsappNumber::where('status_active', true)->first();
        });

        $adminNumber = $adminWa ? $adminWa->whatsapp_number : ('6281236715460');
        $adminName = $adminWa ? $adminWa->name : 'Admin';
        
        $message = "Halo {$adminName},\nSaya sudah melakukan pembayaran.\n\n";
        $message .= "Order ID: #{$order->id}\n";
        $message .= "Nama: " . e($order->customer_name) . "\n";
        $message .= "Metode: " . e($order->payment_method) . "\n"; // Tampilkan metode bayar
        $message .= "Total: Rp " . number_format($order->total_price, 0, ',', '.') . "\n";
        $message .= "Status: Menunggu Konfirmasi";

        $whatsappUrl = "https://wa.me/{$adminNumber}?text=" . urlencode($message);

        return view('success', compact('order', 'whatsappUrl'));
    }
}