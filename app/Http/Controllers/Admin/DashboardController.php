<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $confirmedOrders = Order::where('status', 'confirmed')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $cancelledOrders = Order::where('status', 'cancelled')->count();

        $totalSales = Order::where('status', 'completed')
            ->sum('total_amount');

            $completedOrdersCount = Order::where('status', 'completed')
    ->count();

$averageOrderValue = $completedOrdersCount > 0
    ? $totalSales / $completedOrdersCount
    : 0;

$todaySales = Order::where('status', 'completed')
    ->whereDate('created_at', today())
    ->sum('total_amount');

            $totalProducts = Product::count();

            $activeProducts = Product::where('status', 'active')->count();
            
            $outOfStockProducts = Product::where('stock', 0)->count();
            
            $totalCustomers = User::whereHas('role', function ($query) {
                $query->where('name', 'customer');
            })->count();    

        // Recent Orders
        $recentOrders = Order::with('user')
    ->withCount('items')
    ->latest()
    ->take(5)
    ->get();    

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'confirmedOrders',
            'completedOrders',
            'cancelledOrders',
            'totalSales',
            'recentOrders',
            'totalProducts',
             'activeProducts',
             'outOfStockProducts',
             'totalCustomers',
             'completedOrdersCount',
'averageOrderValue',
'todaySales',
            
        ));
    }
}