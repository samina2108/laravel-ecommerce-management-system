<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Orders
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Orders --}}
            @if($orders->count())

                <div class="space-y-6">

                    @foreach($orders as $order)

                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">

                            {{-- Order Header --}}
                            <div class="px-6 py-4 bg-gray-50 border-b">

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            Order #{{ $order->id }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Placed on
                                            {{ $order->created_at->format('d M Y, h:i A') }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-3">

                                        @if($order->status === 'pending')

                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>

                                        @elseif($order->status === 'confirmed')

                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Confirmed
                                            </span>

                                        @elseif($order->status === 'completed')

                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Completed
                                            </span>

                                        @elseif($order->status === 'cancelled')

                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Cancelled
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            {{-- Order Body --}}
                            <div class="p-6">

                                <div class="space-y-4">

                                    @foreach($order->items as $item)

                                        <div class="flex items-center justify-between gap-4">

                                            <div class="min-w-0">

                                                <h4 class="font-medium text-gray-800 truncate">
                                                    {{ $item->product_name }}
                                                </h4>

                                                <p class="text-sm text-gray-500">
                                                    {{ $item->quantity }}
                                                    ×
                                                    Rs. {{ number_format($item->price, 2) }}
                                                </p>

                                            </div>

                                            <div class="font-semibold text-gray-800 whitespace-nowrap">
                                                Rs. {{ number_format($item->subtotal, 2) }}
                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                                {{-- Order Total --}}
                                <div class="border-t mt-5 pt-5 flex items-center justify-between">

                                    <span class="text-lg font-semibold text-gray-800">
                                        Total
                                    </span>

                                    <span class="text-lg font-bold text-indigo-600">
                                        Rs. {{ number_format($order->total_amount, 2) }}
                                    </span>

                                </div>

                                {{-- View Details --}}
                                <div class="mt-5">

                                    <a
                                        href="{{ route('orders.show', $order) }}"
                                        class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition"
                                    >
                                        View Order Details
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>

            @else

                {{-- Empty Orders --}}
                <div class="bg-white rounded-lg shadow-sm border p-10 text-center">

                    <div class="text-5xl mb-4">
                        📦
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800">
                        No Orders Yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        You have not placed any orders yet.
                    </p>

                    <a
                        href="{{ route('products.index') }}"
                        class="inline-block mt-6 px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                    >
                        Start Shopping
                    </a>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>