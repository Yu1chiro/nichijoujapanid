<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.$entangle('{{ $getStatePath() }}'),
    
        handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) return;
    
            // Validasi sederhana
            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                alert('Hanya file gambar yang diperbolehkan');
                return;
            }
    
            const reader = new FileReader();
            reader.onload = (e) => {
                // Simpan string Base64 ke state Filament
                this.state = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }">
        <div x-show="state" class="mb-2">
            <a :href="state" target="_blank" rel="noopener noreferrer">
                <img :src="state"
                    class="h-32 w-auto rounded-lg border border-gray-300 object-cover shadow-sm cursor-pointer hover:opacity-80 transition">
            </a>
        </div>


        <input type="file" accept="image/*" @change="handleFileSelect"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">

        <p class="mt-1 text-xs text-gray-500">Upload bukti pembayaran (Langsung ke ImageKit via Server).</p>
    </div>
</x-dynamic-component>
