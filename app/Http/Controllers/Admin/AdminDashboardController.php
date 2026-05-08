<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Order, OrderItem, User, Contact};

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'orders'   => Order::count(),
            'revenue'  => Order::whereNotIn('status', ['cancelled'])->sum('total_amount'),
            'users'    => User::where('is_admin', false)->count(),
        ];

        $products   = Product::latest()->get();
        $orders     = Order::with(['user', 'items'])->latest()->get();
        $orderItems = OrderItem::with(['order.user', 'product'])->latest()->get();
        $users      = User::with('orders')->where('is_admin', false)->latest()->get();
        $admins     = User::where('is_admin', true)->latest()->get();

        return view('admin.dashboard', compact(
            'stats', 'products', 'orders', 'orderItems', 'users', 'admins'
        ));
    }
}
