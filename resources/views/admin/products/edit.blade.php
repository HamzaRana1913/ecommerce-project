@extends('layouts.admin')
@section('title', 'Edit Product')
@section('page_title', 'Edit Product')

@section('admin_styles')
<style>
    .product-form-card { background:white; border-radius:8px; border:1px solid #E8E8F0; max-width:800px; }
    .form-section { padding:2rem; border-bottom:1px solid #E8E8F0; }
    .form-section:last-child { border-bottom:none; }
    .form-section-title { font-family:'Playfair Display',serif; font-size:1rem; color:var(--dark); margin-bottom:1.5rem; display:flex; align-items:center; gap:0.5rem; }
    .form-section-title i { color:var(--gold); }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; }
    .form-group { margin-bottom:1.2rem; }
    .form-group label { display:block; font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; color:var(--text); margin-bottom:0.5rem; }
    .form-group input, .form-group select, .form-group textarea { width:100%; border:1.5px solid #E8E8F0; border-radius:4px; padding:0.75rem 1rem; font-size:0.9rem; transition:border-color 0.2s; font-family:'DM Sans',sans-serif; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline:none; border-color:var(--gold); }
    .form-group textarea { min-height:120px; resize:vertical; }
    .img-preview { width:140px; height:140px; border:2px dashed #E8E8F0; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:2.5rem; color:var(--gold); opacity:0.5; overflow:hidden; margin-bottom:0.8rem; }
    .img-preview img { width:100%; height:100%; object-fit:cover; opacity:1; }
    .btn-save { background:var(--dark); color:var(--gold); border:2px solid var(--gold); padding:0.8rem 2rem; font-weight:700; font-size:0.9rem; letter-spacing:0.5px; text-transform:uppercase; cursor:pointer; border-radius:4px; transition:all 0.2s; margin-right:1rem; }
    .btn-save:hover { background:var(--gold); color:var(--dark); }
    .btn-cancel { background:#f8f9fa; color:var(--text-muted); border:1px solid #E8E8F0; padding:0.8rem 2rem; font-weight:600; font-size:0.9rem; cursor:pointer; border-radius:4px; text-decoration:none; display:inline-block; }
</style>
@endsection

@section('admin_content')
<div style="margin-bottom:1.5rem">
    <a href="{{ route('admin.products.index') }}" style="color:var(--gold);text-decoration:none;font-size:0.9rem"><i class="fas fa-arrow-left"></i> Back to Products</a>
</div>

<div class="product-form-card">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-section">
            <div class="form-section-title"><i class="fas fa-info-circle"></i> Basic Information</div>
            <div class="form-group">
                <label>Product Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')<span style="color:#dc3545;font-size:0.8rem">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="">Select Category</option>
                        @foreach(['electronics','fashion','home & living','beauty','sports','books'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ ucwords($cat) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Price (PKR) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="0.01">
                    @error('price')<span style="color:#dc3545;font-size:0.8rem">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group" style="max-width:200px">
                <label>Stock Quantity *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0">
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title"><i class="fas fa-image"></i> Product Image</div>
            <div class="img-preview" id="imgPreview">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" id="previewImg">
                @else
                    <i class="fas fa-image"></i>
                @endif
            </div>
            <div class="form-group">
                <label>Upload New Image (leave blank to keep current)</label>
                <input type="file" name="image" accept="image/*" id="imageInput">
            </div>
        </div>

        <div class="form-section" style="display:flex;align-items:center">
            <button type="submit" class="btn-save"><i class="fas fa-save" style="margin-right:0.4rem"></i>Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('admin_scripts')
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('imgPreview').innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover">';
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
