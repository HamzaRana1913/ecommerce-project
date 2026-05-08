<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer,easypaisa',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping  = $subtotal > 2000 ? 0 : 200;
        $total     = $subtotal + $shipping;

        $order = Order::create([
            'user_id'          => auth()->id(),
            'total_amount'     => $total,
            'payment_method'   => $request->payment_method,
            'status'           => 'pending',
            'shipping_name'    => $request->first_name . ' ' . $request->last_name,
            'shipping_email'   => $request->email,
            'shipping_phone'   => $request->phone,
            'shipping_address' => $request->address . ', ' . $request->city . ', ' . $request->province,
            'notes'            => $request->notes,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');
        $orderNum = '#' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
        return redirect()->route('order.success', $order->id)
                         ->with('success', "Order $orderNum placed successfully!");
    }

    public function success($id)
    {
        $order = Order::with(['items.product'])->findOrFail($id);
        abort_unless($order->user_id === auth()->id(), 403);
        return view('checkout.success', compact('order'));
    }
}
