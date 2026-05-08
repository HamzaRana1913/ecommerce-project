@extends('layouts.app')
@section('title', ($product->name ?? 'Product') . ' - LuxeStore')

@section('head_styles')
<style>
    .product-page { padding: 3rem 5%; max-width: 1200px; margin: 0 auto; }
    .breadcrumb { color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2rem; }
    .breadcrumb a { color: var(--gold); text-decoration: none; }
    .product-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: start;
    }
    /* IMAGE GALLERY */
    .img-main {
        background: var(--cream);
        border-radius: 4px;
        height: 500px;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
        position: relative;
        border: 1px solid var(--cream-2);
    }
    .img-main img { width: 100%; height: 100%; object-fit: cover; }
    .img-placeholder { font-size: 8rem; color: var(--gold); opacity: 0.2; }
    .img-thumbs { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.8rem; margin-top: 1rem; }
    .img-thumb {
        background: var(--cream);
        border-radius: 2px;
        height: 80px;
        display: flex; align-items: center; justify-content: center;
        border: 2px solid transparent;
        cursor: pointer;
        transition: border-color 0.2s;
        overflow: hidden;
    }
    .img-thumb.active { border-color: var(--gold); }
    .img-thumb img { width: 100%; height: 100%; object-fit: cover; }

    /* PRODUCT DETAILS */
    .product-category { color: var(--gold); font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; }
    .product-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.2;
        margin: 0.8rem 0;
    }
    .product-rating { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; }
    .stars { color: var(--gold); font-size: 1rem; }
    .rating-text { color: var(--text-muted); font-size: 0.85rem; }
    .product-price-box {
        background: var(--cream);
        border-radius: 4px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--gold);
    }
    .price-main { font-size: 2rem; font-weight: 800; color: var(--dark); font-family: 'Playfair Display', serif; }
    .price-main span { color: var(--gold); font-size: 1.2rem; }
    .price-note { color: var(--text-muted); font-size: 0.8rem; margin-top: 0.3rem; }
    .product-description { color: var(--text-muted); line-height: 1.8; font-size: 0.95rem; margin-bottom: 2rem; }

    /* QUANTITY + ADD TO CART */
    .add-to-cart-form { display: flex; gap: 1rem; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; }
    .qty-control {
        display: flex;
        align-items: center;
        border: 1px solid var(--cream-2);
        border-radius: 2px;
        overflow: hidden;
        background: var(--white);
    }
    .qty-btn {
        width: 40px; height: 48px;
        border: none; background: none;
        cursor: pointer; font-size: 1.1rem; color: var(--text);
        transition: background 0.2s;
    }
    .qty-btn:hover { background: var(--cream); }
    .qty-input {
        width: 60px; height: 48px;
        border: none; border-left: 1px solid var(--cream-2); border-right: 1px solid var(--cream-2);
        text-align: center; font-size: 1rem; color: var(--dark); font-weight: 600;
    }
    .btn-add-cart {
        flex: 1;
        background: var(--dark);
        color: var(--gold);
        border: 2px solid var(--gold);
        padding: 0 2rem;
        height: 48px;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 2px;
        transition: all 0.2s;
    }
    .btn-add-cart:hover { background: var(--gold); color: var(--dark); }
    .btn-buy-now {
        flex: 1;
        background: var(--gold);
        color: var(--dark);
        border: none;
        padding: 0 2rem;
        height: 48px;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 2px;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .btn-buy-now:hover { background: var(--gold-light); }

    /* META */
    .product-meta { border-top: 1px solid var(--cream-2); padding-top: 1.5rem; }
    .meta-row { display: flex; gap: 1rem; margin-bottom: 0.7rem; font-size: 0.9rem; }
    .meta-label { color: var(--text-muted); min-width: 100px; }
    .meta-value { color: var(--dark); font-weight: 500; }
    .stock-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;
    }
    .in-stock { background: #d4edda; color: #155724; }
    .out-stock { background: #f8d7da; color: #721c24; }

    /* TABS */
    .tabs-section { margin-top: 5rem; }
    .tabs-nav { display: flex; border-bottom: 2px solid var(--cream-2); margin-bottom: 2rem; gap: 0; }
    .tab-btn {
        padding: 1rem 2rem;
        border: none; background: none;
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        color: var(--text-muted);
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s;
        font-weight: 600;
    }
    .tab-btn.active { color: var(--dark); border-bottom-color: var(--gold); }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .tab-content p { color: var(--text-muted); line-height: 1.8; }

    @media (max-width: 768px) {
        .product-layout { grid-template-columns: 1fr; gap: 2rem; }
        .product-title { font-size: 1.8rem; }
    }
</style>
@endsection

@section('content')
<div class="product-page">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a> /
        <a href="{{ route('products.index') }}">Products</a> /
        {{ $product->name ?? 'Product Detail' }}
    </div>

    <div class="product-layout">
        <!-- IMAGES -->
        <div class="product-images">
            <div class="img-main">
                @if(isset($product) && $product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" id="mainImg">
                @else
                    <div class="img-placeholder"><i class="fas fa-gem"></i></div>
                @endif
            </div>
            <div class="img-thumbs">
                @for($i = 0; $i < 4; $i++)
                <div class="img-thumb {{ $i == 0 ? 'active' : '' }}">
                    <div style="font-size:1.5rem;color:var(--gold);opacity:0.4"><i class="fas fa-gem"></i></div>
                </div>
                @endfor
            </div>
        </div>

        <!-- DETAILS -->
        <div class="product-details">
            <div class="product-category">{{ $product->category ?? 'Premium Collection' }}</div>
            <h1 class="product-title">{{ $product->name ?? 'Premium Luxury Item' }}</h1>

            <div class="product-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">(4.9) • 128 Reviews</span>
            </div>

            <div class="product-price-box">
                <div class="price-main"><span>PKR </span>{{ number_format($product->price ?? 9999, 0) }}</div>
                <div class="price-note">Inclusive of all taxes • Free delivery on orders over PKR 2,000</div>
            </div>

            <p class="product-description">
                {{ $product->description ?? 'Experience luxury like never before with this premium product. Crafted with the finest materials and meticulous attention to detail, this item represents the pinnacle of quality and style. Perfect for those who appreciate the finer things in life.' }}
            </p>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id ?? 1 }}">
                <div class="add-to-cart-form">
                    <div class="qty-control">
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                        <input type="number" class="qty-input" name="quantity" value="1" min="1" max="99" id="qtyInput">
                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                    <button type="submit" class="btn-add-cart"><i class="fas fa-shopping-bag"></i> Add to Cart</button>
                    <a href="{{ route('checkout.index') }}" class="btn-buy-now">Buy Now →</a>
                </div>
            </form>

            <div class="product-meta">
                <div class="meta-row">
                    <span class="meta-label">Availability</span>
                    <span class="meta-value">
                        <span class="stock-badge {{ ($product->stock ?? 10) > 0 ? 'in-stock' : 'out-stock' }}">
                            <i class="fas fa-circle" style="font-size:0.5rem"></i>
                            {{ ($product->stock ?? 10) > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Category</span>
                    <span class="meta-value">{{ $product->category ?? 'Premium' }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">SKU</span>
                    <span class="meta-value">LS-{{ str_pad($product->id ?? 1, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Delivery</span>
                    <span class="meta-value">2-5 Business Days</span>
                </div>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <div class="tabs-section">
        <div class="tabs-nav">
            <button class="tab-btn active" onclick="showTab('description', this)">Description</button>
            <button class="tab-btn" onclick="showTab('specs', this)">Specifications</button>
            <button class="tab-btn" onclick="showTab('reviews', this)">Reviews (128)</button>
        </div>
        <div id="tab-description" class="tab-content active">
            <p>{{ $product->description ?? 'This premium product is crafted with the highest quality materials, ensuring durability and style. Whether for personal use or as a gift, it is sure to impress. Our commitment to quality means every product is thoroughly inspected before delivery.' }}</p>
        </div>
        <div id="tab-specs" class="tab-content">
            <table style="width:100%;border-collapse:collapse;font-size:0.9rem;">
                <tr style="border-bottom:1px solid var(--cream-2)"><td style="padding:0.8rem;color:var(--text-muted);width:200px">Weight</td><td style="padding:0.8rem">500g</td></tr>
                <tr style="border-bottom:1px solid var(--cream-2)"><td style="padding:0.8rem;color:var(--text-muted)">Material</td><td style="padding:0.8rem">Premium Grade</td></tr>
                <tr style="border-bottom:1px solid var(--cream-2)"><td style="padding:0.8rem;color:var(--text-muted)">Dimensions</td><td style="padding:0.8rem">25 × 15 × 10 cm</td></tr>
                <tr><td style="padding:0.8rem;color:var(--text-muted)">Warranty</td><td style="padding:0.8rem">1 Year</td></tr>
            </table>
        </div>
        <div id="tab-reviews" class="tab-content">
            @for($i = 1; $i <= 3; $i++)
            <div style="padding:1.5rem 0;border-bottom:1px solid var(--cream-2)">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem">
                    <div>
                        <strong style="color:var(--dark)">Customer {{ $i }}</strong>
                        <span style="color:var(--gold);margin-left:0.5rem">★★★★★</span>
                    </div>
                    <span style="color:var(--text-muted);font-size:0.8rem">{{ now()->subDays($i * 3)->format('M d, Y') }}</span>
                </div>
                <p style="color:var(--text-muted);font-size:0.9rem;line-height:1.7">Excellent product! Exactly as described. The quality is outstanding and delivery was prompt. Highly recommend LuxeStore for premium shopping.</p>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qtyInput');
    const val = parseInt(input.value) + delta;
    if (val >= 1 && val <= 99) input.value = val;
}
function showTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}
document.querySelectorAll('.img-thumb').forEach((thumb, i) => {
    thumb.addEventListener('click', () => {
        document.querySelectorAll('.img-thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    });
});
</script>
@endsection
