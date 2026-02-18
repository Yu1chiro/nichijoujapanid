<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }

        .prose p {
            margin-bottom: 1.5em;
            line-height: 1.75;
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.5em;
            margin-bottom: 1.5em;
        }

        .prose ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 1.5em;
        }

        .prose h1,
        .prose h2,
        .prose h3 {
            color: #1e293b;
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 0.5em;
            line-height: 1.3;
        }

        .prose h2 {
            font-size: 1.5em;
        }

        .prose h3 {
            font-size: 1.25em;
        }

        .prose blockquote {
            border-left: 4px solid #e2e8f0;
            padding-left: 1em;
            font-style: italic;
            color: #64748b;
        }

        .prose a {
            color: #4f46e5;
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen pb-32 sm:pb-16">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-40">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}"
                class="flex items-center gap-2 text-slate-500 hover:text-indigo-600 transition group">
                <div class="p-2 rounded-full bg-slate-50 group-hover:bg-indigo-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span class="font-semibold text-sm hidden sm:block">Kembali ke Katalog</span>
            </a>
            <div class="w-10"></div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-8">

                {{-- LEFT: IMAGE SLIDER --}}
                <div class="bg-slate-50 relative group" x-data="{ active: 0, images: {{ Js::from($product->image_urls ?? []) }} }">
                    <div class="aspect-square md:aspect-[4/5] w-full relative overflow-hidden bg-slate-200">
                        <template x-if="images.length > 0">
                            <img :src="images[active].url"
                                class="w-full h-full object-cover transition-all duration-500" alt="Product">
                        </template>
                        <template x-if="images.length === 0">
                            <div class="flex items-center justify-center h-full text-slate-400">No Image</div>
                        </template>
                    </div>

                    {{-- Slider Controls --}}
                    <div x-show="images.length > 1"
                        class="absolute inset-0 flex items-center justify-between px-4 pointer-events-none">
                        <button @click="active = active === 0 ? images.length - 1 : active - 1"
                            class="pointer-events-auto bg-white/80 p-3 rounded-full shadow-lg hover:scale-110 transition"><svg
                                class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg></button>
                        <button @click="active = active === images.length - 1 ? 0 : active + 1"
                            class="pointer-events-auto bg-white/80 p-3 rounded-full shadow-lg hover:scale-110 transition"><svg
                                class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg></button>
                    </div>

                    @if ($product->discount > 0)
                        <span
                            class="absolute top-4 left-4 bg-rose-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md uppercase">Hemat
                            {{ 0 + $product->discount }}%</span>
                    @endif
                </div>

                {{-- RIGHT: DETAILS --}}
                <div class="p-6 md:p-10 flex flex-col justify-center">

                    <div class="mb-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-700 uppercase">
                            {{ $product->category }}
                        </span>
                    </div>

                    <h1 class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-2">{{ $product->name }}</h1>

                    @if ($product->sales_count > 0)
                        <div class="flex items-center gap-2 mb-6">
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-100 text-amber-700 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span>{{ $product->sales_count }} Terjual</span>
                            </div>
                        </div>
                    @else
                        <div class="mb-4"></div>
                    @endif

                    <div class="flex items-end gap-3 mb-8 border-b border-slate-100 pb-8">
                        <div class="flex flex-col">
                            @if ($product->discount > 0)
                                <span class="text-slate-400 text-sm md:text-base line-through font-medium mb-1">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                            <span class="text-3xl md:text-4xl font-bold text-indigo-600">
                                Rp
                                {{ number_format($product->price - ($product->price * ($product->discount ?? 0)) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="prose prose-slate prose-sm md:prose-base max-w-none text-slate-600 mb-8">
                        {!! $product->description !!}
                    </div>

                    <div x-data @click="$dispatch('open-checkout')" class="hidden md:block w-full">
                        <button
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-4 rounded-xl shadow-lg transition flex justify-center items-center gap-3 transform hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span>Beli Sekarang</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- RELATED PRODUCTS --}}
        @if ($relatedProducts->count() > 0)
            <div class="mt-16">
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-6">Produk Lainnya</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach ($relatedProducts as $related)
                        <a href="{{ route('product.show', $related->id) }}"
                            class="group block bg-white rounded-2xl border border-slate-100 overflow-hidden hover:shadow-xl transition">
                            <div class="aspect-square bg-slate-100 overflow-hidden relative">
                                <img src="{{ !empty($related->image_urls) ? $related->image_urls[0]['url'] : '' }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            </div>
                            <div class="p-4">
                                <h4
                                    class="font-bold text-slate-800 text-sm line-clamp-2 mb-2 group-hover:text-indigo-600">
                                    {{ $related->name }}</h4>
                                <span class="font-bold text-indigo-600 text-sm">Rp
                                    {{ number_format($related->price - ($related->price * $related->discount) / 100, 0, ',', '.') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    {{-- MOBILE STICKY BUTTON --}}
    <div class="fixed bottom-0 inset-x-0 z-30 bg-white border-t border-slate-100 p-4 md:hidden shadow-lg">
        <div class="flex items-center gap-4">
            <div class="flex flex-col">
                <span class="text-xs text-slate-500 font-medium">Total Harga</span>
                <span class="text-lg font-bold text-indigo-600">Rp
                    {{ number_format($product->price - ($product->price * ($product->discount ?? 0)) / 100, 0, ',', '.') }}</span>
            </div>
            <button x-data @click="$dispatch('open-checkout')"
                class="flex-1 bg-indigo-600 text-white font-bold py-3 rounded-xl shadow-lg flex items-center justify-center">Beli
                Sekarang</button>
        </div>
    </div>

    {{-- MODAL CHECKOUT --}}
    <div x-data="checkoutApp({{ Js::from($paymentMethods) }})" @open-checkout.window="openModal = true" class="relative z-50">
        <div x-show="openModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50">
        </div>

        <div x-show="openModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            class="fixed inset-x-0 bottom-0 z-50 md:inset-0 md:flex md:items-center md:justify-center p-0 md:p-4">

            <div @click.away="openModal = false"
                class="bg-white w-full md:w-[500px] md:rounded-2xl rounded-t-[2rem] shadow-2xl flex flex-col max-h-[90vh]">

                <div
                    class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10 rounded-t-[2rem]">
                    <h3 class="text-lg font-bold text-slate-800">Form Pemesanan</h3>

                    <button @click="openModal = false"
                        class="p-2 bg-slate-50 hover:bg-slate-100 rounded-full text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto custom-scrollbar">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="payment_proof_url" x-model="proofUrl">

                        <div class="flex items-center gap-4 p-3 bg-slate-50 rounded-xl border border-slate-100 mb-6">

                            <img src="{{ !empty($product->image_urls) ? $product->image_urls[0]['url'] : '' }}"
                                class="w-16 h-16 rounded-lg object-cover">
                            <div>
                                <p class="text-xs text-slate-500">Produk</p>
                                <p class="font-bold text-slate-800 text-sm line-clamp-1">{{ $product->name }}</p>
                                <p class="font-bold text-indigo-600 text-sm">Rp
                                    {{ number_format($product->price - ($product->price * ($product->discount ?? 0)) / 100, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <input type="text" name="customer_name" required placeholder="Nama Lengkap"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-100 outline-none">
                            <input type="email" name="customer_email" required
                                placeholder="Pastikan email aktif untuk menerima link product"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-100 outline-none">
                            <input type="tel" name="customer_phone" required
                                placeholder="Nomor WhatsApp (0812...)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-100 outline-none">

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Metode
                                    Pembayaran</label>
                                <p class="text-amber-700 text-xs mb-5">
                                    *Sebelum <strong>Checkout</strong> silahkan gunakan browser chrome/safari
                                    untuk upload foto bukti
                                    transfer untuk mempermudah transaksi kamu!

                                </p>
                                <div class="grid grid-cols-1 gap-2">
                                    <template x-for="(pm, index) in paymentMethods" :key="index">
                                        <div @click="selectedPaymentIndex = index"
                                            class="cursor-pointer border rounded-xl p-3 flex items-center justify-between transition-all"
                                            :class="selectedPaymentIndex === index ?
                                                'border-indigo-500 bg-indigo-50/50 ring-1 ring-indigo-500' :
                                                'border-slate-200 hover:border-slate-300'">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-white rounded-lg p-1 border border-slate-100 flex items-center justify-center">
                                                    <template x-if="pm.category === 'qris'">
                                                        <img :src="pm.thumbnail_url"
                                                            class="w-full h-full object-contain">
                                                    </template>
                                                    <template x-if="pm.category === 'mbanking'">
                                                        <svg class="w-6 h-6 text-indigo-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z">
                                                            </path>
                                                        </svg>
                                                    </template>
                                                </div>
                                                <span class="font-bold text-sm text-slate-700"
                                                    x-text="pm.name"></span>
                                            </div>
                                            <div class="w-5 h-5 rounded-full border border-slate-300 flex items-center justify-center"
                                                :class="selectedPaymentIndex === index ? 'border-indigo-600 bg-indigo-600' : ''">
                                                <div x-show="selectedPaymentIndex === index"
                                                    class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <input type="hidden" name="payment_method" :value="paymentValue">
                            </div>

                            <div x-show="selectedMethod" x-collapse
                                class="mt-4 p-4 bg-sky-50 rounded-xl border border-sky-100">
                                <p class="text-xs text-sky-600 font-bold uppercase mb-2">Silakan Transfer Ke:</p>

                                <template x-if="selectedMethod?.category === 'qris' && selectedMethod?.thumbnail_url">
                                    <div class="mb-4 flex flex-col items-center">
                                        <a :href="selectedMethod.thumbnail_url" target="_blank"
                                            class="relative group block bg-white p-2 rounded-xl border border-sky-100 shadow-sm hover:shadow-md transition cursor-zoom-in">
                                            <img :src="selectedMethod.thumbnail_url"
                                                class="h-48 w-auto object-contain rounded-lg" alt="QR Code">
                                            <div
                                                class="absolute inset-0 flex items-end justify-center pb-2 opacity-0 group-hover:opacity-100 transition">
                                                <span
                                                    class="bg-black/70 text-white text-[10px] px-2 py-1 rounded backdrop-blur-sm">Klik
                                                    untuk memperbesar</span>
                                            </div>
                                        </a>
                                    </div>
                                </template>

                                <div
                                    class="flex items-center justify-between bg-white p-3 rounded-lg border border-sky-100 shadow-sm">
                                    <span class="font-mono font-bold text-lg text-slate-800 break-all"
                                        x-text="selectedMethod?.account_number || selectedMethod?.name"></span>

                                    <button type="button"
                                        @click="navigator.clipboard.writeText(selectedMethod?.account_number || selectedMethod?.name); $el.innerText = 'COPIED!'; setTimeout(() => $el.innerText = 'COPY', 2000)"
                                        class="text-xs text-sky-600 font-bold hover:underline ml-2 shrink-0">
                                        COPY
                                    </button>
                                </div>
                                <p class="text-[10px] text-amber-600 mt-2">*Pastikan nominal transfer sesuai total
                                    harga segala bentuk pemalsuan dapat kami proses sesuai dengan prosedur</p>

                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Bukti
                                    Transfer</label>

                                <div class="relative">
                                    <input type="file" accept="image/*" @change="uploadImage"
                                        :disabled="isUploading"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="w-full border-2 border-dashed rounded-xl p-6 text-center transition-colors"
                                        :class="proofUrl ? 'border-green-400 bg-green-50' :
                                            'border-slate-300 hover:border-indigo-400'">
                                        <div x-show="isUploading"
                                            class="text-indigo-600 font-bold text-sm animate-pulse">Mengupload...</div>
                                        <div x-show="!isUploading && !proofUrl" class="text-sm text-slate-500">
                                            Upload bukti transfer</div>

                                        <div x-show="proofUrl"><img :src="proofUrl"
                                                class="h-24 mx-auto rounded-lg shadow-sm object-cover">
                                            <p class="text-xs text-green-600 font-bold mt-2">Berhasil Diupload!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start gap-2 mt-4 mb-2">
                            <input type="checkbox" x-model="agreed" id="terms"
                                class="mt-0.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600 cursor-pointer">
                            <label for="terms"
                                class="text-xs text-slate-500 cursor-pointer select-none leading-tight">
                                Saya telah membaca dan menyetujui
                                <a href="{{ route('terms') }}" target="_blank"
                                    class="text-indigo-600 font-bold hover:underline">Syarat & Ketentuan</a>
                                pembelian.
                            </label>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100">
                            <button type="submit" :disabled="!isFormValid"
                                class="w-full py-4 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center gap-2"
                                :class="isFormValid ? 'bg-indigo-600 text-white hover:bg-indigo-700' :
                                    'bg-slate-200 text-slate-400 cursor-not-allowed'">
                                <span>Checkout</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkoutApp', (paymentMethods) => ({
                openModal: false,
                paymentMethods: paymentMethods,
                selectedPaymentIndex: null,
                proofUrl: '',
                isUploading: false,
                agreed: false,

                get selectedMethod() {
                    return this.selectedPaymentIndex !== null ? this.paymentMethods[this
                        .selectedPaymentIndex] : null;
                },
                get paymentValue() {
                    // FIX: Mengembalikan NAMA (misal: "BCA") bukan Kategori (misal: "mbanking")
                    // Agar di database tersimpan nama bank yang spesifik
                    return this.selectedMethod ? this.selectedMethod.name : '';
                },
                get isFormValid() {
                    return this.proofUrl && this.selectedPaymentIndex !== null && !this
                        .isUploading && this.agreed;
                },
                uploadImage(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    this.isUploading = true;
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        fetch('{{ route('upload.proof') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                image: reader.result
                            })
                        }).then(r => r.json()).then(d => {
                            if (d.url) this.proofUrl = d.url;
                            else alert('Gagal Upload');
                        }).catch(() => alert('Error')).finally(() => this.isUploading = false);
                    }
                }
            }));
        });
    </script>
</body>

</html>
