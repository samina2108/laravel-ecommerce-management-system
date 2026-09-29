<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- Product Image --}}
                        <div class="bg-gray-50 rounded-lg border flex items-center justify-center min-h-[400px]">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="max-w-full max-h-[400px] object-contain p-6"
                                >

                            @else

                                <div class="text-gray-500">
                                    No Image Available
                                </div>

                            @endif

                        </div>

                        {{-- Product Information --}}
                        <div>

                            {{-- Category --}}
                            <p class="text-sm font-medium text-indigo-600 mb-2">
                                {{ $product->category->name }}
                            </p>

                            {{-- Product Name --}}
                            <h1 class="text-3xl font-bold text-gray-800">
                                {{ $product->name }}
                            </h1>

                            {{-- Price --}}
                            <div class="mt-5">
                                <span class="text-2xl font-bold text-gray-900">
                                    Rs. {{ number_format($product->price, 2) }}
                                </span>
                            </div>

                            {{-- Stock --}}
                            <div class="mt-4">

                                @if($product->stock > 0)

                                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                        In Stock
                                    </span>

                                    <span class="ml-2 text-sm text-gray-600">
                                        {{ $product->stock }} available
                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">
                                        Out of Stock
                                    </span>

                                @endif

                            </div>

                            {{-- Description --}}
                            <div class="mt-6 border-t pt-6">

                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    Description
                                </h3>

                                <p class="text-gray-600 leading-relaxed">
                                    {{ $product->description ?: 'No description available.' }}
                                </p>

                            </div>

                            {{-- Product Action --}}
<div class="mt-8">

    @if($product->stock > 0)

    <form method="POST" action="{{ route('cart.add', $product) }}">
    @csrf

    <div class="flex flex-col sm:flex-row gap-3">

        {{-- Quantity --}}
        <div>
            <label
                for="quantity"
                class="block text-sm font-medium text-gray-700 mb-1"
            >
                Quantity
            </label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                value="1"
                min="1"
                max="{{ $product->stock }}"
                class="w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        {{-- Add to Cart --}}
        <div class="flex items-end">

            <button
                type="submit"
                class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition duration-200"
            >
                Add to Cart
            </button>

        </div>

    </div>

</form>

    @else

        <button
            type="button"
            disabled
            class="w-full md:w-auto px-6 py-3 bg-gray-300 text-gray-500 font-medium rounded-md cursor-not-allowed"
        >
            Out of Stock
        </button>

    @endif

</div>

                            {{-- Back to Shop --}}
                            <div class="mt-8">

                                <a
                                    href="{{ route('products.index') }}"
                                    class="inline-block px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                                >
                                    ← Back to Shop
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>