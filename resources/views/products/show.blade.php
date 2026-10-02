<x-app-layout>

    <div class="bg-gray-50 min-h-screen font-sans">

        {{-- ================= PRODUCT DETAIL ================= --}}
        <section class="py-10 md:py-14">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Breadcrumb --}}
                <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500 mb-8">
                    <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition">Shop</a>
                    <span>/</span>
                    @if($product->category)
                        <a href="{{ route('products.index', ['category' => $product->category->id]) }}"
                           class="hover:text-indigo-600 transition">
                            {{ $product->category->name }}
                        </a>
                        <span>/</span>
                    @endif
                    <span class="text-gray-900 font-medium">{{ $product->name }}</span>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                    {{-- ================= IMAGE ================= --}}
                    {{-- ================= IMAGE ================= --}}
<div class="relative bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

    <div class="flex items-center justify-center bg-gray-50" style="height:480px;">
        @if($product->image)
            <img
                src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-contain p-4"
            >
        @else
            <div class="text-center text-gray-400">
                <div class="text-6xl mb-2">📦</div>
                <span class="text-sm">No Image</span>
            </div>
        @endif
    </div>

    <div class="absolute top-4 left-4">
        @if($product->stock > 0)
            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">IN STOCK</span>
        @else
            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">SOLD OUT</span>
        @endif
    </div>
</div>

                    {{-- ================= INFO ================= --}}
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 md:p-8">

                        @if($product->category)
                            <p class="text-xs font-semibold tracking-[0.2em] text-indigo-600 uppercase">
                                {{ $product->category->name }}
                            </p>
                        @endif

                        <h1 class="mt-2 text-3xl md:text-4xl font-bold text-gray-900 capitalize">
                            {{ $product->name }}
                        </h1>

                        <p class="mt-4 text-3xl font-bold text-indigo-600">
                            Rs. {{ number_format($product->price, 0) }}
                        </p>

                        <div class="w-full h-px bg-gray-200 my-6"></div>

                        {{-- Description --}}
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                Product Description
                            </h4>
                            <p class="mt-2 text-gray-600 leading-relaxed">
                                {{ $product->description ?: 'A quality product carefully selected for our collection. Designed to provide excellent value, style and everyday usability.' }}
                            </p>
                        </div>

                        {{-- Stock --}}
                        <div class="mt-5 flex items-center gap-2 text-sm font-medium
                            {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            <span class="w-2 h-2 rounded-full {{ $product->stock > 0 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            @if($product->stock > 0)
                                {{ $product->stock }} items available
                            @else
                                Currently unavailable
                            @endif
                        </div>

                        {{-- Add To Cart --}}
                        <div class="mt-6">
                            @auth
                                @if($product->stock > 0)
                                    <form method="POST" action="{{ route('cart.add', $product) }}">
                                        @csrf

                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Quantity
                                        </label>

                                        <div class="flex flex-col sm:flex-row gap-4">

                                            <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden w-max">
                                                <button type="button" onclick="decreaseQuantity()"
                                                        class="w-11 h-12 text-xl text-gray-700 hover:bg-gray-100 transition">
                                                    −
                                                </button>

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    id="quantity"
                                                    value="1"
                                                    min="1"
                                                    max="{{ $product->stock }}"
                                                    class="w-16 h-12 text-center border-0 border-x border-gray-300 focus:ring-0 focus:border-gray-300 [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                >

                                                <button type="button" onclick="increaseQuantity()"
                                                        class="w-11 h-12 text-xl text-gray-700 hover:bg-gray-100 transition">
                                                    +
                                                </button>
                                            </div>

                                            <button type="submit"
                                                    class="flex-1 h-12 inline-flex items-center justify-center px-6 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition">
                                                ADD TO CART
                                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <button type="button" disabled
                                            class="w-full h-12 bg-gray-200 text-gray-500 rounded-lg font-semibold cursor-not-allowed">
                                        OUT OF STOCK
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full h-12 inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition">
                                    LOGIN TO PURCHASE
                                    <span class="ml-2">→</span>
                                </a>
                            @endauth
                        </div>

                        {{-- Features --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 grid grid-cols-1 sm:grid-cols-3 gap-4">

                            <div class="flex items-start gap-3">
                                <span class="text-2xl">🚚</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Fast Delivery</p>
                                    <p class="text-xs text-gray-500">Reliable order delivery</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="text-2xl">🛡️</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Quality Products</p>
                                    <p class="text-xs text-gray-500">Carefully selected</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="text-2xl">🎧</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Customer Support</p>
                                    <p class="text-xs text-gray-500">We're here to help</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- ================= PRODUCT INFORMATION ================= --}}
        <section class="py-14 bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                    <div class="lg:col-span-2">
                        <p class="text-sm font-semibold tracking-[0.25em] text-indigo-600">
                            PRODUCT DETAILS
                        </p>
                        <h2 class="text-3xl font-bold text-gray-900 mt-2">
                            Everything You Need To Know
                        </h2>
                        <div class="w-16 h-1 bg-indigo-600 mt-4 rounded"></div>

                        <p class="mt-6 text-gray-600 leading-relaxed">
                            {{ $product->description ?: 'This product is part of our carefully selected collection. We focus on providing products that combine quality, functionality and modern style.' }}
                        </p>
                    </div>

                    <div>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl divide-y divide-gray-200">

                            <div class="flex justify-between items-center px-5 py-4">
                                <span class="text-sm text-gray-500">Category</span>
                                <strong class="text-gray-900">{{ $product->category->name ?? 'General' }}</strong>
                            </div>

                            <div class="flex justify-between items-center px-5 py-4">
                                <span class="text-sm text-gray-500">Availability</span>
                                <strong class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}
                                </strong>
                            </div>

                            <div class="flex justify-between items-center px-5 py-4">
                                <span class="text-sm text-gray-500">Product ID</span>
                                <strong class="text-gray-900">#{{ $product->id }}</strong>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- ================= BACK TO SHOP ================= --}}
        <section class="bg-gray-900 text-white py-14">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <p class="text-sm font-semibold tracking-[0.25em] text-indigo-400">
                    CONTINUE SHOPPING
                </p>

                <h2 class="text-3xl font-bold mt-3">
                    Discover More Products
                </h2>

                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center mt-6 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold transition">
                    BACK TO SHOP
                    <span class="ml-2">→</span>
                </a>

            </div>
        </section>

    </div>


    {{-- ================= QUANTITY SCRIPT ================= --}}
    <script>
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max);
            let value = parseInt(input.value) || 1;
            if (value < max) input.value = value + 1;
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) || 1;
            if (value > 1) input.value = value - 1;
        }
    </script>

</x-app-layout>