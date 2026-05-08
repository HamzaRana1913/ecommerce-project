@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')

@section('admin_content')
<!-- STAT CARDS -->
<div class="stats-row">
    <div class="stat-card gold">
        <div class="stat-icon"><i class="fas fa-box-open"></i></div>
        <div class="stat-value">{{ $stats['products'] ?? 0 }}</div>
        <div class="stat-label">Total Products</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 12% this month</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-value">{{ $stats['orders'] ?? 0 }}</div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 8% this week</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="stat-value">{{ number_format($stats['revenue'] ?? 0, 0) }}</div>
        <div class="stat-label">Revenue (PKR)</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 20% this month</div>
    </div>
    <div class="stat-card purple">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-value">{{ $stats['users'] ?? 0 }}</div>
        <div class="stat-label">Registered Users</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 5 new today</div>
    </div>
</div>

<!-- PRODUCTS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-box-open" style="color:var(--gold);margin-right:0.5rem"></i>Products</div>
        <a href="{{ route('admin.products.create') }}" class="btn-sm-gold"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="productsTable">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products ?? [] as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.8rem">
                            <div style="width:36px;height:36px;background:var(--cream);border-radius:4px;display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:0.9rem">
                                <i class="fas fa-gem"></i>
                            </div>
                            <strong>{{ $product->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $product->category ?? '—' }}</td>
                    <td><strong>PKR {{ number_format($product->price, 0) }}</strong></td>
                    <td>
                        <span style="color:{{ $product->stock < 5 ? '#dc3545' : '#28a745' }};font-weight:600">
                            {{ $product->stock ?? 0 }}
                        </span>
                    </td>
                    <td><span class="badge-status badge-active">Active</span></td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-sm-gold" style="margin-right:0.3rem"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ORDERS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-shopping-cart" style="color:#4A90E2;margin-right:0.5rem"></i>Recent Orders</div>
        <a href="{{ route('admin.orders.index') }}" class="btn-sm-gold">View All</a>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="ordersTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders ?? [] as $order)
                <tr>
                    <td><strong>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                    <td>{{ $order->items->count() ?? 0 }} items</td>
                    <td><strong>PKR {{ number_format($order->total_amount, 0) }}</strong></td>
                    <td>{{ ucfirst(str_replace('_',' ', $order->payment_method ?? 'cod')) }}</td>
                    <td>
                        <span class="badge-status badge-{{ $order->status ?? 'pending' }}">
                            {{ ucfirst($order->status ?? 'Pending') }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm-gold"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ORDER ITEMS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-list" style="color:#27AE60;margin-right:0.5rem"></i>Order Items</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="orderItemsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems ?? [] as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ route('admin.orders.show', $item->order_id) }}" style="color:var(--gold)">#{{ str_pad($item->order_id, 5, '0', STR_PAD_LEFT) }}</a></td>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>PKR {{ number_format($item->price, 0) }}</td>
                    <td><strong>PKR {{ number_format($item->price * $item->quantity, 0) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- USERS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-users" style="color:#9B59B6;margin-right:0.5rem"></i>Customers</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users ?? [] as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.6rem">
                            <div style="width:32px;height:32px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:var(--gold)">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            {{ $user->name }}
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->orders->count() ?? 0 }}</td>
                    <td>PKR {{ number_format($user->orders->sum('total_amount') ?? 0, 0) }}</td>
                    <td>{{ $user->created_at->format('M d, Y') ?? '—' }}</td>
                    <td>
                        <span class="badge-status {{ $user->is_admin ? 'badge-admin' : 'badge-active' }}">
                            {{ $user->is_admin ? 'Admin' : 'Customer' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ADMINS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-user-shield" style="color:var(--gold);margin-right:0.5rem"></i>Administrators</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="adminsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins ?? [] as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.6rem">
                            <div style="width:32px;height:32px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:var(--gold)">
                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                            </div>
                            <strong>{{ $admin->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->format('M d, Y') ?? '—' }}</td>
                    <td><span class="badge-status badge-admin"><i class="fas fa-shield-alt"></i> Admin</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
