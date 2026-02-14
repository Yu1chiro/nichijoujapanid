<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus+Jakarta+Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center p-6 text-center antialiased">

    {{-- Animasi Sukses Simpel --}}
    <div class="mb-8 relative group">
        <div
            class="absolute inset-0 bg-green-400 blur-2xl opacity-20 rounded-full group-hover:opacity-30 transition duration-500">
        </div>
        <div
            class="relative bg-white text-green-500 rounded-full p-6 shadow-xl border border-green-50 flex items-center justify-center w-24 h-24 mx-auto">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>

    <h1 class="text-3xl font-bold text-slate-900 mb-2">Arigatou Gozaimasu!</h1>
    <p class="text-slate-500 mb-10 max-w-md mx-auto leading-relaxed">
        Pesanan kamu sedang kami proses. Silahkan konfirmasi ke admin melalui WhatsApp agar pesanan
        kamu cepat di proses!

    </p>

    {{-- Receipt Card --}}
    <div
        class="bg-white border border-slate-200 rounded-2xl p-0 w-full max-w-sm mx-auto mb-10 shadow-sm overflow-hidden relative">
        {{-- Hiasan Gerigi di atas --}}
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>

        <div class="p-6 space-y-4">
            <div class="flex justify-between items-center pb-4 border-b border-slate-100 border-dashed">
                <span class="text-slate-500 text-sm">Order ID</span>
                <span class="font-mono font-bold text-slate-800">#{{ $order->id }}</span>
            </div>

            <div class="flex justify-between items-center pb-4 border-b border-slate-100 border-dashed">
                <span class="text-slate-500 text-sm">Pembeli</span>
                <span
                    class="font-medium text-slate-800 text-right truncate max-w-[150px]">{{ $order->customer_name }}</span>
            </div>

            <div class="flex justify-between items-center pt-2">
                <span class="text-slate-500 font-medium">Total Bayar</span>
                <span class="text-xl font-bold text-blue-600">Rp
                    {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 flex justify-between items-center">
            <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Status</span>
            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">
                {{ strtoupper($order->status) }}
            </span>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex flex-col gap-4 w-full max-w-xs">
        <a href="{{ $whatsappUrl }}" target="_blank"
            class="bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold py-3.5 px-6 rounded-xl shadow-lg shadow-green-500/20 transition-all transform hover:-translate-y-1 hover:shadow-green-500/30 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
            </svg>
            Konfirmasi WhatsApp
        </a>

        <a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-slate-600 font-medium transition py-2">
            Kembali ke Beranda
        </a>
    </div>

</body>

</html>
