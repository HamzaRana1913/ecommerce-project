<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Order, OrderItem};
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Order status updated to "' . ucfirst($request->status) . '".');
    }

    public function items()
    {
        $orderItems = OrderItem::with(['order.user', 'product'])->latest()->get();
        return view('admin.orders.items', compact('orderItems'));
    }
}
