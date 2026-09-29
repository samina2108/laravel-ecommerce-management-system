<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController as CustomerProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::resource('products', AdminProductController::class);

        Route::get('/orders', [AdminOrderController::class, 'index'])
    ->name('orders.index');

Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
    ->name('orders.show');

    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
    ->name('orders.update-status');
    });


/*
|--------------------------------------------------------------------------
| Customer Shop Route
|--------------------------------------------------------------------------
*/

Route::get('/shop', [CustomerProductController::class, 'index'])
    ->name('products.index');

    Route::get('/shop/{product}', [CustomerProductController::class, 'show'])
    ->name('products.show');


    Route::middleware('auth')->group(function () {

        Route::post('/cart/add/{product}', [CartController::class, 'add'])
            ->name('cart.add');
    
        Route::get('/cart', [CartController::class, 'index'])
            ->name('cart.index');

            Route::patch('/cart/update/{cart}', [CartController::class, 'update'])
    ->name('cart.update');

    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])
    ->name('cart.destroy');   
    
    Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

    Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

    Route::post('/orders/place', [CheckoutController::class, 'placeOrder'])
    ->name('orders.place');
    
    });

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';