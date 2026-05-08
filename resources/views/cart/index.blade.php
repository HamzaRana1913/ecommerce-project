@extends('layouts.app')
@section('title', 'Your Cart - LuxeStore')

@section('head_styles')
<style>
    .page-hero { background:var(--dark); padding:4rem 5% 3rem; }
    .page-hero h1 { font-family:'Playfair Display',serif; font-size:2.5rem; color:white; font-weight:900; }
    .page-hero h1 em { color:var(--gold); font-style:italic; }
    .breadcrumb { color:rgba(255,255,255,0.4); font-size:0.85rem; margin-bottom:1rem; }
    .breadcrumb a { color:var(--gold); text-decoration:none; }

    .cart-page { display:grid; grid-template-columns:1fr 360px; gap:3rem; padding:3rem 5%; max-width:1200px; margin:0 auto; }

    /* CART TABLE */
    .cart-table-card { background:var(--white); border:1px solid var(--cream-2); border-radius:8px; overflow:hidden; }
    .cart-table-header { padding:1.2rem 2rem; border-bottom:1px solid var(--cream-2); display:flex; justify-content:space-between; align-items:center; }
    .cart-table-title { font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--dark); font-weight:700; }
    .cart-row { display:grid; grid-template-columns:auto 1fr auto auto; align-items:center; gap:1.5rem; padding:1.5rem 2rem; border-bottom:1px solid var(--cream-2); }
    .cart-row:last-child { border-bottom:none; }
    .cart-img { width:80px; height:80px; background:var(--cream); border-radius:4px; overflow:hidden; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .cart-img img { width:100%; height:100%; object-fit:cover; }
    .cart-img-icon { font-size:1.8rem; color:var(--gold); opacity:0.3; }
    .cart-product-name { font-family:'Playfair Display',serif; font-size:1rem; font-weight:600; color:var(--dark); }
    .cart-product-price { color:var(--text-muted); font-size:0.85rem; margin-top:0.3rem; }
    .qty-control { display:flex; align-items:center; border:1px solid var(--cream-2); border-radius:4px; overflow:hidden; background:var(--white); }
    .qty-btn { width:34px; height:36px; border:none; background:none; cursor:pointer; font-size:1rem; color:var(--text); transition:background 0.2s; }
    .qty-btn:hover { background:var(--cream); }
    .qty-val { width:44px; height:36px; border:none; border-left:1px solid var(--cream-2); border-right:1px solid var(--cream-2); text-align:center; font-size:0.9rem; font-weight:600; color:var(--dark); }
    .cart-subtotal { font-weight:700; font-size:1rem; color:var(--dark); text-align:right; min-width:100px; }
    .btn-remove { display:block; color:var(--text-muted); font-size:0.78rem; margin-top:0.4rem; text-align:right; cursor:pointer; background:none; border:none; transition:color 0.2s; }
    .btn-remove:hover { color:#dc3545; }

    /* SUMMARY */
    .summary-card { background:var(--white); border:1px solid var(--cream-2); border-radius:8px; padding:2rem; position:sticky; top:90px; align-self:start; }
    .summary-title { font-family:'Playfair Display',serif; font-size:1.2rem; color:var(--dark); margin-bottom:1.5rem; padding-bottom:0.8rem; border-bottom:2px solid var(--gold); }
    .summary-row { display:flex; justify-content:space-between; font-size:0.9rem; margin-bottom:0.8rem; }
    .summary-row .label { color:var(--text-muted); }
    .summary-row .val { color:var(--dark); font-weight:600; }
    .summary-total { display:flex; justify-content:space-between; padding-top:1rem; margin-top:0.5rem; border-top:2px solid var(--dark); font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:700; color:var(--dark); }
    .btn-checkout { width:100%; background:var(--dark); color:var(--gold); border:2px solid var(--gold); padding:1rem; font-weight:700; font-size:0.9rem; letter-spacing:1px; text-transform:uppercase; cursor:pointer; border-radius:4px; transition:all 0.2s; margin-top:1.5rem; text-decoration:none; display:block; text-align:center; }
    .btn-checkout:hover { background:var(--gold); color:var(--dark); }
    .btn-continue { display:block; text-align:center; margin-top:0.8rem; color:var(--text-muted); font-size:0.85rem; text-decoration:none; }
    .btn-continue:hover { color:var(--gold); }

    .empty-state { text-align:center; padding:4rem 2rem; }
    .empty-icon { font-size:4rem; color:var(--gold); opacity:0.3; margin-bottom:1.5rem; }
    .empty-state h3 { font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--dark); }
    .empty-state p { color:var(--text-muted); margin:0.5rem 0 2rem; }
    .btn-shop { background:var(--dark); color:var(--gold); border:2px solid var(--gold); padding:0.8rem 2rem; font-weight:700; font-size:0.9rem; text-transform:uppercase; border-radius:4px; text-decoration:none; display:inline-block; transition:all 0.2s; }
    .btn-shop:hover { background:var(--gold); color:var(--dark); }

    @media(max-width:900px) { .cart-page { grid-template-columns:1fr; } .summary-card { position:static; } }
    @media(max-width:600px) { .cart-row { grid-template-columns:auto 1fr; } .cart-subtotal { grid-column:2; } }
</style>
@endsection

@section('content')
<div class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> / Cart</div>
    <h1>Your <em>Cart</em></h1>
</div>

@php $cart = session('cart', []); $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']); $shipping = $subtotal > 2000 ? 0 : ($subtotal > 0 ? 200 : 0); $total = $subtotal + $shipping; @endphp

@if(empty($cart))
<div style="padding:3rem 5%">
    <div class="cart-table-card">
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
            <h3>Your Cart is Empty</h3>
            <p>Add some products to get started!</p>
            <a href="{{ route('products.index') }}" class="btn-shop"><i class="fas fa-store" style="margin-right:0.5rem"></i>Browse Products</a>
        </div>
    </div>
</div>
@else
<div class="cart-page">
    <!-- CART ITEMS -->
    <div>
        <div class="cart-table-card">
            <div class="cart-table-header">
                <div class="cart-table-title"><i class="fas fa-shopping-bag" style="color:var(--gold);margin-right:0.5rem"></i>{{ count($cart) }} Item(s)</div>
                <form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('Clear entire cart?')">
                    @csrf
                    <input type="hidden" name="product_id" value="all">
                    <button type="submit" style="background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:0.85rem;"><i class="fas fa-trash"></i> Clear Cart</button>
                </form>
            </div>

            @foreach($cart as $productId => $item)
            <div class="cart-row">
                <div class="cart-img">
                    @if($item['image'])
                        <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}">
                    @else
                        <div class="cart-img-icon"><i class="fas fa-gem"></i></div>
                    @endif
                </div>
                <div>
                    <div class="cart-product-name">{{ $item['name'] }}</div>
                    <div class="cart-product-price">PKR {{ number_format($item['price'], 0) }} each</div>
                </div>
                <div>
                    <form action="{{ route('cart.update') }}" method="POST" class="qty-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productId }}">
                        <div class="qty-control">
                            <button type="button" class="qty-btn" onclick="changeQty(this, -1)">−</button>
                            <input type="number" name="quantity" class="qty-val" value="{{ $item['quantity'] }}" min="1" max="99"
                                   onchange="this.closest('form').submit()">
                            <button type="button" class="qty-btn" onclick="changeQty(this, 1)">+</button>
                        </div>
                    </form>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productId }}">
                        <button type="submit" class="btn-remove"><i class="fas fa-times"></i> Remove</button>
                    </form>
                </div>
                <div class="cart-subtotal">
                    PKR {{ number_format($item['price'] * $item['quantity'], 0) }}
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:1rem">
            <a href="{{ route('products.index') }}" style="color:var(--gold);text-decoration:none;font-size:0.9rem"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
        </div>
    </div>

    <!-- ORDER SUMMARY -->
    <div>
        <div class="summary-card">
            <div class="summary-title">Order Summary</div>
            <div class="summary-row"><span class="label">Subtotal</span><span class="val">PKR {{ number_format($subtotal, 0) }}</span></div>
            <div class="summary-row">
                <span class="label">Shipping</span>
                <span class="val" style="{{ $shipping == 0 ? 'color:#28a745' : '' }}">
                    {{ $shipping == 0 ? 'FREE' : 'PKR '.number_format($shipping, 0) }}
                </span>
            </div>
            @if($shipping > 0)
            <div style="font-size:0.78rem;color:var(--gold);margin-bottom:0.5rem">
                <i class="fas fa-info-circle"></i> Free shipping on orders over PKR 2,000
            </div>
            @endif
            <div class="summary-total"><span>Total</span><span>PKR {{ number_format($total, 0) }}</span></div>
            @auth
                <a href="{{ route('checkout.index') }}" class="btn-checkout"><i class="fas fa-lock" style="margin-right:0.4rem"></i>Proceed to Checkout</a>
            @else
                <a href="{{ route('login') }}" class="btn-checkout"><i class="fas fa-sign-in-alt" style="margin-right:0.4rem"></i>Login to Checkout</a>
            @endauth
            <a href="{{ route('products.index') }}" class="btn-continue">← Continue Shopping</a>
        </div>
    </div>
</div>
@endif
<div style="margin-bottom:4rem"></div>
@endsection

@section('scripts')
<script>
function changeQty(btn, delta) {
    const input = btn.closest('.qty-control').querySelector('input');
    const val   = parseInt(input.value) + delta;
    if (val >= 1 && val <= 99) {
        input.value = val;
        input.closest('form').submit();
    }
}
</script>
@endsection
