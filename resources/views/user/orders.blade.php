@extends('layouts.app')
@section('title', 'My Orders - LuxeStore')

@section('head_styles')
<style>
    .page-hero { background:var(--dark); padding:4rem 5% 3rem; }
    .page-hero h1 { font-family:'Playfair Display',serif; font-size:2.5rem; color:white; font-weight:900; }
    .page-hero h1 em { color:var(--gold); font-style:italic; }
    .breadcrumb { color:rgba(255,255,255,0.4); font-size:0.85rem; margin-bottom:1rem; }
    .breadcrumb a { color:var(--gold); text-decoration:none; }

    .orders-page { padding:3rem 5%; max-width:1000px; margin:0 auto; }

    .order-card {
        background:var(--white);
        border:1px solid var(--cream-2);
        border-radius:8px;
        margin-bottom:1.5rem;
        overflow:hidden;
        transition:box-shadow 0.2s;
    }
    .order-card:hover { box-shadow:var(--shadow); }
    .order-header {
        padding:1.2rem 1.8rem;
        display:flex; justify-content:space-between; align-items:center;
        flex-wrap:wrap; gap:0.8rem;
        background:var(--cream);
        border-bottom:1px solid var(--cream-2);
    }
    .order-id { font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--dark); }
    .order-date { color:var(--text-muted); font-size:0.85rem; }
    .order-body { padding:1.5rem 1.8rem; }
    .order-items-list { display:flex; flex-direction:column; gap:0.8rem; }
    .order-item-row { display:flex; align-items:center; gap:1rem; font-size:0.9rem; }
    .item-dot { width:8px; height:8px; background:var(--gold); border-radius:50%; flex-shrink:0; }
    .item-name { flex:1; color:var(--text); font-weight:500; }
    .item-qty { color:var(--text-muted); }
    .item-subtotal { font-weight:700; color:var(--dark); }
    .order-footer {
        padding:1rem 1.8rem;
        border-top:1px solid var(--cream-2);
        display:flex; justify-content:space-between; align-items:center;
        flex-wrap:wrap; gap:1rem;
    }
    .order-total { font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:700; color:var(--dark); }
    .badge-status { padding:0.35rem 0.9rem; border-radius:20px; font-size:0.78rem; font-weight:600; }
    .badge-pending    { background:#fff3cd; color:#856404; }
    .badge-processing { background:#cce5ff; color:#004085; }
    .badge-shipped    { background:#d1ecf1; color:#0c5460; }
    .badge-completed  { background:#d4edda; color:#155724; }
    .badge-cancelled  { background:#f8d7da; color:#721c24; }

    .empty-state { text-align:center; padding:5rem 1rem; }
    .empty-icon { font-size:4rem; color:var(--gold); opacity:0.3; margin-bottom:1.5rem; }
    .empty-state h3 { font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--dark); }
    .empty-state p { color:var(--text-muted); margin:0.5rem 0 2rem; }
    .btn-shop { background:var(--dark); color:var(--gold); border:2px solid var(--gold); padding:0.8rem 2rem; font-weight:700; font-size:0.9rem; text-transform:uppercase; letter-spacing:0.5px; border-radius:4px; text-decoration:none; display:inline-block; transition:all 0.2s; }
    .btn-shop:hover { background:var(--gold); color:var(--dark); }
</style>
@endsection

@section('content')
<div class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> / My Orders</div>
    <h1>My <em>Orders</em></h1>
</div>

<div class="orders-page">
    @if($orders->isEmpty())
    <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
        <h3>No Orders Yet</h3>
        <p>You haven't placed any orders. Start shopping!</p>
        <a href="{{ route('products.index') }}" class="btn-shop">Browse Products</a>
    </div>
    @else
    <p style="color:var(--text-muted);margin-bottom:2rem;font-size:0.9rem">{{ $orders->count() }} order(s) found</p>

    @foreach($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-id">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="order-date"><i class="fas fa-calendar" style="color:var(--gold)"></i> {{ $order->created_at->format('F d, Y') }}</div>
            </div>
            <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap">
                <span style="font-size:0.85rem;color:var(--text-muted)">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</span>
                <span class="badge-status badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
        </div>

        <div class="order-body">
            <div class="order-items-list">
                @foreach($order->items as $item)
                <div class="order-item-row">
                    <div class="item-dot"></div>
                    <div class="item-name">{{ $item->product->name ?? 'Product Unavailable' }}</div>
                    <div class="item-qty">× {{ $item->quantity }}</div>
                    <div class="item-subtotal">PKR {{ number_format($item->price * $item->quantity, 0) }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="order-footer">
            <div>
                <div style="font-size:0.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px">Total Paid</div>
                <div class="order-total">PKR {{ number_format($order->total_amount, 0) }}</div>
            </div>
            <div style="font-size:0.85rem;color:var(--text-muted)">
                <i class="fas fa-map-marker-alt" style="color:var(--gold)"></i>
                {{ $order->shipping_address }}
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
