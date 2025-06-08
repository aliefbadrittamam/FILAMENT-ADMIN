<div class="p-6 space-y-6">
    <!-- Customer Info -->
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
            </svg>
            Customer Information
        </h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Review Date:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->created_at->format('d M Y H:i') }}</p>
                <p class="text-xs text-gray-500">({{ $record->created_at->diffForHumans() }})</p>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Customer Statistics</h4>
        <div class="grid grid-cols-3 gap-4 text-sm text-center">
            <div>
                <p class="text-2xl font-bold text-blue-600">{{ $record->customer->orders->count() }}</p>
                <p class="text-gray-600 dark:text-gray-400">Total Orders</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-green-600">{{ $record->customer->reviews->count() }}</p>
                <p class="text-gray-600 dark:text-gray-400">Total Reviews</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-purple-600">{{ number_format($record->customer->reviews->avg('rating') ?? 0, 1) }}</p>
                <p class="text-gray-600 dark:text-gray-400">Avg Rating</p>
            </div>
        </div>
    </div>
</div>">Name:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->customer->nama_lengkap }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Email:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->customer->user->email }}</p>
            </div>
            @if($record->customer->no_telepon)
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Phone:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->customer->no_telepon }}</p>
            </div>
            @endif
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Customer Since:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->customer->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Product Info -->
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
            </svg>
            Product Information
        </h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Product:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->product->product_name }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Category:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->product->category->category_name ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Order Info -->
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fillRule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3h4v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm8 2a1 1 0 00-2 0v2a1 1 0 002 0V7zM8 9a1 1 0 000 2h4a1 1 0 100-2H8z" clipRule="evenodd"/>
            </svg>
            Order Information
        </h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Order Number:</span>
                <p class="text-gray-900 dark:text-white font-mono">{{ $record->orderItem->order->order_number }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Order Status:</span>
                <span class="inline-flex px-2 py-1 text-xs rounded-full 
                    @if($record->orderItem->order->status_order === 'delivered') bg-green-100 text-green-800
                    @elseif($record->orderItem->order->status_order === 'shipped') bg-blue-100 text-blue-800
                    @elseif($record->orderItem->order->status_order === 'processing') bg-yellow-100 text-yellow-800
                    @elseif($record->orderItem->order->status_order === 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($record->orderItem->order->status_order) }}
                </span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Order Date:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->orderItem->order->tanggal_order->format('d M Y') }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Unit Price:</span>
                <p class="text-gray-900 dark:text-white">Rp {{ number_format($record->orderItem->unit_price, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Review Info -->
    <div>
        <h3 class="text-lg font-semibold mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Review Details
        </h3>
        <div class="space-y-4">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Rating:</span>
                <div class="flex items-center mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $record->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">({{ $record->rating }}/5)</span>
                </div>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300