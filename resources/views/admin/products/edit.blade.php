<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                <form method="POST"
      action="{{ route('admin.products.update', $product) }}"
      enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Category --}}
                        <div class="mb-5">

                            <label for="category_id"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Category
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="">Select Category</option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Product Name --}}
                        <div class="mb-5">

                            <label for="name"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Product Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                required
                                autofocus
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Description --}}
                        <div class="mb-5">

                            <label for="description"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Change Product Image --}}
<div class="mb-5">

    <label for="image"
           class="block font-medium text-sm text-gray-700 mb-2">
        Change Product Image
    </label>

    <input
        id="image"
        type="file"
        name="image"
        accept="image/jpeg,image/png,image/jpg,image/webp"
        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    >

    <p class="mt-1 text-sm text-gray-500">
        JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
    </p>

    @error('image')
        <p class="mt-2 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror

</div>
                        {{-- Price --}}
                        <div class="mb-5">

                            <label for="price"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Price
                            </label>

                            <input
                                id="price"
                                type="number"
                                name="price"
                                value="{{ old('price', $product->price) }}"
                                step="0.01"
                                min="0"
                                required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('price')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Stock --}}
                        <div class="mb-5">

                            <label for="stock"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Stock Quantity
                            </label>

                            <input
                                id="stock"
                                type="number"
                                name="stock"
                                value="{{ old('stock', $product->stock) }}"
                                min="0"
                                required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('stock')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Status --}}
                        <div class="mb-6">

                            <label for="status"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="active"
                                    {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive"
                                    {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center gap-3">

                            <button
                                type="submit"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                Update Product
                            </button>

                            <a
                                href="{{ route('admin.products.index') }}"
                                class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                            >
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>