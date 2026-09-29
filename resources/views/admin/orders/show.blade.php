<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
        {{ session('success') }}
    </div>
@endif

    <div class="py-8">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <div class="mb-6">
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-800"
                >
                    ← Back to Orders
                </a>
            </div>

            {{-- Order Header --}}
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">

                <div class="px-6 py-5 bg-gray-50 border-b">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

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

                        <div class="mt-6 p-4 bg-gray-50 rounded-lg border">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">
        Update Order Status
    </h3>

    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
        @csrf
        @method('PATCH')

        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-end">

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    Order Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>
                        Confirmed
                    </option>

                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>
                </select>
            </div>

            <button
                type="submit"
                class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition duration-200"
            >
                Update Status
            </button>

        </div>
    </form>
</div>

                    </div>

                </div>


                

                {{-- Customer Information --}}
                <div class="p-6 border-b">

                    <h4 class="text-lg font-semibold text-gray-800 mb-4">
                        Customer Information
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div>
                            <p class="text-sm text-gray-500">
                                Name
                            </p>

                            <p class="font-medium text-gray-800">
                                {{ $order->user->name ?? 'Unknown' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Email
                            </p>

                            <p class="font-medium text-gray-800">
                                {{ $order->user->email ?? 'N/A' }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Order Items --}}
                <div class="p-6">

                    <h4 class="text-lg font-semibold text-gray-800 mb-5">
                        Order Items
                    </h4>

                    <div class="overflow-x-auto">

                        <table class="min-w-full">

                            <thead>

                                <tr class="border-b">

                                    <th class="pb-3 text-left text-sm font-semibold text-gray-600">
                                        Product
                                    </th>

                                    <th class="pb-3 text-left text-sm font-semibold text-gray-600">
                                        Price
                                    </th>

                                    <th class="pb-3 text-left text-sm font-semibold text-gray-600">
                                        Quantity
                                    </th>

                                    <th class="pb-3 text-right text-sm font-semibold text-gray-600">
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y">

                                @foreach($order->items as $item)

                                    <tr>

                                        <td class="py-4">

                                            <span class="font-medium text-gray-800">
                                                {{ $item->product_name }}
                                            </span>

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

                    {{-- Total --}}
                    <div class="border-t mt-6 pt-5">

                        <div class="flex justify-end">

                            <div class="w-full sm:w-80">

                                <div class="flex justify-between items-center">

                                    <span class="text-lg font-semibold text-gray-800">
                                        Order Total
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