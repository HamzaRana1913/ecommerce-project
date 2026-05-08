@extends('layouts.admin')
@section('title', 'Order Items')
@section('page_title', 'All Order Items')

@section('admin_content')
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-list" style="color:#27AE60;margin-right:0.5rem"></i>Order Items ({{ $orderItems->count() }})</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="orderItemsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $item->order_id) }}" style="color:var(--gold);font-weight:700;text-decoration:none">
                            #{{ str_pad($item->order_id, 5, '0', STR_PAD_LEFT) }}
                        </a>
                    </td>
                    <td>{{ $item->order->user->name ?? 'N/A' }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.6rem">
                            <div style="width:32px;height:32px;background:var(--cream);border-radius:4px;overflow:hidden;display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:0.8rem">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" style="width:100%;height:100%;object-fit:cover">
                                @else
                                    <i class="fas fa-gem" style="opacity:0.4"></i>
                                @endif
                            </div>
                            {{ $item->product->name ?? '<em style="color:var(--text-muted)">Deleted</em>' }}
                        </div>
                    </td>
                    <td><strong>{{ $item->quantity }}</strong></td>
                    <td>PKR {{ number_format($item->price, 0) }}</td>
                    <td><strong>PKR {{ number_format($item->price * $item->quantity, 0) }}</strong></td>
                    <td style="font-size:0.82rem;color:var(--text-muted)">{{ $item->created_at->format('M d, Y') }}</td>
                    <td>
                        <span class="badge-status badge-{{ $item->order->status ?? 'pending' }}">
                            {{ ucfirst($item->order->status ?? 'pending') }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
