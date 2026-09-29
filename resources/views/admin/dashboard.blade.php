<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Welcome to Admin Dashboard
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Manage your e-commerce store from here.
                    </p>
                </div>
            </div>

            <!-- Order Statistics -->
            <div class="mb-6">

                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    Order Statistics
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Total Orders -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">
                            Total Orders
                        </div>

                        <div class="mt-2 text-3xl font-bold text-gray-800">
                            {{ $totalOrders }}
                        </div>
                    </div>

                    <!-- Pending Orders -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">
                            Pending Orders
                        </div>

                        <div class="mt-2 text-3xl font-bold text-yellow-600">
                            {{ $pendingOrders }}
                        </div>
                    </div>

                    <!-- Confirmed Orders -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">
                            Confirmed Orders
                        </div>

                        <div class="mt-2 text-3xl font-bold text-blue-600">
                            {{ $confirmedOrders }}
                        </div>
                    </div>

                    <!-- Completed Orders -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">
                            Completed Orders
                        </div>

                        <div class="mt-2 text-3xl font-bold text-green-600">
                            {{ $completedOrders }}
                        </div>
                    </div>

                    <!-- Cancelled Orders -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">
                            Cancelled Orders
                        </div>

                        <div class="mt-2 text-3xl font-bold text-red-600">
                            {{ $cancelledOrders }}
                        </div>
                    </div>

                    <!-- Total Sales -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">
                            Total Sales
                        </div>

                        <div class="mt-2 text-3xl font-bold text-indigo-600">
                            Rs. {{ number_format($totalSales, 2) }}
                        </div>
                    </div>

                </div>

            </div>

            <!-- Product & Customer Statistics -->
<div class="mb-6">

<h3 class="text-xl font-semibold text-gray-800 mb-4">
    Store Statistics
</h3>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Total Products -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="text-sm font-medium text-gray-500">
            Total Products
        </div>

        <div class="mt-2 text-3xl font-bold text-gray-800">
            {{ $totalProducts }}
        </div>
    </div>

    <!-- Active Products -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="text-sm font-medium text-gray-500">
            Active Products
        </div>

        <div class="mt-2 text-3xl font-bold text-green-600">
            {{ $activeProducts }}
        </div>
    </div>

    <!-- Out of Stock -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="text-sm font-medium text-gray-500">
            Out of Stock
        </div>

        <div class="mt-2 text-3xl font-bold text-red-600">
            {{ $outOfStockProducts }}
        </div>
    </div>

    <!-- Total Customers -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="text-sm font-medium text-gray-500">
            Total Customers
        </div>

        <div class="mt-2 text-3xl font-bold text-indigo-600">
            {{ $totalCustomers }}
        </div>
    </div>

</div>

</div>

<!-- Sales Summary -->
<div class="mb-6">

    <h3 class="text-xl font-semibold text-gray-800 mb-4">
        Sales Summary
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Total Sales -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="text-sm font-medium text-gray-500">
                Total Sales
            </div>

            <div class="mt-2 text-3xl font-bold text-indigo-600">
                Rs. {{ number_format($totalSales, 2) }}
            </div>

            <p class="mt-2 text-sm text-gray-500">
                From completed orders
            </p>
        </div>

        <!-- Average Order Value -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="text-sm font-medium text-gray-500">
                Average Order Value
            </div>

            <div class="mt-2 text-3xl font-bold text-blue-600">
                Rs. {{ number_format($averageOrderValue, 2) }}
            </div>

            <p class="mt-2 text-sm text-gray-500">
                Per completed order
            </p>
        </div>

        <!-- Today's Sales -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="text-sm font-medium text-gray-500">
                Today's Sales
            </div>

            <div class="mt-2 text-3xl font-bold text-green-600">
                Rs. {{ number_format($todaySales, 2) }}
            </div>

            <p class="mt-2 text-sm text-gray-500">
                Completed orders today
            </p>
        </div>

    </div>

</div>

            <!-- Recent Orders -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">

<div class="flex items-center justify-between mb-4">
    <h3 class="text-xl font-semibold text-gray-800">
        Recent Orders
    </h3>

    <a
        href="{{ route('admin.orders.index') }}"
        class="text-sm text-indigo-600 hover:text-indigo-800 font-medium"
    >
        View All Orders
    </a>
</div>

@if($recentOrders->count() > 0)

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Order
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Customer
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
    Items
</th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Total
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Status
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Date
                    </th>

                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">

                @foreach($recentOrders as $order)

                    <tr class="hover:bg-gray-50">

                        <!-- Order -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            #{{ $order->id }}
                        </td>

                        <!-- Customer -->
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $order->user->name }}
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $order->user->email }}
                            </div>
                        </td>

                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
    {{ $order->items_count }}
    {{ $order->items_count == 1 ? 'Item' : 'Items' }}
</td>

                        <!-- Total -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-4 whitespace-nowrap">

                            @if($order->status === 'pending')

                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>

                            @elseif($order->status === 'confirmed')

                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Confirmed
                                </span>

                            @elseif($order->status === 'completed')

                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>

                            @elseif($order->status === 'cancelled')

                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Cancelled
                                </span>

                            @endif

                        </td>

                        <!-- Date -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <!-- Action -->
                        <td class="px-4 py-4 whitespace-nowrap text-right">

                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
                            >
                                View
                            </a>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@else

    <div class="py-8 text-center">

        <p class="text-gray-500">
            No orders found.
        </p>

        <a
            href="{{ route('admin.orders.index') }}"
            class="inline-block mt-3 text-indigo-600 hover:text-indigo-800 font-medium"
        >
            Go to Orders
        </a>

    </div>

@endif

</div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    Quick Actions
                </h3>

                <div class="flex flex-wrap gap-3">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                    >
                        Manage Categories
                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                    >
                        Manage Products
                    </a>

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                    >
                        Manage Orders
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>