@extends('layouts.app')
@section('title', 'LuxeStore - Premium Shopping Experience')

@section('head_styles')
<style>
    /* HERO */
    .hero {
        min-height: 90vh;
        background: var(--dark);
        display: grid;
        grid-template-columns: 1fr 1fr;
        overflow: hidden;
        position: relative;
    }
    .hero-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 6rem 5% 6rem 8%;
        z-index: 2;
    }
    .hero-tag {
        display: inline-block;
        background: rgba(201,168,76,0.15);
        color: var(--gold);
        border: 1px solid rgba(201,168,76,0.3);
        padding: 0.4rem 1rem;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 2rem;
        border-radius: 2px;
    }
    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3rem, 6vw, 5rem);
        font-weight: 900;
        color: var(--white);
        line-height: 1.05;
        margin-bottom: 1.5rem;
    }
    .hero h1 em {
        font-style: italic;
        color: var(--gold);
    }
    .hero p {
        color: rgba(255,255,255,0.6);
        font-size: 1.1rem;
        line-height: 1.8;
        max-width: 420px;
        margin-bottom: 2.5rem;
    }
    .hero-btns { display: flex; gap: 1rem; flex-wrap: wrap; }
    .btn-primary {
        background: var(--gold);
        color: var(--dark);
        padding: 1rem 2.2rem;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.2s;
        border-radius: 2px;
        display: inline-block;
    }
    .btn-primary:hover { background: var(--gold-light); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(201,168,76,0.3); }
    .btn-outline {
        border: 1px solid rgba(255,255,255,0.3);
        color: var(--white);
        padding: 1rem 2.2rem;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.2s;
        border-radius: 2px;
        display: inline-block;
    }
    .btn-outline:hover { border-color: var(--gold); color: var(--gold); }
    .hero-visual {
        position: relative;
        overflow: hidden;
        background: var(--dark-2);
    }
    .hero-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(201,168,76,0.1) 0%, transparent 60%);
        z-index: 1;
    }
    .hero-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(201,168,76,0.05) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(201,168,76,0.05) 1px, transparent 1px);
        background-size: 60px 60px;
    }
    .hero-float-card {
        position: absolute;
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(201,168,76,0.2);
        border-radius: 8px;
        padding: 1.2rem 1.5rem;
        z-index: 2;
    }
    .hero-float-card.card-1 { bottom: 20%; left: 10%; }
    .hero-float-card.card-2 { top: 25%; right: 10%; }
    .hero-float-card .card-num {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--gold);
        font-weight: 700;
    }
    .hero-float-card .card-label { color: rgba(255,255,255,0.5); font-size: 0.8rem; }

    /* STATS BAR */
    .stats-bar {
        background: var(--white);
        padding: 2rem 5%;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        border-bottom: 1px solid var(--cream-2);
    }
    .stat-item { text-align: center; padding: 1rem; }
    .stat-item .num {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--dark);
    }
    .stat-item .num span { color: var(--gold); }
    .stat-item .label { color: var(--text-muted); font-size: 0.85rem; margin-top: 0.3rem; }

    /* SECTION */
    .section { padding: 6rem 5%; }
    .section-header { text-align: center; margin-bottom: 4rem; }
    .section-tag {
        color: var(--gold);
        font-size: 0.75rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 1rem;
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--dark);
        line-height: 1.2;
    }
    .section-title em { font-style: italic; color: var(--gold); }

    /* PRODUCT CARDS */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    .product-card {
        background: var(--white);
        border-radius: 4px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid var(--cream-2);
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .product-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .product-img {
        height: 260px;
        background: var(--cream);
        position: relative;
        overflow: hidden;
        display: flex; align-items: center; justify-content: center;
    }
    .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .product-card:hover .product-img img { transform: scale(1.05); }
    .product-img-placeholder {
        font-size: 4rem;
        color: var(--gold);
        opacity: 0.3;
    }
    .product-badge {
        position: absolute;
        top: 1rem; left: 1rem;
        background: var(--gold);
        color: var(--dark);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 0.3rem 0.7rem;
        border-radius: 2px;
    }
    .product-info { padding: 1.5rem; }
    .product-cat { color: var(--gold); font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 0.5rem; }
    .product-name { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 600; color: var(--dark); margin-bottom: 0.8rem; }
    .product-price { font-size: 1.2rem; font-weight: 700; color: var(--dark); }
    .product-price .currency { color: var(--gold); font-size: 0.9rem; }

    /* CATEGORIES */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    .cat-card {
        background: var(--dark);
        border-radius: 4px;
        padding: 2.5rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid rgba(201,168,76,0.1);
        text-decoration: none;
        display: block;
    }
    .cat-card:hover { background: var(--dark-2); border-color: var(--gold); transform: translateY(-4px); }
    .cat-icon { font-size: 2.5rem; margin-bottom: 1rem; }
    .cat-name { font-family: 'Playfair Display', serif; font-size: 1.2rem; color: var(--white); }
    .cat-count { color: var(--gold); font-size: 0.8rem; margin-top: 0.4rem; }

    /* CTA BANNER */
    .cta-banner {
        background: var(--dark);
        margin: 0 5%;
        border-radius: 8px;
        padding: 5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .cta-banner::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(ellipse at center, rgba(201,168,76,0.1) 0%, transparent 60%);
    }
    .cta-banner h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--white);
        margin-bottom: 1rem;
    }
    .cta-banner p { color: rgba(255,255,255,0.6); margin-bottom: 2rem; font-size: 1.1rem; }

    @media (max-width: 768px) {
        .hero { grid-template-columns: 1fr; }
        .hero-visual { display: none; }
        .stats-bar { grid-template-columns: repeat(2, 1fr); }
        .categories-grid { grid-template-columns: 1fr; }
        .cta-banner { padding: 3rem 2rem; margin: 0 4%; }
    }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <span class="hero-tag">✦ New Collection 2024</span>
        <h1>Shop with <em>Style</em> & Confidence</h1>
        <p>Discover curated premium products handpicked for quality and elegance. Elevate your lifestyle with LuxeStore.</p>
        <div class="hero-btns">
            <a href="{{ route('products.index') }}" class="btn-primary">Explore Products</a>
            <a href="{{ route('contact') }}" class="btn-outline">Get in Touch</a>
        </div>
    </div>
    <div class="hero-visual">
        <div class="hero-grid-pattern"></div>
        <div class="hero-float-card card-1">
            <div class="card-num">500+</div>
            <div class="card-label">Premium Products</div>
        </div>
        <div class="hero-float-card card-2">
            <div class="card-num">4.9★</div>
            <div class="card-label">Customer Rating</div>
        </div>
    </div>
