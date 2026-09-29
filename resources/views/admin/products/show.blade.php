<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product Details
            </h2>

            <a href="{{ route('admin.products.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Product Name --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Product Name
                            </p>

                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                {{ $product->name }}
                            </p>
                        </div>

                        {{-- Category --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Category
                            </p>

                            <p class="mt-1 text-lg text-gray-900">
                                {{ $product->category->name ?? 'N/A' }}
                            </p>
                        </div>

                        {{-- Price --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Price
                            </p>

                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        </div>

                        {{-- Stock --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Stock
                            </p>

                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                {{ $product->stock }}
                            </p>
                        </div>

                        {{-- Status --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Status
                            </p>

                            <div class="mt-1">

                                @if($product->status === 'active')

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">
                                        Inactive
                                    </span>

                                @endif

                            </div>
                        </div>

                        {{-- Created --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Created
                            </p>

                            <p class="mt-1 text-gray-900">
                                {{ $product->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>

                        {{-- Updated --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Last Updated
                            </p>

                            <p class="mt-1 text-gray-900">
                                {{ $product->updated_at->format('d M Y, h:i A') }}
                            </p>
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="mt-8 border-t pt-6">

                        <p class="text-sm font-medium text-gray-500">
                            Description
                        </p>

                        <p class="mt-2 text-gray-700 leading-relaxed">
                            {{ $product->description ?: 'No description available.' }}
                        </p>

                    </div>


                    {{-- Product Image --}}
<div class="mt-8 border-t pt-6">

    <p class="text-sm font-medium text-gray-500 mb-3">
        Product Image
    </p>

    @if($product->image)

    <img
    src="{{ asset('storage/' . $product->image) }}"
    alt="{{ $product->name }}"
    class="w-72 h-72 object-contain rounded-lg border bg-gray-50 p-2 shadow-sm"
>

    @else

        <div class="w-64 h-64 flex items-center justify-center bg-gray-100 text-gray-500 rounded-lg border">
            No Image Available
        </div>

    @endif

</div>

                    {{-- Actions --}}
                    <div class="mt-8 flex items-center gap-3">

                        <a
                            href="{{ route('admin.products.edit', $product) }}"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            Edit Product
                        </a>

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Back
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>