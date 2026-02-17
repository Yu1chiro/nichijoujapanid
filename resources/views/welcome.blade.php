<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nichijou Japan ID</title>
    <meta name="google-site-verification" content="XeqGJsLEnMLpTVRMtBZlqs9Hqs836rtlkQXHm5FRnKA" />
    <meta name="description"
        content="Toko digital modul belajar bahasa Jepang dari nol. Download PDF Bank Soal JLPT N3/N4/N5, Paket Bundle Hiragana, Cheat Sheet JFT Basic, dan latihan Kanji praktis siap cetak. Harga terjangkau mulai Rp10.000.">
    <meta name="keywords"
        content="ebook bahasa jepang, download pdf jlpt, bank soal jlpt n3 n4 n5, latihan menulis hiragana, cheat sheet jft basic, modul bahasa jepang pemula, kanji drill pdf, beli materi bahasa jepang">
    <meta name="author" content="Nichijou Japan ID">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.nichijoujapanid.my.id/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.nichijoujapanid.my.id/">
    <meta property="og:title" content="Jual Bundle Materi & Latihan Soal Bahasa Jepang (PDF)">
    <meta property="og:description"
        content="Siap lulus ujian? Dapatkan Bank Soal JLPT, Drill Kanji, dan Lembar Latihan Hiragana. Format PDF siap pakai untuk belajar mandiri.">
    <meta property="og:image"
        content="https://ik.imagekit.io/nichijoujapanassets/Assets/5aa7007926b4ec31279b4b710a012db6~tplv-tiktokx-cropcenter_1080_1080.jpeg?updatedAt=1770901523076">
    <meta property="og:image:width" content="1080">
    <meta property="og:image:height" content="1080">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://www.nichijoujapanid.my.id/">
    <meta name="twitter:title" content="Nichijou.ID - Pusat Modul Bahasa Jepang Hemat">
    <meta name="twitter:description" content="Download cheat sheet, bank soal JLPT, dan latihan dasar bahasa Jepang.">
    <meta name="twitter:image"
        content="https://ik.imagekit.io/nichijoujapanassets/Assets/5aa7007926b4ec31279b4b710a012db6~tplv-tiktokx-cropcenter_1080_1080.jpeg?updatedAt=1770901523076">

    <link rel="shortcut icon"
        href="https://ik.imagekit.io/nichijoujapanassets/Assets/5aa7007926b4ec31279b4b710a012db6~tplv-tiktokx-cropcenter_1080_1080.jpeg"
        type="image/x-icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus+Jakarta+Sans', sans-serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .marquee-track {
            display: flex;
            animation: marquee 9s linear infinite;
        }

        .hover\:pause-animation:hover {
            animation-play-state: paused;
        }

        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-700 antialiased min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <nav x-data="{ open: false }"
        class="sticky top-0 z-40 w-full bg-white/90 backdrop-blur-md border-b border-indigo-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-9 h-9 flex items-center justify-center text-white font-serif ">

                        <img class="rounded-full"
                            src="https://ik.imagekit.io/nichijoujapanassets/Assets/5aa7007926b4ec31279b4b710a012db6~tplv-tiktokx-cropcenter_1080_1080.jpeg"
                            alt="">
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="font-serif text-lg font-bold text-indigo-950 tracking-tight leading-none group-hover:text-indigo-600 transition">
                            Nichijou<span class="text-sky-400">.</span>ID
                        </span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('terms') }}"
                        class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition">Terms &
                        Conditions</a>
                </div>

                {{-- Hamburger Button --}}
                <button @click="open = !open"
                    class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-cloak x-transition.origin.top
            class="md:hidden absolute top-full left-0 w-full bg-white border-b border-indigo-50 shadow-lg py-4 px-4 flex flex-col gap-2">
            <a href="{{ route('terms') }}"
                class="block px-4 py-2 rounded-lg hover:bg-sky-50 text-slate-600 font-medium">Terms & Conditions</a>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div x-data="productCatalog({{ Js::from($products) }})" class="flex-grow pb-12">

        {{-- POPUP MODAL --}}
        @if ($popup)
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)" x-show="show" x-cloak class="relative z-[60]"
                aria-labelledby="modal-title" role="dialog" aria-modal="true">

                <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-indigo-900/20 backdrop-blur-sm transition-opacity"></div>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4">
                        <div x-show="show" @click.away="show = false" x-transition:enter="ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="ease-in duration-300"
                            class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl shadow-indigo-200 overflow-hidden border border-white/60">

                            <button @click="show = false"
                                class="absolute top-3 right-3 z-20 bg-white/80 hover:bg-white text-slate-600 rounded-full p-1.5 transition shadow backdrop-blur">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="relative group">
                                <div class="aspect-video w-full overflow-hidden bg-slate-100">
                                    <img src="{{ $popup->thumbnail_url }}" alt="{{ $popup->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-6 text-center">
                                    <span
                                        class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold tracking-widest uppercase bg-sky-100 text-sky-600 rounded-full">
                                        Featured
                                    </span>
                                    <h3 class="font-serif text-xl font-semibold text-indigo-950 mb-2">
                                        {{ $popup->name }}</h3>
                                    <button @click="show = false"
                                        class="mt-2 text-sm font-medium text-indigo-600 hover:text-indigo-800 underline underline-offset-4 transition">
                                        Lihat Penawaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- NEW PROFILE HEADER SECTION --}}
        <header class="relative mb-16 bg-cover bg-center bg-no-repeat flex items-center justify-center"
            style="background-image: url('https://ik.imagekit.io/nichijoujapanassets/Assets/dreamina-2026-02-12-2329-Reference%20Image%201,%20create%20a%20banner%20with%20....jpeg'); 
           min-height: 420px;">

            {{-- Dark Overlay --}}
            <div class="absolute inset-0 bg-black/55"></div>

            {{-- Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

            {{-- Content --}}
            <div class="relative z-10 text-center px-4 max-w-2xl">

                {{-- Logo --}}
                <div class="mx-auto mb-5">
                    <div
                        class="w-28 h-28 md:w-32 md:h-32  
                        flex items-center justify-center mx-auto">
                        <img class="rounded-full"
                            src="https://ik.imagekit.io/nichijoujapanassets/Assets/5aa7007926b4ec31279b4b710a012db6~tplv-tiktokx-cropcenter_1080_1080.jpeg"
                            alt="">
                    </div>
                </div>

                {{-- H1 --}}
                <h1 class="font-serif text-2xl md:text-4xl font-bold text-white mb-4">
                    Nichijou Japan ID
                </h1>

                {{-- Description --}}
                <p class="text-white/90 text-sm md:text-base leading-relaxed mb-6">
                    お知らせ!
                    <br class="hidden md:block">
                    Selamat datang di Nichijou Japan ID Kamu lagi belajar bahasa jepang otodidak? Tenang, kamu sudah
                    berada di tempat yang tepat! Temukan modul belajar, bank soal JLPT, dan latihan praktis untuk semua
                    level. Yuk, mulai petualangan belajarmu sekarang!
                </p>

                {{-- Social Icons --}}
                <div class="flex items-center justify-center gap-4">
                    {{-- Instagram --}}
                    <a href="https://instagram.com/nichijoujapan_id" target="_blank"
                        class="w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-pink-600 hover:border-pink-200 hover:bg-pink-50 flex items-center justify-center transition-all shadow-sm hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>

                    {{-- TikTok --}}
                    <a href="https://tiktok.com/@nichijou_japanid" target="_blank"
                        class="w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-black hover:border-slate-400 hover:bg-slate-50 flex items-center justify-center transition-all shadow-sm hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/people/Nichijou-Japan-ID/61588133996412/" target="_blank"
                        class="w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 flex items-center justify-center transition-all shadow-sm hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                </div>

            </div>
        </header>



        {{-- CATALOG SECTION --}}
        <main id="catalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

            {{-- Filter Pills --}}
            <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
                <button @click="setCategory('All')"
                    :class="activeCategory === 'All' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' :
                        'bg-white text-slate-500 hover:bg-sky-50 border-slate-100'"
                    class="px-4 py-2 rounded-full text-xs font-medium transition-all duration-300 border">
                    All
                </button>
                <template x-for="cat in categories" :key="cat">
                    <button @click="setCategory(cat)"
                        :class="activeCategory === cat ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' :
                            'bg-white text-slate-500 hover:bg-sky-50 border-slate-100'"
                        class="px-4 py-2 rounded-full text-xs font-medium transition-all duration-300 border">
                        <span x-text="cat"></span>
                    </button>
                </template>
            </div>

            {{-- PRODUCT GRID --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
                <template x-for="product in displayedProducts" :key="product.id">
                    {{-- FIX: Menggunakan product.slug (sebelumnya product.id) --}}
                    <a :href="'/product/' + product.slug" class="group block h-full">
                        <div
                            class="bg-white rounded-2xl p-3 border border-indigo-50 shadow-sm hover:shadow-lg hover:shadow-indigo-100 hover:-translate-y-1 transition-all duration-300 h-full flex flex-col">

                            {{-- Image Container --}}
                            <div class="aspect-[4/5] w-full overflow-hidden rounded-xl bg-slate-100 relative mb-3">
                                <img :src="getProductImage(product)" :alt="product.name"
                                    class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-105">

                                {{-- Sale Badge (%) --}}
                                <template x-if="product.discount > 0">
                                    <div
                                        class="absolute top-2 left-2 bg-rose-500/90 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase tracking-wider">
                                        <span x-text="parseInt(product.discount) + '% OFF'"></span>
                                    </div>
                                </template>
                            </div>

                            {{-- Content --}}
                            <div class="flex-grow flex flex-col px-1">
                                <p class="text-[10px] font-bold text-sky-500 uppercase tracking-widest mb-1"
                                    x-text="product.category"></p>

                                <h3 class="text-base font-semibold text-slate-800 mb-1 leading-snug group-hover:text-indigo-600 transition-colors line-clamp-2"
                                    x-text="product.name"></h3>

                                {{-- === FITUR BARU: SALES COUNT === --}}
                                <template x-if="product.sales_count > 0">
                                    <div class="flex items-center gap-1 mt-1 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-amber-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-[10px] font-medium text-slate-500"
                                            x-text="product.sales_count + ' Terjual'"></span>
                                    </div>
                                </template>
                                {{-- ============================== --}}

                                <div class="mt-auto pt-2 flex items-center justify-between">
                                    <div class="flex flex-col">
                                        {{-- Harga Coret --}}
                                        <template x-if="product.discount > 0">
                                            <span class="text-[10px] text-slate-400 line-through"
                                                x-text="formatRupiah(product.price)"></span>
                                        </template>
                                        {{-- Harga Akhir --}}
                                        <span class="text-base font-bold text-indigo-900"
                                            x-text="formatRupiah(calculateFinalPrice(product.price, product.discount))">
                                        </span>
                                    </div>

                                    <div class="text-indigo-300 group-hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>

            {{-- EMPTY STATE --}}
            <div x-show="displayedProducts.length === 0" class="text-center py-12" x-cloak>
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-100 mb-3">
                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                </div>
                <p class="text-slate-500 text-sm">Produk belum tersedia di kategori ini.</p>
            </div>

            {{-- LOAD MORE --}}
            <div x-show="hasMore" class="mt-12 text-center" x-cloak>
                <button @click="loadMore()"
                    class="inline-flex items-center justify-center px-6 py-3 text-xs font-bold text-indigo-600 transition-all duration-200 bg-indigo-50 rounded-full hover:bg-indigo-100 hover:text-indigo-800">
                    Show More Products
                </button>
            </div>

        </main>

    </div>
    @if ($testimonials->count() > 0)
        <section class="py-16 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 mb-10 text-center">
                <h2 class="text-3xl font-bold text-slate-900">Testimonials</h2>
                <p class="text-slate-500 mt-2">Apa kata mereka?</p>
            </div>

            <div class="relative w-full">
                <div class="absolute top-0 left-0 w-24 h-full  z-10">
                </div>
                <div class="absolute top-0 right-0 w-24 h-full  z-10">
                </div>

                <div class="marquee-track flex gap-6 w-max hover:pause-animation">
                    @foreach (range(1, 2) as $i)
                        @foreach ($testimonials as $testi)
                            <div
                                class="w-[350px] bg-slate-50 border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex-shrink-0">
                                <div class="flex items-center gap-4 mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                                        {{ substr($testi->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $testi->name }}</h4>
                                        <p class="text-xs text-slate-500">{{ $testi->origin }}</p>
                                    </div>
                                </div>

                                <div class="text-slate-600 text-sm leading-relaxed line-clamp-4 prose prose-indigo">
                                    {!! $testi->content !!}
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-200">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                        Produk : {{ $testi->product_purchased }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>


    @endif
    {{-- FOOTER --}}
    <footer class="bg-white border-t border-indigo-50 py-8 mt-auto">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div>
                <p class="font-serif text-base font-bold text-indigo-950">Nichijou.ID</p>
                <p class="text-xs text-slate-400 mt-1">Japanese aesthetic daily goods.</p>
            </div>
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Nichijou Japan ID.</p>
        </div>
    </footer>

    <script>
        function productCatalog(allProducts) {
            // --- LOGIC BEST SELLER SORTING (Permintaan User) ---
            // Kita urutkan produk di sini sebelum ditampilkan
            const sortedProducts = allProducts.sort((a, b) => {
                // Konversi ke integer untuk safety (antisipasi jika data string)
                const salesA = parseInt(a.sales_count || 0);
                const salesB = parseInt(b.sales_count || 0);

                // 1. Prioritas: Sales terbanyak di atas
                if (salesB !== salesA) {
                    return salesB - salesA;
                }

                // 2. Fallback: Jika sales sama, produk terbaru (ID terbesar) di atas
                return b.id - a.id;
            });

            return {
                products: sortedProducts,
                limit: 8,
                activeCategory: 'All',

                get categories() {
                    const cats = this.products.map(p => p.category);
                    return [...new Set(cats)];
                },

                get displayedProducts() {
                    let filtered = this.products;
                    if (this.activeCategory !== 'All') {
                        filtered = this.products.filter(p => p.category === this.activeCategory);
                    }
                    return filtered.slice(0, this.limit);
                },

                get hasMore() {
                    let totalFiltered = this.activeCategory === 'All' ?
                        this.products.length :
                        this.products.filter(p => p.category === this.activeCategory).length;
                    return this.limit < totalFiltered;
                },

                getProductImage(product) {
                    if (product.image_urls && Array.isArray(product.image_urls) && product.image_urls.length > 0) {
                        return product.image_urls[0].url;
                    }
                    return 'https://via.placeholder.com/400x500?text=No+Image';
                },

                calculateFinalPrice(price, discountPercent) {
                    if (!discountPercent || discountPercent <= 0) return price;
                    return price - (price * discountPercent / 100);
                },

                setCategory(cat) {
                    this.activeCategory = cat;
                    this.limit = 8;
                },

                loadMore() {
                    this.limit += 8;
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
</body>

</html>
