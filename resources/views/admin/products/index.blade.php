<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>

            <a href="{{ route('admin.products.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + Add Product
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <form method="GET"
                          action="{{ route('admin.products.index') }}"
                          class="flex gap-3">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search product or category..."
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        <button
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Search
                        </button>

                    </form>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        #
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Product
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                          Image
                                        </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Category
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Price
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Stock
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Created
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Actions
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse($products as $product)

                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="font-semibold text-gray-900">
                                                {{ $product->name }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $product->description ? Str::limit($product->description, 40) : 'N/A' }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

    @if($product->image)
    <img
        src="{{ asset('storage/' . $product->image) }}"
        alt="{{ $product->name }}"
        class="w-16 h-16 object-cover rounded-md border"
    >
@else
    <div class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-500 rounded-md text-xs">
        No Image
    </div>
@endif

        

</td>

                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                                        

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if($product->stock > 0)

                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                    {{ $product->stock }}
                                                </span>

                                            @else

                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                                    Out of Stock
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if($product->status === 'active')

                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                    Active
                                                </span>

                                            @else

                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                            {{ $product->created_at->format('d M Y') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right">

                                            <a href="{{ route('admin.products.show', $product) }}"
                                               class="text-blue-600 hover:text-blue-900 mr-3">
                                                View
                                            </a>

                                            <a href="{{ route('admin.products.edit', $product) }}"
                                               class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('admin.products.destroy', $product) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-red-600 hover:text-red-900">
                                                    Delete
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8"
                                            class="px-6 py-8 text-center text-gray-500">

                                            No products found.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    @if($products->hasPages())

                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>

</x-app-layout>