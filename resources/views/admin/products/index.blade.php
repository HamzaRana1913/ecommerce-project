@extends('layouts.admin')
@section('title', 'Products')
@section('page_title', 'All Products')

@section('admin_content')
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-box-open" style="color:var(--gold);margin-right:0.5rem"></i>Products ({{ $products->count() }})</div>
        <a href="{{ route('admin.products.create') }}" class="btn-sm-gold"><i class="fas fa-plus"></i> Add New Product</a>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="productsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.8rem">
                            <div style="width:42px;height:42px;background:var(--cream);border-radius:4px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--gold)">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" style="width:100%;height:100%;object-fit:cover">
                                @else
                                    <i class="fas fa-gem" style="opacity:0.4"></i>
                                @endif
                            </div>
                            <div>
                                <strong>{{ $product->name }}</strong>
                                @if($product->description)
                                <div style="font-size:0.78rem;color:var(--text-muted);margin-top:2px">{{ Str::limit($product->description, 50) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($product->category)
                            <span class="badge bg-secondary">{{ ucfirst($product->category) }}</span>
                        @else
                            <span style="color:var(--text-muted)">—</span>
                        @endif
                    </td>
                    <td><strong>PKR {{ number_format($product->price, 0) }}</strong></td>
                    <td>
                        <span style="font-weight:600;color:{{ $product->stock < 5 ? '#dc3545' : ($product->stock < 20 ? '#ffc107' : '#28a745') }}">
                            {{ $product->stock }}
                        </span>
                        @if($product->stock == 0)
                            <span class="badge bg-danger ms-1" style="font-size:0.7rem">Out</span>
                        @elseif($product->stock < 5)
                            <span class="badge bg-warning ms-1" style="font-size:0.7rem">Low</span>
                        @endif
                    </td>
                    <td style="font-size:0.85rem;color:var(--text-muted)">{{ $product->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex;gap:0.3rem">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-sm-gold" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete \'{{ addslashes($product->name) }}\'?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
