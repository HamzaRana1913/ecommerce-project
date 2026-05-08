@extends('layouts.admin')
@section('title', 'Orders')
@section('page_title', 'All Orders')

@section('admin_content')
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-shopping-cart" style="color:#4A90E2;margin-right:0.5rem"></i>Orders ({{ $orders->count() }})</div>
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap">
            @php
                $statuses = ['pending','processing','shipped','completed','cancelled'];
                $counts = $orders->groupBy('status')->map->count();
            @endphp
            @foreach($statuses as $s)
            <span class="badge-status badge-{{ $s }}" style="font-size:0.75rem">
                {{ ucfirst($s) }}: {{ $counts[$s] ?? 0 }}
            </span>
            @endforeach
        </div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="ordersTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong style="color:var(--gold)">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                    <td>
                        <div style="font-weight:600">{{ $order->shipping_name }}</div>
                        <div style="font-size:0.78rem;color:var(--text-muted)">{{ $order->user->name ?? 'Guest' }}</div>
                    </td>
                    <td style="font-size:0.82rem">
                        <div>{{ $order->shipping_email }}</div>
                        <div style="color:var(--text-muted)">{{ $order->shipping_phone }}</div>
                    </td>
                    <td>{{ $order->items->count() }} item(s)</td>
                    <td><strong>PKR {{ number_format($order->total_amount, 0) }}</strong></td>
                    <td style="font-size:0.85rem">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</td>
                    <td>
                        <span class="badge-status badge-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td style="font-size:0.82rem;color:var(--text-muted)">{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm-gold"><i class="fas fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
