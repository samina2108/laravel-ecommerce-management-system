<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Order Items -->
                <div class="lg:col-span-2">

                    <div class="bg-white shadow-sm rounded-lg border overflow-hidden">

                        <div class="px-6 py-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Order Items
                            </h3>
                        </div>

                        <div class="divide-y">

                            @foreach($cartItems as $item)

                                <div class="p-6 flex flex-col sm:flex-row gap-5">

                                    <!-- Product Image -->
                                    <div class="w-full sm:w-28 h-28 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">

                                        @if($item->product->image)

                                            <img
                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}"
                                                class="max-h-24 max-w-full object-contain"
                                            >

                                        @else

                                            <span class="text-gray-400 text-sm">
                                                No Image
                                            </span>

                                        @endif

                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">

                                        <h4 class="text-lg font-semibold text-gray-800">
                                            {{ $item->product->name }}
                                        </h4>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $item->product->category->name ?? 'Uncategorized' }}
                                        </p>

                                        <div class="mt-3 text-sm text-gray-600">
                                            Quantity:
                                            <span class="font-medium">
                                                {{ $item->quantity }}
                                            </span>
                                        </div>

                                        <div class="mt-2 text-sm text-gray-600">
                                            Price:
                                            <span class="font-medium">
                                                Rs. {{ number_format($item->product->price, 2) }}
                                            </span>
                                        </div>

                                    </div>

                                    <!-- Item Total -->
                                    <div class="flex items-center sm:justify-end">

                                        <span class="text-lg font-bold text-gray-800">
                                            Rs.
                                            {{ number_format($item->product->price * $item->quantity, 2) }}
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                <!-- Order Summary -->
                <div>

                    <div class="bg-white shadow-sm rounded-lg border p-6 sticky top-6">

                        <h3 class="text-lg font-semibold text-gray-800 mb-6">
                            Order Summary
                        </h3>

                        <div class="space-y-4">

                            <div class="flex justify-between text-gray-600">
                                <span>Total Items</span>

                                <span class="font-medium">
                                    {{ $totalItems }}
                                </span>
                            </div>

                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>

                                <span class="font-medium">
                                    Rs. {{ number_format($subtotal, 2) }}
                                </span>
                            </div>

                            <div class="border-t pt-4">

                                <div class="flex justify-between">

                                    <span class="text-lg font-semibold text-gray-800">
                                        Total
                                    </span>

                                    <span class="text-lg font-bold text-indigo-600">
                                        Rs. {{ number_format($subtotal, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        <!-- Place Order Button -->
                        <div class="mt-6">

                        <form method="POST" action="{{ route('orders.place') }}">
    @csrf

    <button
        type="submit"
        class="w-full px-5 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-200"
    >
        Place Order
    </button>
</form>
                        </div>

                        <!-- Back to Cart -->
                        <div class="mt-4 text-center">

                            <a
                                href="{{ route('cart.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-800"
                            >
                                ← Back to Cart
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>