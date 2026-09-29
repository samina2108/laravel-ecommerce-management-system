<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        // Product must be active
        if ($product->status !== 'active') {
            abort(404);
        }

        // Product must be in stock
        if ($product->stock <= 0) {
            return back()->with('error', 'Product is out of stock.');
        }

        // Validate quantity
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $validated['quantity'];

        // Check existing cart item
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {

            $newQuantity = $cart->quantity + $quantity;

            // Do not exceed available stock
            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'Requested quantity exceeds available stock.'
                );
            }

            $cart->update([
                'quantity' => $newQuantity,
            ]);

        } else {

            // Do not exceed available stock
            if ($quantity > $product->stock) {
                return back()->with(
                    'error',
                    'Requested quantity exceeds available stock.'
                );
            }

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to cart successfully.');
    }


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

    // Refresh cart items after removing invalid products
    $cartItems = Cart::with('product')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    $subtotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    $totalItems = $cartItems->sum('quantity');

    return view('cart.index', compact(
        'cartItems',
        'subtotal',
        'totalItems'
    ));
}


public function update(Request $request, Cart $cart)
{
    // Customer can update only their own cart item
    if ($cart->user_id !== auth()->id()) {
        abort(403);
    }

    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);
  

    if (
        !$cart->product ||
        $cart->product->status !== 'active'
    ) {
        $cart->delete();
    
        return redirect()
            ->route('cart.index')
            ->with(
                'error',
                'This product is no longer available.'
            );
    }
    // Check available stock
    if ($validated['quantity'] > $cart->product->stock) {
        return back()->with(
            'error',
            'Requested quantity exceeds available stock.'
        );
    }

    $cart->update([
        'quantity' => $validated['quantity'],
    ]);

    return back()->with(
        'success',
        'Cart quantity updated successfully.'
    );

    
}

public function destroy(Cart $cart)
{
    // Customer can delete only their own cart item
    if ($cart->user_id !== auth()->id()) {
        abort(403);
    }

    $cart->delete();

    return back()->with(
        'success',
        'Product removed from cart successfully.'
    );
}
}
