<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form method="POST"
                          action="{{ route('admin.categories.update', $category) }}">

                        @csrf
                        @method('PUT')

                        {{-- Category Name --}}
                        <div class="mb-5">

                            <label for="name"
                                   class="block font-medium text-sm text-gray-700 mb-2">
                                Category Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $category->name) }}"
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
                            >{{ old('description', $category->description) }}</textarea>

                            @error('description')
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
                                    {{ old('status', $category->status) === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive"
                                    {{ old('status', $category->status) === 'inactive' ? 'selected' : '' }}>
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
                                Update Category
                            </button>

                            <a
                                href="{{ route('admin.categories.index') }}"
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