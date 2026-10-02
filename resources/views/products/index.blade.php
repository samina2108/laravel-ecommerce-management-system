
<x-app-layout>

    <div class="bg-gray-50 min-h-screen">

        {{-- ================= HERO SECTION ================= --}}
        <section class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="py-16 md:py-24 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                    <div>

                        <p class="text-sm font-semibold tracking-[0.25em] text-indigo-400 mb-4">
                            NEW COLLECTION
                        </p>

                        <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                            Discover Your
                            <span class="block text-indigo-400">
                                Perfect Style
                            </span>
                        </h1>

                        <p class="mt-6 text-gray-300 text-lg max-w-xl">
                            Explore our carefully selected collection of quality products,
                            designed to bring style, comfort and value to your everyday life.
                        </p>

                        <a href="#products"
                           class="inline-flex items-center mt-8 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold transition">
                            SHOP COLLECTION
                            <span class="ml-2">→</span>
                        </a>

                    </div>

                    <div class="hidden lg:flex justify-center">

                        <div class="w-80 h-80 rounded-full bg-indigo-600/20 border border-indigo-400/30 flex items-center justify-center">

                            <div class="text-center text-4xl font-bold tracking-widest text-indigo-300">
                                STYLE<br>
                                YOUR<br>
                                WORLD
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>


        {{-- ================= CATEGORIES ================= --}}
        @if($categories->count() > 0)

            <section class="py-14 bg-white">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center mb-10">

                        <p class="text-sm font-semibold tracking-[0.25em] text-indigo-600">
                            EXPLORE
                        </p>

                        <h2 class="text-3xl font-bold text-gray-900 mt-2">
                            Shop By Category
                        </h2>

                        <div class="w-16 h-1 bg-indigo-600 mx-auto mt-4 rounded"></div>

                    </div>


                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

                        @foreach($categories as $category)

                            <a href="{{ route('products.index', ['category' => $category->id]) }}"
                               class="group bg-gray-50 border border-gray-200 rounded-xl p-6 hover:bg-indigo-600 hover:border-indigo-600 transition duration-300">

                                <div class="flex justify-between items-start">

                                    <span class="text-sm font-bold text-gray-400 group-hover:text-indigo-200">
                                        {{ sprintf('%02d', $loop->iteration) }}
                                    </span>

                                    <span class="text-gray-400 group-hover:text-white text-xl">
                                        →
                                    </span>

                                </div>

                                <h3 class="mt-8 text-lg font-bold text-gray-900 group-hover:text-white">
                                    {{ $category->name }}
                                </h3>

                                <p class="mt-2 text-sm text-gray-500 group-hover:text-indigo-100">
                                    Explore Collection
                                </p>

                            </a>

                        @endforeach

                    </div>

                </div>

            </section>

        @endif


        {{-- ================= PRODUCTS ================= --}}
        <section id="products" class="py-14">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Heading --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">

                    <div>

                        <p class="text-sm font-semibold tracking-[0.25em] text-indigo-600">
                            OUR COLLECTION
                        </p>

                        <h2 class="text-3xl font-bold text-gray-900 mt-2">
                            Featured Products
                        </h2>

                        <div class="w-16 h-1 bg-indigo-600 mt-4 rounded"></div>

                    </div>

                    <p class="text-gray-500">
                        {{ $products->total() }} products available
                    </p>

                </div>


                {{-- ================= FILTER ================= --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-8">

                    <form method="GET" action="{{ route('products.index') }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">

                            {{-- Search --}}
                            <div class="lg:col-span-5">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Search
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search products..."
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >

                            </div>


                            {{-- Category --}}
                            <div class="lg:col-span-3">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Category
                                </label>

                                <select
                                    name="category"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                    <option value="">
                                        All Categories
                                    </option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            @selected(request('category') == $category->id)
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- Sort --}}
                            <div class="lg:col-span-3">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Sort By
                                </label>

                                <select
                                    name="sort"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                    <option value="">
                                        Default
                                    </option>

                                    <option
                                        value="name"
                                        @selected(request('sort') == 'name')
                                    >
                                        Name: A-Z
                                    </option>

                                    <option
                                        value="price_low"
                                        @selected(request('sort') == 'price_low')
                                    >
                                        Price: Low to High
                                    </option>

                                    <option
                                        value="price_high"
                                        @selected(request('sort') == 'price_high')
                                    >
                                        Price: High to Low
                                    </option>

                                </select>

                            </div>


                            {{-- Button --}}
                            <div class="lg:col-span-1 flex items-end">

                                <button
                                    type="submit"
                                    class="w-full h-[42px] bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition"
                                >
                                    Filter
                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- ================= PRODUCT GRID ================= --}}
                @if($products->count() > 0)

                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">

                        @foreach($products as $product)

                            {{-- PRODUCT CARD --}}
                            <div class="w-full min-w-0 bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition">

                                {{-- Product Image --}}
                                <div class="relative h-44 bg-white overflow-hidden">

                                    <a href="{{ route('products.show', $product) }}"
                                       class="block w-full h-full">

                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-contain p-3 group-hover:scale-105 transition duration-300"
                                            >

                                        @else

                                            <div class="w-full h-full flex items-center justify-center text-gray-400">

                                                <div class="text-center">

                                                    <div class="text-3xl mb-1">
                                                        📦
                                                    </div>

                                                    <span class="text-xs">
                                                        No Image
                                                    </span>

                                                </div>

                                            </div>

                                        @endif

                                    </a>


                                    {{-- Stock Badge --}}
                                    <div class="absolute top-2 left-2">

                                        @if($product->stock > 0)

                                            <span class="inline-flex px-2 py-1 text-[10px] font-semibold rounded-full bg-green-100 text-green-700">
                                                Available
                                            </span>

                                        @else

                                            <span class="inline-flex px-2 py-1 text-[10px] font-semibold rounded-full bg-red-100 text-red-700">
                                                Sold Out
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- Product Information --}}
                                <div class="p-4">

                                    {{-- Category --}}
                                    @if($product->category)

                                        <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">
                                            {{ $product->category->name }}
                                        </p>

                                    @endif


                                    {{-- Product Name --}}
                                    <h3 class="mt-2 text-lg font-semibold text-gray-900 truncate">

                                        <a href="{{ route('products.show', $product) }}"
                                           class="hover:text-indigo-600 transition">

                                            {{ $product->name }}

                                        </a>

                                    </h3>


                                    {{-- Description --}}
                                    @if($product->description)

                                        <p class="mt-2 text-sm text-gray-500 line-clamp-2">
                                            {{ $product->description }}
                                        </p>

                                    @endif


                                    {{-- Price --}}
                                    <div class="flex items-center justify-between mt-5">

                                        <span class="text-xl font-bold text-gray-900">
                                            Rs. {{ number_format($product->price, 0) }}
                                        </span>

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-900 text-white hover:bg-indigo-600 transition"
                                            title="View Product"
                                        >
                                            →
                                        </a>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    {{-- ================= PAGINATION ================= --}}
                    @if($products->hasPages())

                        <div class="mt-10">
                            {{ $products->links() }}
                        </div>

                    @endif

                @else

                    {{-- ================= EMPTY STATE ================= --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">

                        <div class="text-5xl mb-4">
                            📦
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900">
                            No Products Found
                        </h3>

                        <p class="mt-2 text-gray-500">
                            We couldn't find any products matching your search.
                        </p>

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center mt-6 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold"
                        >
                            VIEW ALL PRODUCTS
                        </a>

                    </div>

                @endif

            </div>

        </section>


        {{-- ================= CTA ================= --}}
        <section class="bg-gray-900 text-white py-14">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col lg:flex-row items-center justify-between gap-6">

                    <div>

                        <p class="text-sm font-semibold tracking-[0.25em] text-indigo-400">
                            SHOP WITH CONFIDENCE
                        </p>

                        <h2 class="text-3xl md:text-4xl font-bold mt-3">
                            Quality products.
                            <span class="text-indigo-400">
                                Simple shopping.
                            </span>
                        </h2>

                    </div>

                    <a
                        href="#products"
                        class="inline-flex items-center px-6 py-3 border border-white/30 hover:bg-white hover:text-gray-900 rounded-lg font-semibold transition"
                    >
                        EXPLORE PRODUCTS
                        <span class="ml-2">→</span>
                    </a>

                </div>

            </div>

        </section>

    </div>

</x-app-layout>

