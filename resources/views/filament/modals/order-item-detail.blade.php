{{-- resources/views/filament/modals/order-item-detail.blade.php --}}

<div class="space-y-6">
    {{-- Header Information --}}
    <div class="bg-gray-50 rounded-lg p-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Order Information</h3>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Order Number:</dt>
                        <dd class="text-sm font-semibold text-gray-900">{{ $record->order->order_number }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Customer:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->order->customer->nama_lengkap }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Email:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->order->customer->user->email }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Phone:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->order->customer->no_telepon }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Order Date:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->order->tanggal_order->format('d M Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Status:</dt>
                        <dd>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @switch($record->order->status_order)
                                    @case('pending') bg-gray-100 text-gray-800 @break
                                    @case('processing') bg-yellow-100 text-yellow-800 @break
                                    @case('shipped') bg-blue-100 text-blue-800 @break
                                    @case('delivered') bg-green-100 text-green-800 @break
                                    @case('cancelled') bg-red-100 text-red-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch
                            ">
                                {{ ucfirst($record->order->status_order) }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Order Total</h3>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Total Items:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->order->orderItems->count() }} items</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Total Quantity:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->order->orderItems->sum('total') }} units</dd>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <dt class="text-lg font-medium text-gray-900">Grand Total:</dt>
                        <dd class="text-lg font-bold text-green-600">
                            Rp {{ number_format($record->order->total_harga, 0, ',', '.') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- Product Information --}}
    <div class="bg-white border rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Details</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Product Image --}}
            <div>
                @if($record->product->images->where('first_picture', true)->first())
                    <img src="{{ asset('storage/' . $record->product->images->where('first_picture', true)->first()->url_gambar) }}" 
                         alt="{{ $record->product->product_name }}"
                         class="w-full h-48 object-cover rounded-lg border">
                @else
                    <div class="w-full h-48 bg-gray-100 rounded-lg border flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Product Name:</dt>
                        <dd class="text-lg font-semibold text-gray-900">{{ $record->product->product_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Category:</dt>
                        <dd class="text-sm text-gray-900">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $record->product->category->category_name }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Description:</dt>
                        <dd class="text-sm text-gray-900">
                            {{ $record->product->description ?: 'No description available' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Current Stock:</dt>
                        <dd class="text-sm text-gray-900">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $record->product->stok > 10 ? 'bg-green-100 text-green-800' : ($record->product->stok > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $record->product->stok }} units
                            </span>
                        </dd>
                    </div>
                    @if($record->product->size)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Size:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->product->size }} cm</dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>

    {{-- Item Details --}}
    <div class="bg-white border rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Item Details</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <dt class="text-sm font-medium text-gray-500 mb-1">Quantity</dt>
                <dd class="text-2xl font-bold text-gray-900">{{ $record->total }}</dd>
                <p class="text-xs text-gray-500">units ordered</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4">
                <dt class="text-sm font-medium text-gray-500 mb-1">Unit Price</dt>
                <dd class="text-2xl font-bold text-blue-600">
                    Rp {{ number_format($record->unit_price, 0, ',', '.') }}
                </dd>
                <p class="text-xs text-gray-500">per unit</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4">
                <dt class="text-sm font-medium text-gray-500 mb-1">Subtotal</dt>
                <dd class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($record->subtotal, 0, ',', '.') }}
                </dd>
                <p class="text-xs text-gray-500">total for this item</p>
            </div>
        </div>
    </div>

    {{-- Review Information (if exists) --}}
    @if($record->review)
    <div class="bg-white border rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Review</h3>
        
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $record->review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                    <span class="ml-2 text-sm font-medium text-gray-900">{{ $record->review->rating }}/5</span>
                </div>
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600">
                    Review given on {{ $record->review->created_at->format('d M Y') }}
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Timestamps --}}
    <div class="bg-gray-50 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Timeline</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Item Added:</dt>
                <dd class="text-sm text-gray-900">{{ $record->created_at->format('d M Y, H:i') }}</dd>
                <dd class="text-xs text-gray-500">{{ $record->created_at->diffForHumans() }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Last Updated:</dt>
                <dd class="text-sm text-gray-900">{{ $record->updated_at->format('d M Y, H:i') }}</dd>
                <dd class="text-xs text-gray-500">{{ $record->updated_at->diffForHumans() }}</dd>
            </div>
        </dl>
    </div>

    {{-- Quick Actions --}}
    <div class="flex flex-wrap gap-2 pt-4 border-t">
        <a href="{{ route('filament.admin.resources.orders.edit', $record->order) }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Order
        </a>
        
        <a href="{{ route('filament.admin.resources.products.edit', $record->product) }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Edit Product
        </a>
        
        <a href="{{ route('filament.admin.resources.customers.edit', $record->order->customer) }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            View Customer
        </a>
    </div>
</div>