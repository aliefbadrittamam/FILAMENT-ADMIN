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
                <span class="font-medium text-gray-700 dark:text-gray-300">Name:</span>
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
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Product Views:</span>
                <p class="text-gray-900 dark:text-white">{{ number_format($record->product->view) }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Total Reviews:</span>
                <p class="text-gray-900 dark:text-white">{{ $record->product->reviews->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Comment Content -->
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fillRule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clipRule="evenodd"/>
            </svg>
            Comment Details
        </h3>
        <div class="space-y-4">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Comment:</span>
                <div class="mt-2 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <p class="text-gray-900 dark:text-white leading-relaxed">{{ $record->comment }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="font-medium text-gray-700 dark:text-gray-300">Comment Date:</span>
                    <p class="text-gray-900 dark:text-white">{{ $record->created_at->format('d M Y H:i') }}</p>
                    <p class="text-xs text-gray-500">({{ $record->created_at->diffForHumans() }})</p>
                </div>
                <div>
                    <span class="font-medium text-gray-700 dark:text-gray-300">Comment Length:</span>
                    <p class="text-gray-900 dark:text-white">{{ strlen($record->comment) }} characters</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Customer Activity</h4>
        <div class="grid grid-cols-3 gap-4 text-sm text-center">
            <div>
                <p class="text-2xl font-bold text-blue-600">{{ $record->customer->orders->count() }}</p>
                <p class="text-gray-600 dark:text-gray-400">Total Orders</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-green-600">{{ $record->customer->comments->count() }}</p>
                <p class="text-gray-600 dark:text-gray-400">Total Comments</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-purple-600">{{ $record->customer->reviews->count() }}</p>
                <p class="text-gray-600 dark:text-gray-400">Total Reviews</p>
            </div>
        </div>
    </div>
</div>