</section>

<!-- STATS -->
<div class="stats-bar">
    <div class="stat-item"><div class="num">10<span>K+</span></div><div class="label">Happy Customers</div></div>
    <div class="stat-item"><div class="num">500<span>+</span></div><div class="label">Products Listed</div></div>
    <div class="stat-item"><div class="num">50<span>+</span></div><div class="label">Brands</div></div>
    <div class="stat-item"><div class="num">24<span>/7</span></div><div class="label">Support</div></div>
</div>

<!-- FEATURED PRODUCTS -->
<section class="section">
    <div class="section-header">
        <span class="section-tag">✦ Handpicked For You</span>
        <h2 class="section-title">Featured <em>Products</em></h2>
    </div>
    <div class="products-grid">
        @forelse($featured_products ?? [] as $product)
        <a href="{{ route('products.show', $product->id) }}" class="product-card">
            <div class="product-img">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="product-img-placeholder"><i class="fas fa-box-open"></i></div>
                @endif
                <span class="product-badge">New</span>
            </div>
            <div class="product-info">
                <div class="product-cat">{{ $product->category ?? 'Premium' }}</div>
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-price"><span class="currency">PKR </span>{{ number_format($product->price, 0) }}</div>
            </div>
        </a>
        @empty
        @for($i = 1; $i <= 4; $i++)
        <a href="{{ route('products.index') }}" class="product-card">
            <div class="product-img">
                <div class="product-img-placeholder"><i class="fas fa-gem"></i></div>
                <span class="product-badge">Featured</span>
            </div>
            <div class="product-info">
                <div class="product-cat">Premium Collection</div>
                <div class="product-name">Luxury Product {{ $i }}</div>
                <div class="product-price"><span class="currency">PKR </span>{{ number_format(rand(2000, 20000), 0) }}</div>
            </div>
        </a>
        @endfor
        @endforelse
    </div>
    <div style="text-align:center;margin-top:3rem;">
        <a href="{{ route('products.index') }}" class="btn-primary">View All Products</a>
    </div>
</section>

<!-- CATEGORIES -->
<section class="section" style="background:var(--cream-2);padding:5rem 5%;">
    <div class="section-header">
        <span class="section-tag">✦ Browse By Category</span>
        <h2 class="section-title">Shop <em>Categories</em></h2>
    </div>
    <div class="categories-grid">
        <a href="{{ route('products.index') }}?category=electronics" class="cat-card">
            <div class="cat-icon">⚡</div>
            <div class="cat-name">Electronics</div>
            <div class="cat-count">150+ items</div>
        </a>
        <a href="{{ route('products.index') }}?category=fashion" class="cat-card">
            <div class="cat-icon">👔</div>
            <div class="cat-name">Fashion</div>
            <div class="cat-count">200+ items</div>
        </a>
        <a href="{{ route('products.index') }}?category=home" class="cat-card">
            <div class="cat-icon">🏠</div>
            <div class="cat-name">Home & Living</div>
            <div class="cat-count">180+ items</div>
        </a>
    </div>
</section>

<!-- CTA BANNER -->
<div class="cta-banner">
    <h2>Ready to Start Shopping?</h2>
    <p>Join thousands of satisfied customers. Sign up today and get exclusive deals.</p>
    <a href="{{ route('register') }}" class="btn-primary">Create Account — It's Free</a>
</div>
<div style="margin-bottom:6rem;"></div>
@endsection
