<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-6">
                <a
                    href="{{ route('orders.index') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-800"
                >
                    ← Back to My Orders
                </a>
            </div>

            <!-- Order Information -->
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">

                <!-- Header -->
                <div class="px-6 py-5 bg-gray-50 border-b">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                Order #{{ $order->id }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Placed on
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>

                        <div>

                            @if($order->status === 'pending')

                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>

                            @elseif($order->status === 'confirmed')

                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Confirmed
                                </span>

                            @elseif($order->status === 'completed')

                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>

                            @elseif($order->status === 'cancelled')

                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    Cancelled
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                <!-- Order Items -->
                <div class="p-6">

                    <h4 class="text-lg font-semibold text-gray-800 mb-5">
                        Order Items
                    </h4>

                    <div class="overflow-x-auto">

                        <table class="min-w-full">

                            <thead>

                                <tr class="border-b text-left">

                                    <th class="pb-3 text-sm font-semibold text-gray-600">
                                        Product
                                    </th>

                                    <th class="pb-3 text-sm font-semibold text-gray-600">
                                        Price
                                    </th>

                                    <th class="pb-3 text-sm font-semibold text-gray-600">
                                        Quantity
                                    </th>

                                    <th class="pb-3 text-sm font-semibold text-gray-600 text-right">
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y">

                                @foreach($order->items as $item)

                                    <tr>

                                        <td class="py-4">

                                            <div class="font-medium text-gray-800">
                                                {{ $item->product_name }}
                                            </div>

                                        </td>

                                        <td class="py-4 text-gray-600">
                                            Rs. {{ number_format($item->price, 2) }}
                                        </td>

                                        <td class="py-4 text-gray-600">
                                            {{ $item->quantity }}
                                        </td>

                                        <td class="py-4 text-right font-medium text-gray-800">
                                            Rs. {{ number_format($item->subtotal, 2) }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <!-- Total -->
                    <div class="border-t mt-6 pt-5">

                        <div class="flex justify-end">

                            <div class="w-full sm:w-72">

                                <div class="flex justify-between items-center">

                                    <span class="text-lg font-semibold text-gray-800">
                                        Total
                                    </span>

                                    <span class="text-xl font-bold text-indigo-600">
                                        Rs. {{ number_format($order->total_amount, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>