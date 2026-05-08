<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $product = Product::findOrFail($request->product_id);
        $cart    = session()->get('cart', []);
        $qty     = max(1, (int) $request->quantity);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '"' . $product->name . '" added to cart!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            $qty = max(1, (int) $request->quantity);
            $cart[$request->product_id]['quantity'] = $qty;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Cart updated.');
    }

    public function index()
    {
        return view('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
