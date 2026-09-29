<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Orders
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Orders Table --}}
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">

                <div class="px-6 py-5 border-b">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-6">
    <div class="flex flex-col lg:flex-row gap-3 items-start lg:items-end">

        <div class="w-full lg:w-80">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                Search Orders
            </label>

            <input
                type="text"
                name="search"
                id="search"
                value="{{ request('search') }}"
                placeholder="Order ID, customer name or email"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                Filter by Status
            </label>

            <select
                name="status"
                id="status"
                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
                <option value="">All Orders</option>

                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>
                    Confirmed
                </option>

                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>
            </select>
        </div>

        <button
            type="submit"
            class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition duration-200"
        >
            Search / Filter
        </button>

        @if(request('search') || request('status'))
            <a
                href="{{ route('admin.orders.index') }}"
                class="px-5 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition duration-200"
            >
                Clear
            </a>
        @endif

    </div>
</form>

<div class="mb-4 text-sm text-gray-600">
    Showing
    <span class="font-semibold text-gray-900">
        {{ $orders->firstItem() ?? 0 }}
    </span>
    -
    <span class="font-semibold text-gray-900">
        {{ $orders->lastItem() ?? 0 }}
    </span>
    of
    <span class="font-semibold text-gray-900">
        {{ $orders->total() }}
    </span>
    orders
</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                All Orders
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Manage customer orders and order status.
                            </p>
                        </div>

                        <div class="text-sm text-gray-500">
                            Total Orders:
                            <span class="font-semibold text-gray-800">
                                {{ $orders->total() }}
                            </span>
                        </div>

                    </div>

                </div>

                @if($orders->count())

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Order
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Customer
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Total
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Date
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach($orders as $order)

                                    <tr class="hover:bg-gray-50">

                                        {{-- Order --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="font-semibold text-gray-800">
                                                #{{ $order->id }}
                                            </div>

                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $order->items->count() }}
                                                {{ $order->items->count() === 1 ? 'item' : 'items' }}
                                            </div>

                                        </td>

                                        {{-- Customer --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="text-sm font-medium text-gray-800">
                                                {{ $order->user->name ?? 'Unknown' }}
                                            </div>

                                            <div class="text-xs text-gray-500">
                                                {{ $order->user->email ?? 'N/A' }}
                                            </div>

                                        </td>

                                        {{-- Total --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="font-semibold text-gray-800">
                                                Rs. {{ number_format($order->total_amount, 2) }}
                                            </span>

                                        </td>

                                        {{-- Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if($order->status === 'pending')

                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>

                                            @elseif($order->status === 'confirmed')

                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Confirmed
                                                </span>

                                            @elseif($order->status === 'completed')

                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Completed
                                                </span>

                                            @elseif($order->status === 'cancelled')

                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Cancelled
                                                </span>

                                            @endif

                                        </td>

                                        {{-- Date --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="text-sm text-gray-700">
                                                {{ $order->created_at->format('d M Y') }}
                                            </div>

                                            <div class="text-xs text-gray-500">
                                                {{ $order->created_at->format('h:i A') }}
                                            </div>

                                        </td>

                                        {{-- Action --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right">

                                            <a
                                                href="{{ route('admin.orders.show', $order) }}"
                                                class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition"
                                            >
                                                View
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    {{-- Pagination --}}
                    <div class="px-6 py-4 border-t">
                        {{ $orders->links() }}
                    </div>

                @else

                    <div class="p-10 text-center">

                        <div class="text-5xl mb-4">
                            📦
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800">
                            No Orders Found
                        </h3>

                        <p class="text-gray-500 mt-2">
                            There are currently no customer orders.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>