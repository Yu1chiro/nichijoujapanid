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

class CheckoutController extends Controller
{
    public function uploadProof(Request $request)
    {
        $request->validate(['image' => 'required|string']);

        $base64Image = $request->image;
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            return response()->json(['error' => 'Format file tidak valid.'], 422);
        }

        try {
            $url = ImageKitService::upload($base64Image, 'customer_proof');
            return response()->json(['url' => $url]);
        } catch (\Exception $e) {
            Log::error("ImageKit Error: " . $e->getMessage()); 
            return response()->json(['error' => 'Gagal upload.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'customer_name' => 'required|string|max:100|regex:/^[a-zA-Z\s\.\']*$/',
            'customer_email' => 'required|email:filter|max:255',
            'customer_phone' => 'required|numeric|digits_between:10,15',
            'payment_method' => 'required|string|max:100', 
            'payment_proof_url' => 'required|url',
        ]);

        $cleanName = strip_tags($validated['customer_name']);
        $cleanPaymentMethod = strip_tags($validated['payment_method']);

        // Rate Limiting / Idempotency
        $fingerprint = md5($request->ip() . $request->userAgent() . $validated['customer_phone']);
        $idempotencyKey = 'order_lock_' . $fingerprint;

        if (Cache::has($idempotencyKey)) {
            return back()->withErrors(['error' => 'Transaksi sedang diproses.']);
        }
        Cache::put($idempotencyKey, true, 15);

        try {
            return DB::transaction(function () use ($validated, $cleanName, $cleanPaymentMethod, $idempotencyKey) {
                $product = Product::where('id', $validated['product_id'])->lockForUpdate()->firstOrFail();

                $discountAmount = ($product->price * ($product->discount ?? 0)) / 100;
                $finalPrice = $product->price - $discountAmount;
                $subtotal = $finalPrice * 1;

                $order = Order::create([
                    'customer_name' => $cleanName,
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'],
                    'payment_method' => $cleanPaymentMethod,
                    'payment_proof' => $validated['payment_proof_url'], 
                    'total_price' => $subtotal, 
                    'status' => 'pending', 
                ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'product_discount' => $discountAmount,
                    'product_thumbnail' => $product->thumbnail_url,
                    'qty' => 1,
                    'subtotal' => $subtotal,
                ]);

                $product->increment('sales_count', 1);

                // === SECURITY FIX: SESSION TOKEN ===
                // Simpan ID order yang "sah" di session browser user
                // Hanya user yang punya session ini yang bisa melihat halaman success
                session(['verified_order_id' => $order->id]);

                return redirect()->route('checkout.success', $order->id);
            });

        } catch (\Exception $e) {
            Log::error("Checkout Error: " . $e->getMessage());
            Cache::forget($idempotencyKey);
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem.']);
        }
    }

    public function success(Order $order)
    {
        // === SECURITY CHECK ===
        // Cek apakah session browser memiliki akses ke Order ID ini
        if (session('verified_order_id') !== $order->id) {
            // Jika tidak cocok (misal user ganti angka URL jadi 2), tampilkan 404
            abort(404); 
        }

        $adminWa = Cache::remember('active_admin_wa', 3600, fn() => WhatsappNumber::where('status_active', true)->first());
        $adminNumber = $adminWa ? $adminWa->whatsapp_number : '6281236715460';
        $adminName = $adminWa ? $adminWa->name : 'Admin';
        
        $message = "Halo {$adminName},\nSaya sudah melakukan pembayaran.\n\n" .
                   "Order ID: #{$order->id}\n" .
                   "Nama: " . e($order->customer_name) . "\n" .
                   "Metode: " . e($order->payment_method) . "\n" .
                   "Total: Rp " . number_format($order->total_price, 0, ',', '.') . "\n" .
                   "Status: Menunggu Konfirmasi";

        $whatsappUrl = "https://wa.me/{$adminNumber}?text=" . urlencode($message);

        return view('success', compact('order', 'whatsappUrl'));
    }
}