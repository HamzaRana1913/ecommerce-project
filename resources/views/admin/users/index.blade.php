@extends('layouts.admin')
@section('title', 'Customers')
@section('page_title', 'All Customers')

@section('admin_content')
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-users" style="color:#9B59B6;margin-right:0.5rem"></i>Customers ({{ $users->count() }})</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Total Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.7rem">
                            <div style="width:36px;height:36px;background:rgba(201,168,76,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--gold);font-size:0.85rem;flex-shrink:0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <strong>{{ $user->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <strong>{{ $user->orders->count() }}</strong>
                        @if($user->orders->count() > 0)
                            <a href="{{ route('admin.orders.index') }}" style="color:var(--gold);font-size:0.75rem;margin-left:0.3rem">view →</a>
                        @endif
                    </td>
                    <td><strong>PKR {{ number_format($user->orders->sum('total_amount'), 0) }}</strong></td>
                    <td style="font-size:0.85rem;color:var(--text-muted)">{{ $user->created_at->format('M d, Y') }}</td>
                    <td><span class="badge-status badge-active"><i class="fas fa-circle" style="font-size:0.5rem;margin-right:0.3rem"></i>Active</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
