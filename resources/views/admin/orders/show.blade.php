@extends('layouts.admin')
@section('title', 'Order #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))
@section('page_title', 'Order #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('admin_styles')
<style>
    .order-grid { display: grid; grid-template-columns: 1fr 360px; gap: 2rem; }
    .info-card { background: white; border-radius: 8px; border: 1px solid #E8E8F0; margin-bottom: 1.5rem; }
    .info-card-header { padding: 1.2rem 1.5rem; border-bottom: 1px solid #E8E8F0; display: flex; justify-content: space-between; align-items: center; }
    .info-card-title { font-family: 'Playfair Display', serif; font-size: 1rem; color: var(--dark); font-weight: 700; }
    .info-card-body { padding: 1.5rem; }
    .order-item-row { display: flex; align-items: center; gap: 1rem; padding: 0.8rem 0; border-bottom: 1px solid #F5F5F5; }
    .order-item-row:last-child { border-bottom: none; }
    .item-img { width: 50px; height: 50px; background: var(--cream); border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .item-img img { width: 100%; height: 100%; object-fit: cover; }
    .item-name { font-weight: 600; font-size: 0.9rem; }
    .item-qty { color: var(--text-muted); font-size: 0.82rem; }
    .item-price { margin-left: auto; font-weight: 700; }
    .totals-row { display: flex; justify-content: space-between; padding: 0.5rem 0; font-size: 0.9rem; }
    .totals-row.grand { font-size: 1.1rem; font-weight: 700; border-top: 2px solid var(--dark); padding-top: 0.8rem; margin-top: 0.3rem; font-family: 'Playfair Display', serif; }
    .detail-row { display: flex; gap: 1rem; padding: 0.6rem 0; font-size: 0.9rem; border-bottom: 1px solid #F5F5F5; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { color: var(--text-muted); min-width: 130px; }
    .detail-value { color: var(--dark); font-weight: 500; }
    @media(max-width:900px) { .order-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('admin_content')
<div style="margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
    <a href="{{ route('admin.orders.index') }}" style="color:var(--gold);text-decoration:none;font-size:0.9rem"><i class="fas fa-arrow-left"></i> Back to Orders</a>
    <span class="badge-status badge-{{ $order->status }}" style="font-size:0.9rem;padding:0.4rem 1rem">
        {{ ucfirst($order->status) }}
    </span>
</div>

<div class="order-grid">
    <!-- LEFT -->
    <div>
        <!-- Items -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title"><i class="fas fa-box-open" style="color:var(--gold);margin-right:0.5rem"></i>Order Items</div>
                <span style="font-size:0.85rem;color:var(--text-muted)">{{ $order->items->count() }} item(s)</span>
            </div>
            <div class="info-card-body">
                @foreach($order->items as $item)
                <div class="order-item-row">
                    <div class="item-img">
                        @if($item->product && $item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="">
                        @else
                            <i class="fas fa-gem" style="color:var(--gold);opacity:0.4"></i>
                        @endif
                    </div>
                    <div>
                        <div class="item-name">{{ $item->product->name ?? 'Deleted Product' }}</div>
                        <div class="item-qty">Qty: {{ $item->quantity }} × PKR {{ number_format($item->price, 0) }}</div>
                    </div>
                    <div class="item-price">PKR {{ number_format($item->price * $item->quantity, 0) }}</div>
                </div>
                @endforeach
                @php
                    $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
                    $shipping = $order->total_amount - $subtotal;
                @endphp
                <div style="padding-top:1rem;margin-top:0.5rem;border-top:1px solid #E8E8F0">
                    <div class="totals-row"><span style="color:var(--text-muted)">Subtotal</span><span>PKR {{ number_format($subtotal, 0) }}</span></div>
                    <div class="totals-row"><span style="color:var(--text-muted)">Shipping</span><span>{{ $shipping > 0 ? 'PKR '.number_format($shipping,0) : 'FREE' }}</span></div>
                    <div class="totals-row grand"><span>Total</span><span style="color:var(--gold)">PKR {{ number_format($order->total_amount, 0) }}</span></div>
                </div>
            </div>
        </div>

        <!-- Shipping -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title"><i class="fas fa-truck" style="color:var(--gold);margin-right:0.5rem"></i>Shipping Info</div>
            </div>
            <div class="info-card-body">
                <div class="detail-row"><span class="detail-label">Customer Name</span><span class="detail-value">{{ $order->shipping_name }}</span></div>
                <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">{{ $order->shipping_email }}</span></div>
                <div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">{{ $order->shipping_phone }}</span></div>
                <div class="detail-row"><span class="detail-label">Address</span><span class="detail-value">{{ $order->shipping_address }}</span></div>
                @if($order->notes)
                <div class="detail-row"><span class="detail-label">Notes</span><span class="detail-value">{{ $order->notes }}</span></div>
                @endif
            </div>
        </div>
    </div>

    <!-- RIGHT: STATUS + META -->
    <div>
        <!-- Update Status -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title"><i class="fas fa-edit" style="color:var(--gold);margin-right:0.5rem"></i>Update Status</div>
            </div>
            <div class="info-card-body">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div style="margin-bottom:1rem">
                        <label style="font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:0.5rem">Order Status</label>
                        <select name="status" style="width:100%;border:1.5px solid #E8E8F0;border-radius:4px;padding:0.75rem;font-size:0.9rem">
                            @foreach(['pending','processing','shipped','completed','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-sm-gold" style="width:100%;padding:0.7rem;text-align:center">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Meta -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title"><i class="fas fa-info-circle" style="color:var(--gold);margin-right:0.5rem"></i>Order Details</div>
            </div>
            <div class="info-card-body">
                <div class="detail-row"><span class="detail-label">Order ID</span><span class="detail-value" style="color:var(--gold);font-weight:700">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></div>
                <div class="detail-row"><span class="detail-label">Placed On</span><span class="detail-value">{{ $order->created_at->format('M d, Y H:i') }}</span></div>
                <div class="detail-row"><span class="detail-label">Payment</span><span class="detail-value">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</span></div>
                <div class="detail-row"><span class="detail-label">User Account</span><span class="detail-value">{{ $order->user->name ?? 'N/A' }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
