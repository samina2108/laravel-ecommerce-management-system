<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Category Details
            </h2>

            <a href="{{ route('admin.categories.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    {{-- Category Name --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500">
                            Category Name
                        </h3>

                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ $category->name }}
                        </p>
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500">
                            Description
                        </h3>

                        <p class="mt-1 text-gray-700">
                            {{ $category->description ?: 'No description available.' }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500">
                            Status
                        </h3>

                        <div class="mt-2">

                            @if($category->status === 'active')

                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
                                    Active
                                </span>

                            @else

                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-700">
                                    Inactive
                                </span>

                            @endif

                        </div>
                    </div>

                    {{-- Created Date --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500">
                            Created At
                        </h3>

                        <p class="mt-1 text-gray-700">
                            {{ $category->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>

                    {{-- Updated Date --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500">
                            Last Updated
                        </h3>

                        <p class="mt-1 text-gray-700">
                            {{ $category->updated_at->format('d M Y, h:i A') }}
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3">

                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Edit Category
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                           class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Back
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>