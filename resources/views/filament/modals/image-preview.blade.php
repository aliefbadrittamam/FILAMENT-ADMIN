<div class="p-4">
    <div class="text-center">
        <img 
            src="{{ asset('storage/' . $record->url_gambar) }}" 
            alt="{{ $record->product->product_name }}"
            class="max-w-full h-auto rounded-lg shadow-lg mx-auto"
            style="max-height: 500px;"
        >
        
        <div class="mt-4 space-y-2">
            <h3 class="text-lg font-semibold">{{ $record->product->product_name }}</h3>
            
            <div class="flex justify-center space-x-4 text-sm text-gray-600">
                <span>
                    <strong>Warna:</strong> 
                    @if($record->product->variants->count() > 0)
                        {{ $record->product->variants->pluck('color')->join(', ') }}
                    @else
                        -
                    @endif
                </span>
                <span><strong>Urutan:</strong> {{ $record->sort }}</span>
                <span>
                    <strong>Status:</strong> 
                    @if($record->first_picture)
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Gambar Utama</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">Gambar Biasa</span>
                    @endif
                </span>
            </div>
            
            <div class="text-sm text-gray-500">
                <strong>File:</strong> {{ basename($record->url_gambar) }} <br>
                <strong>Upload:</strong> {{ $record->created_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>
</div>