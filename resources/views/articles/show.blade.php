<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - Nichijou Japan ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            /* Mencegah horizontal scroll di mobile */
            overflow-x: hidden;
        }

        /* Medium.com Inspired Typography - RESPONSIVE FIX */
        .medium-format {
            font-family: 'Merriweather', Georgia, serif;
            font-size: 17px;
            /* Font lebih bersahabat di Mobile */
            line-height: 1.7;
            color: #242424;
            -webkit-font-smoothing: antialiased;
            /* Memaksa kata atau link super panjang untuk turun ke bawah (tidak memecah layout) */
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }

        /* Ubah ukuran font ketika di layar Tablet/Desktop */
        @media (min-width: 768px) {
            .medium-format {
                font-size: 20px;
                line-height: 1.68;
            }
        }

        .medium-format p {
            margin-bottom: 1.5em;
        }

        .medium-format h2,
        .medium-format h3,
        .medium-format h4,
        .medium-format h5,
        .medium-format h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: #1a1a1a;
            margin-top: 1.8em;
            margin-bottom: 0.8em;
            line-height: 1.3;
            letter-spacing: -0.02em;
        }

        /* Responsive Headings */
        .medium-format h2 {
            font-size: 24px;
        }

        .medium-format h3 {
            font-size: 20px;
        }

        @media (min-width: 768px) {
            .medium-format h2 {
                font-size: 30px;
            }

            .medium-format h3 {
                font-size: 24px;
            }
        }

        /* ==========================================
           FIX: BULLET LIST & NUMBERED LIST
           ========================================== */
        .medium-format ul {
            list-style-type: disc;
            padding-left: 1.2em;
            /* Sedikit dikecilkan untuk mobile */
            margin-bottom: 1.5em;
        }

        .medium-format ol {
            list-style-type: decimal;
            padding-left: 1.2em;
            margin-bottom: 1.5em;
        }

        @media (min-width: 768px) {

            .medium-format ul,
            .medium-format ol {
                padding-left: 1.5em;
            }
        }

        .medium-format ul ul,
        .medium-format ol ul {
            list-style-type: circle;
            margin-bottom: 0;
            margin-top: 0.5em;
        }

        .medium-format li {
            margin-bottom: 0.5em;
            display: list-item;
        }

        /* ========================================== */

        /* Blockquote / Kutipan - Responsive */
        .medium-format blockquote {
            border-left: 3px solid #1a1a1a;
            padding-left: 16px;
            font-style: italic;
            font-size: 19px;
            color: #1a1a1a;
            margin: 1.5em 0;
        }

        @media (min-width: 768px) {
            .medium-format blockquote {
                padding-left: 20px;
                font-size: 22px;
                margin: 2em 0;
            }
        }

        /* Links */
        .medium-format a {
            color: #1a1a1a;
            text-decoration: underline;
            text-decoration-color: rgba(26, 26, 26, 0.3);
            text-underline-offset: 4px;
            transition: all 0.2s ease;
        }

        .medium-format a:hover {
            color: #4f46e5;
            text-decoration-color: #4f46e5;
        }

        /* Gambar */
        .medium-format img {
            border-radius: 6px;
            margin: 1.5em auto;
            max-width: 100%;
            /* Menjamin gambar tidak melewati layar HP */
            height: auto;
            display: block;
        }

        @media (min-width: 768px) {
            .medium-format img {
                margin: 2em auto;
            }
        }

        .medium-format strong,
        .medium-format b {
            font-weight: 700;
            color: #1a1a1a;
        }

        .medium-format em,
        .medium-format i {
            font-style: italic;
        }

        .medium-format s,
        .medium-format strike {
            text-decoration: line-through;
        }
    </style>
</head>

<body class="antialiased min-h-screen pb-10 md:pb-20">

    {{-- NAVBAR MINIMALIS --}}
    <nav class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40 transition-all duration-300">
        <div class="max-w-5xl mx-auto px-5 md:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 text-slate-800 hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-tight hidden sm:block">Nichijou Japan ID</span>
                <span class="font-bold text-sm tracking-tight sm:hidden">Kembali</span>
            </a>

            <div class="text-sm font-medium text-slate-400">
                Article
            </div>
        </div>
    </nav>

    {{-- ARTICLE CONTAINER --}}
    {{-- w-full memastikan dia tidak overflow, px-5 menjaga jarak aman di sisi kiri kanan layar HP --}}
    <article class="w-full max-w-[680px] mx-auto px-5 py-8 md:py-12">

        {{-- HEADER ARTIKEL --}}
        <header class="mb-8 md:mb-10">
            <div class="flex items-center gap-2 mb-4 md:mb-6">
                <span class="text-indigo-600 font-semibold text-xs md:text-sm uppercase tracking-wide">
                    {{ $article->category }}
                </span>
            </div>

            {{-- text-[28px] untuk mobile agar tidak terlalu raksasa, md:text-[42px] untuk Desktop --}}
            <h1
                class="text-[28px] md:text-[42px] font-extrabold text-slate-900 leading-[1.3] md:leading-[1.2] mb-6 md:mb-8 tracking-tight">
                {{ $article->title }}
            </h1>

            {{-- Author / Meta Info --}}
            <div class="flex items-center gap-3 md:gap-4 text-sm text-slate-500 pb-6 md:pb-8 border-b border-slate-100">
                <div
                    class="w-10 h-10 shrink-0 rounded-full bg-indigo-50 border border-indigo-100 overflow-hidden flex items-center justify-center">
                    <img src="https://ik.imagekit.io/nichijoujapanassets/Assets/5aa7007926b4ec31279b4b710a012db6~tplv-tiktokx-cropcenter_1080_1080.jpeg"
                        alt="Author" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-slate-800">Admin Nichijou</span>
                    <span class="text-[12px] md:text-[13px]">{{ $article->created_at->format('d M Y') }} •
                        {{ ceil(str_word_count(strip_tags($article->description)) / 200) }} min read</span>
                </div>
            </div>
        </header>

        {{-- THUMBNAIL IMAGE --}}
        @if ($article->thumbnail_url)
            <figure class="mb-8 md:mb-12">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                    class="w-full h-auto object-cover rounded-xl shadow-sm">
            </figure>
        @endif

        {{-- CONTENT BODY --}}
        <div class="medium-format selection:bg-indigo-100 selection:text-indigo-900">
            {!! $article->description !!}
        </div>

    </article>

    {{-- RELATED ARTICLES SECTION --}}
    @if ($relatedArticles->count() > 0)
        <section class="bg-slate-50 border-t border-slate-100 mt-10 md:mt-16 py-12 md:py-16">
            <div class="w-full max-w-[680px] mx-auto px-5">
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-6 md:mb-8">Baca juga yang lain</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                    @foreach ($relatedArticles as $related)
                        <a href="{{ route('article.show', $related->slug) }}" class="group block">
                            <div
                                class="aspect-video bg-slate-200 overflow-hidden rounded-xl mb-3 md:mb-4 relative shadow-sm">
                                @if ($related->thumbnail_url)
                                    <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @endif
                            </div>
                            <h4
                                class="font-bold text-slate-900 text-base md:text-lg leading-snug line-clamp-2 group-hover:text-indigo-600 transition">
                                {{ $related->title }}</h4>
                            <p class="text-slate-500 text-xs md:text-sm mt-1.5 md:mt-2">
                                {{ $related->created_at->format('d M Y') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</body>

</html>
