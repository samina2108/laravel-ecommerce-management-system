<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shopping Cart
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow-sm border">

                <div class="p-6">

                    <h1 class="text-2xl font-bold text-gray-800">
                        Your Cart
                    </h1>

                    <p class="mt-1 text-sm text-gray-600">
                        Products you have added to your cart.
                    </p>

                    @if(session('success'))
                        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($cartItems->count())

                        <div class="mt-6 space-y-4">

                            @foreach($cartItems as $item)

                                <div class="flex flex-col md:flex-row md:items-center gap-4 border rounded-lg p-4">

                                    {{-- Product Image --}}
                                    <div class="w-24 h-24 bg-gray-50 border rounded-md flex items-center justify-center">

                                        @if($item->product->image)

                                            <img
                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}"
                                                class="max-w-full max-h-full object-contain p-2"
                                            >

                                        @else

                                            <span class="text-xs text-gray-500">
                                                No Image
                                            </span>

                                        @endif

                                    </div>

                                    {{-- Product Information --}}
                                    <div class="flex-1">

                                        <h3 class="text-lg font-semibold text-gray-800">
                                            {{ $item->product->name }}
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Rs. {{ number_format($item->product->price, 2) }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-600">
                                            Quantity: {{ $item->quantity }}
                                        </p><form
    method="POST"
    action="{{ route('cart.update', $item) }}"
    class="mt-2 flex items-center gap-2"
>
    @csrf
    @method('PATCH')

    <label
        for="quantity-{{ $item->id }}"
        class="text-sm text-gray-600"
    >
        Quantity:
    </label>

    <input
        type="number"
        id="quantity-{{ $item->id }}"
        name="quantity"
        value="{{ $item->quantity }}"
        min="1"
        max="{{ $item->product->stock }}"
        class="w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    >

    <button
        type="submit"
        class="px-3 py-2 text-sm bg-gray-800 text-white rounded-md hover:bg-gray-900 transition"
    >
        Update
    </button>
</form>

                                    </div>

                                    {{-- Remove Product --}}
<div>

    <form
        method="POST"
        action="{{ route('cart.destroy', $item) }}"
        onsubmit="return confirm('Are you sure you want to remove this product from your cart?');"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="px-4 py-2 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition"
        >
            Remove
        </button>

    </form>

</div>  

                                    {{-- Total --}}
                                    <div class="text-lg font-bold text-gray-900">

                                        Rs.
                                        {{ number_format($item->product->price * $item->quantity, 2) }}

                                    </div>

                                </div>

                            @endforeach
                          

                            {{-- Order Summary --}}
<div class="mt-8 border-t pt-6">

    <div class="max-w-md ml-auto bg-gray-50 border rounded-lg p-5">

        <h3 class="text-lg font-semibold text-gray-800">
            Order Summary
        </h3>

        <div class="mt-4 flex justify-between text-sm text-gray-600">
            <span>Total Items</span>
            <span>{{ $totalItems }}</span>
        </div>

        <div class="mt-2 flex justify-between text-sm text-gray-600">
            <span>Subtotal</span>
            <span>
                Rs. {{ number_format($subtotal, 2) }}
            </span>
        </div>

        <div class="mt-4 pt-4 border-t flex justify-between text-lg font-bold text-gray-900">
            <span>Total</span>
            <span>
                Rs. {{ number_format($subtotal, 2) }}
            </span>
        </div>


        <!-- Checkout Button -->
<div class="mt-6">

<a
    href="{{ route('checkout.index') }}"
    class="block w-full text-center px-5 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-200"
>
    Proceed to Checkout →
</a>

</div>

        <div class="mt-5">

            <a
                href="{{ route('products.index') }}"
                class="block w-full text-center px-5 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition"
            >
                Continue Shopping
            </a>

        </div>

    </div>

</div>
                        </div>

                    @else

                        <div class="mt-6 p-10 text-center border rounded-lg bg-gray-50">

                            <h3 class="text-lg font-semibold text-gray-800">
                                Your Cart is Empty
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                You have not added any products yet.
                            </p>

                            <div class="mt-5">

                                <a
                                    href="{{ route('products.index') }}"
                                    class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                                >
                                    Continue Shopping
                                </a>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout> 