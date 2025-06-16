{{-- resources/views/filament/modals/order-detail.blade.php --}}

<div class="space-y-6">
    {{-- Header Information --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-900">{{ $record->order_number }}</h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                @switch($record->status_order)
                    @case('pending') bg-gray-100 text-gray-800 @break
                    @case('processing') bg-yellow-100 text-yellow-800 @break
                    @case('shipped') bg-blue-100 text-blue-800 @break
                    @case('delivered') bg-green-100 text-green-800 @break
                    @case('cancelled') bg-red-100 text-red-800 @break
                    @default bg-gray-100 text-gray-800
                @endswitch
            ">
                @switch($record->status_order)
                    @case('pending')
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        @break
                    @case('processing')
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        </svg>
                        @break
                    @case('shipped')
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707L16 7.586A1 1 0 0015.414 7H14z"/>
                        </svg>
                        @break
                    @case('delivered')
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        @break
                    @case('cancelled')
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        @break
                @endswitch
                {{ ucfirst($record->status_order) }}
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm font-medium text-gray-500">Order Date</p>
                <p class="text-lg font-semibold text-gray-900">{{ $record->tanggal_order->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Items</p>
                <p class="text-lg font-semibold text-gray-900">{{ $record->orderItems->count() }} items</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Amount</p>
                <p class="text-lg font-bold text-green-600">Rp {{ number_format($record->total_harga, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Customer Information --}}
    <div class="bg-white border rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            Customer Information
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name:</dt>
                        <dd class="text-lg font-semibold text-gray-900">{{ $record->customer->nama_lengkap }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email:</dt>
                        <dd class="text-sm text-blue-600">{{ $record->customer->user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Phone:</dt>
                        <dd class="text-sm text-gray-900">{{ $record->customer->no_telepon }}</dd>
                    </div>
                </dl>
            </div>
            
            <div>
                @if($record->customer->primaryAddress)
                    <dt class="text-sm font-medium text-gray-500 mb-2">Primary Address:</dt>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-sm text-gray-900">{{ $record->customer->primaryAddress->alamat_lengkap }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $record->customer->primaryAddress->kota }}, 
                            {{ $record->customer->primaryAddress->provinsi }} 
                            {{ $record->customer->primaryAddress->kode_pos }}
                        </p>
                        @if($record->customer->primaryAddress->patokan)
                            <p class="text-xs text-gray-500 mt-1">{{ $record->customer->primaryAddress->patokan }}</p>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">No primary address available</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="bg-white border rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
            </svg>
            Order Items ({{ $record->orderItems->count() }})
        </h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($record->orderItems as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($item->product->images->where('first_picture', true)->first())
                                    <img src="{{ asset('storage/' . $item->product->images->where('first_picture', true)->first()->url_gambar) }}" 
                                         alt="{{ $item->product->product_name }}"
                                         class="w-12 h-12 object-cover rounded-lg border mr-4">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg border mr-4 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $item->product->product_name }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit($item->product->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $item->product->category->category_name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $item->total }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm text-gray-900">
                            Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                            Total:
                        </td>
                        <td class="px-6 py-4 text-right text-lg font-bold text-green-600">
                            Rp {{ number_format($record->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Additional Information --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Notes --}}
        <div class="bg-white border rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Order Notes</h3>
            @if($record->catatan)
                <p class="text-sm text-gray-700 bg-gray-50 rounded-lg p-3">{{ $record->catatan }}</p>
            @else
                <p class="text-sm text-gray-500 italic">No notes provided</p>
            @endif
        </div>

        {{-- Timeline --}}
        <div class="bg-white border rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Timeline</h3>
            <div class="space-y-3">
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-900 font-medium">Order Created:</span>
                    <span class="text-gray-600 ml-2">{{ $record->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-900 font-medium">Last Updated:</span>
                    <span class="text-gray-600 ml-2">{{ $record->updated_at->format('d M Y, H:i') }}</span>
                </div>
                @if($record->expired_at)
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 {{ $record->isExpired() ? 'text-red-500' : 'text-yellow-500' }} mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $record->isExpired() ? 'Expired:' : 'Expires:' }}</span>
                    <span class="{{ $record->isExpired() ? 'text-red-600' : 'text-yellow-600' }} ml-2">
                        {{ $record->expired_at->format('d M Y, H:i') }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="flex flex-wrap gap-2 pt-4 border-t">
        <a href="{{ route('filament.admin.resources.orders.edit', $record) }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Order
        </a>
        
        <a href="{{ route('filament.admin.resources.order-items.index', ['tableFilters[id_order][values][0]' => $record->id_order]) }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
            </svg>
            View Items
        </a>
        
        <a href="{{ route('filament.admin.resources.customers.edit', $record->customer) }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            View Customer
        </a>

        @if(in_array($record->status_order, ['pending', '