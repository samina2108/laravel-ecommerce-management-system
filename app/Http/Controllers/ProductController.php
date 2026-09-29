<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::where('status', 'active')
        ->orderBy('name')
        ->get();

    $products = Product::with('category')
        ->where('status', 'active')
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        })
        ->when($request->category, function ($query, $category) {
            $query->where('category_id', $category);
        })
        ->when($request->sort, function ($query, $sort) {

            switch ($sort) {

                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;

                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;

                case 'name':
                    $query->orderBy('name', 'asc');
                    break;

                default:
                    $query->latest();
                    break;
            }

        }, function ($query) {
            $query->latest();
        })
        ->paginate(12)
        ->withQueryString();

    return view('products.index', compact('products', 'categories'));
}

    public function show(Product $product)
{
    // Only active products can be viewed by customers
    if ($product->status !== 'active') {
        abort(404);
    }

    $product->load('category');

    return view('products.show', compact('product'));
}
}