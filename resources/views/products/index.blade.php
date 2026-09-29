<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shop
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Heading --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Our Products
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Browse our latest products.
                </p>
            </div>
            <select
    name="sort"
    class="w-full sm:w-56 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
>
    <option value="">Sort By</option>

    <option value="price_low"
        {{ request('sort') === 'price_low' ? 'selected' : '' }}>
        Price: Low to High
    </option>

    <option value="price_high"
        {{ request('sort') === 'price_high' ? 'selected' : '' }}>
        Price: High to Low
    </option>

    <option value="name"
        {{ request('sort') === 'name' ? 'selected' : '' }}>
        Name: A to Z
    </option>

    <option value="latest"
        {{ request('sort') === 'latest' ? 'selected' : '' }}>
        Latest
    </option>
</select>
            {{-- Product Search --}}
<form method="GET" action="{{ route('products.index') }}" class="mt-5">

    <div class="flex flex-col sm:flex-row gap-3">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search products..."
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        <button
            type="submit"
            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
        >
            Search
        </button>

        @if(request('search'))
            <a
                href="{{ route('products.index') }}"
                class="px-6 py-2 bg-gray-200 text-gray-700 text-center rounded-md hover:bg-gray-300 transition"
            >
                Clear
            </a>
        @endif

        <select
    name="category"
    class="w-full sm:w-56 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
>
    <option value="">All Categories</option>

    @foreach($categories as $category)
        <option
            value="{{ $category->id }}"
            {{ request('category') == $category->id ? 'selected' : '' }}
        >
            {{ $category->name }}
        </option>
    @endforeach
</select>

    </div>

</form>

{{-- Active Filters Summary --}}
@if(request('search') || request('category') || request('sort'))

    <div class="mt-4 flex flex-wrap items-center gap-2">

        <span class="text-sm font-medium text-gray-600">
            Active Filters:
        </span>

        @if(request('search'))
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm">
                Search: {{ request('search') }}
            </span>
        @endif

        @if(request('category'))
            @php
                $selectedCategory = $categories->firstWhere('id', request('category'));
            @endphp

            @if($selectedCategory)
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                    Category: {{ $selectedCategory->name }}
                </span>
            @endif
        @endif

        @if(request('sort'))
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                Sort:
                {{ request('sort') === 'price_low' ? 'Price: Low to High' :
                   (request('sort') === 'price_high' ? 'Price: High to Low' :
                   (request('sort') === 'name' ? 'Name: A to Z' : 'Latest')) }}
            </span>
        @endif

    </div>

@endif

            {{-- Products Grid --}}
            @if($products->count())

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                    @foreach($products as $product)

                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">

                            {{-- Product Image --}}
                            <div class="h-48 bg-gray-50 flex items-center justify-center border-b">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="max-h-44 max-w-full object-contain p-3"
                                    >

                                @else

                                    <div class="text-sm text-gray-500">
                                        No Image
                                    </div>

                                @endif

                            </div>

                            {{-- Product Information --}}
                            <div class="p-5">

                                {{-- Category --}}
                                <p class="text-xs text-indigo-600 font-medium uppercase mb-1">
                                    {{ $product->category->name }}
                                </p>

                                {{-- Product Name --}}
                                <h3 class="text-lg font-semibold text-gray-800 truncate">
                                    {{ $product->name }}
                                </h3>

                                {{-- Description --}}
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                                </p>

                                {{-- Price --}}
                                <div class="mt-4">

    <span class="text-xl font-bold text-gray-900">
        Rs. {{ number_format($product->price, 2) }}
    </span>

</div>

                                {{-- Stock --}}
                                {{-- Stock Status --}}
<div class="mt-3">

    @if($product->stock == 0)

        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
            Out of Stock
        </span>

    @elseif($product->stock <= 10)

        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
            Low Stock
        </span>

        <span class="ml-2 text-sm text-gray-500">
            {{ $product->stock }} available
        </span>

    @else

        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
            In Stock
        </span>

        <span class="ml-2 text-sm text-gray-500">
            {{ $product->stock }} available
        </span>

    @endif

</div>
                                {{-- View Details --}}
                                <div class="mt-4">

                                <a
    href="{{ route('products.show', $product) }}"
    class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200"
>
    View Details →
</a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $products->links() }}
                </div>

            @else

            <div class="bg-white rounded-lg shadow-sm border p-10 text-center">

@if(request('search') || request('category'))

    <h3 class="text-lg font-semibold text-gray-800">
        No Products Found
    </h3>

    <p class="mt-2 text-sm text-gray-600">
        No products match your current search or category filter.
    </p>

    <div class="mt-5">
        <a
            href="{{ route('products.index') }}"
            class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
        >
            Clear Filters
        </a>
    </div>

@else

    <h3 class="text-lg font-semibold text-gray-800">
        No Products Available
    </h3>

    <p class="mt-2 text-sm text-gray-600">
        There are currently no active products available.
    </p>

@endif

</div>
            @endif

        </div>
    </div>

</x-app-layout>