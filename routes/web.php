<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminContactController;

use App\Http\Controllers\UserOrderController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth
require __DIR__.'/auth.php';

// Cart (public view, auth for checkout)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/order/success/{id}', [CheckoutController::class, 'success'])->name('order.success');
    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('user.orders');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', fn() => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::get('/order-items', [AdminOrderController::class, 'items'])->name('order-items.index');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/admins', [AdminUserController::class, 'admins'])->name('admins.index');
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
});
