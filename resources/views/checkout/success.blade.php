@extends('layouts.app')
@section('title', 'Order Placed - LuxeStore')

@section('head_styles')
<style>
    .success-page {
        max-width: 750px;
        margin: 5rem auto;
        padding: 0 1.5rem;
        text-align: center;
    }
    .success-icon {
        width: 100px; height: 100px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.5rem;
        color: var(--dark);
        margin: 0 auto 2rem;
        box-shadow: 0 10px 40px rgba(201,168,76,0.3);
    }
    .success-page h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }
    .success-page h1 em { color: var(--gold); font-style: italic; }
    .order-id {
        display: inline-block;
        background: rgba(201,168,76,0.1);
        color: var(--gold);
        border: 1px solid rgba(201,168,76,0.3);
        padding: 0.4rem 1.2rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 1rem 0 2rem;
    }
    .order-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 8px;
        padding: 2rem;
        text-align: left;
        margin-bottom: 2rem;
    }
    .order-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--gold);
    }
    .order-item-row {
        display: flex; justify-content: space-between;
        padding: 0.8rem 0;
        border-bottom: 1px solid var(--cream-2);
        font-size: 0.9rem;
    }
    .order-item-row:last-child { border-bottom: none; }
    .item-name { color: var(--text); font-weight: 500; }
    .item-meta { color: var(--text-muted); font-size: 0.8rem; }
    .item-price { color: var(--dark); font-weight: 700; }
    .totals-row {
        display: flex; justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.9rem;
        color: var(--text-muted);
    }
    .totals-row.total {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        border-top: 2px solid var(--dark);
        margin-top: 0.5rem;
        padding-top: 1rem;
        font-family: 'Playfair Display', serif;
    }
    .shipping-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.9rem; }
    .shipping-item .label { color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.2rem; }
    .shipping-item .value { color: var(--dark); font-weight: 500; }
    .action-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .btn-primary { background:var(--dark); color:var(--gold); border:2px solid var(--gold); padding:0.9rem 2.5rem; font-weight:700; font-size:0.9rem; letter-spacing:0.5px; text-transform:uppercase; border-radius:4px; text-decoration:none; display:inline-block; transition:all 0.2s; }
    .btn-primary:hover { background:var(--gold); color:var(--dark); }
    .btn-outline { background:white; color:var(--text); border:1px solid var(--cream-2); padding:0.9rem 2.5rem; font-weight:600; font-size:0.9rem; border-radius:4px; text-decoration:none; display:inline-block; transition:all 0.2s; }
    .btn-outline:hover { border-color:var(--gold); color:var(--gold); }
</style>
@endsection

@section('content')
<div class="success-page">
    <div class="success-icon"><i class="fas fa-check"></i></div>
    <h1>Order <em>Confirmed!</em></h1>
    <p style="color:var(--text-muted);font-size:1rem;margin-bottom:0.5rem">Thank you for shopping with LuxeStore.</p>
    <div class="order-id">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>

    <!-- ORDER ITEMS -->
    <div class="order-card">
        <div class="order-card-title"><i class="fas fa-box-open" style="color:var(--gold);margin-right:0.5rem"></i>Your Items</div>
        @foreach($order->items as $item)
        <div class="order-item-row">
            <div>
                <div class="item-name">{{ $item->product->name ?? 'Product' }}</div>
                <div class="item-meta">Qty: {{ $item->quantity }} × PKR {{ number_format($item->price, 0) }}</div>
            </div>
            <div class="item-price">PKR {{ number_format($item->price * $item->quantity, 0) }}</div>
        </div>
        @endforeach
        @php
            $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
            $shipping = $order->total_amount - $subtotal;
        @endphp
        <div style="padding-top:1rem">
            <div class="totals-row"><span>Subtotal</span><span>PKR {{ number_format($subtotal, 0) }}</span></div>
            <div class="totals-row"><span>Shipping</span><span>{{ $shipping > 0 ? 'PKR '.number_format($shipping,0) : 'FREE' }}</span></div>
            <div class="totals-row total"><span>Total Paid</span><span>PKR {{ number_format($order->total_amount, 0) }}</span></div>
        </div>
    </div>

    <!-- SHIPPING INFO -->
    <div class="order-card">
        <div class="order-card-title"><i class="fas fa-truck" style="color:var(--gold);margin-right:0.5rem"></i>Shipping Details</div>
        <div class="shipping-grid">
            <div class="shipping-item"><div class="label">Name</div><div class="value">{{ $order->shipping_name }}</div></div>
            <div class="shipping-item"><div class="label">Email</div><div class="value">{{ $order->shipping_email }}</div></div>
            <div class="shipping-item"><div class="label">Phone</div><div class="value">{{ $order->shipping_phone }}</div></div>
            <div class="shipping-item"><div class="label">Payment</div><div class="value">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</div></div>
            <div class="shipping-item" style="grid-column:1/-1"><div class="label">Address</div><div class="value">{{ $order->shipping_address }}</div></div>
        </div>
    </div>

    <p style="color:var(--text-muted);font-size:0.85rem;margin-bottom:2rem">
        <i class="fas fa-envelope" style="color:var(--gold)"></i>
        A confirmation has been sent to <strong>{{ $order->shipping_email }}</strong>
    </p>

    <div class="action-buttons">
        <a href="{{ route('products.index') }}" class="btn-primary"><i class="fas fa-shopping-bag" style="margin-right:0.4rem"></i>Continue Shopping</a>
        <a href="{{ route('home') }}" class="btn-outline">← Back to Home</a>
    </div>
</div>
<div style="margin-bottom:5rem"></div>
@endsection
