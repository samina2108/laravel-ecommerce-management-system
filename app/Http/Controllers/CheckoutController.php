<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        // Remove invalid products from cart
        foreach ($cartItems as $item) {
            if (
                !$item->product ||
                $item->product->status !== 'active'
            ) {
                $item->delete();
            }
        }

        // Refresh cart items
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Check stock availability
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        'Some products do not have enough stock.'
                    );
            }
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $totalItems = $cartItems->sum('quantity');

        return view('checkout.index', compact(
            'cartItems',
            'subtotal',
            'totalItems'
        ));
    }


    public function placeOrder()
{
    $cartItems = Cart::with('product')
        ->where('user_id', auth()->id())
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()
            ->route('cart.index')
            ->with('error', 'Your cart is empty.');
    }

    // Validate products and stock before creating order
    foreach ($cartItems as $item) {

        if (
            !$item->product ||
            $item->product->status !== 'active'
        ) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'One or more products are no longer available.'
                );
        }

        if ($item->quantity > $item->product->stock) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Not enough stock available for ' . $item->product->name . '.'
                );
        }
    }

    DB::transaction(function () use ($cartItems) {

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Create Order Items and reduce stock
        foreach ($cartItems as $item) {

            $price = $item->product->price;
            $quantity = $item->quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'product_name' => $item->product->name,
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $price * $quantity,
            ]);

            $item->product->decrement('stock', $quantity);
        }

        // Empty customer's cart
        Cart::where('user_id', auth()->id())->delete();
    });

    return redirect()
        ->route('orders.index')
        ->with(
            'success',
            'Your order has been placed successfully.'
        );
}
}