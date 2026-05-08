@extends('layouts.app')
@section('title', 'Checkout - LuxeStore')

@section('head_styles')
<style>
    .checkout-page { padding: 3rem 5%; max-width: 1200px; margin: 0 auto; }
    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }
    .page-title em { color: var(--gold); font-style: italic; }
    .checkout-layout { display: grid; grid-template-columns: 1fr 400px; gap: 3rem; margin-top: 2.5rem; }

    /* FORM CARD */
    .checkout-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 4px;
        padding: 2.5rem;
        margin-bottom: 1.5rem;
    }
    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        color: var(--dark);
        margin-bottom: 2rem;
        display: flex; align-items: center; gap: 0.8rem;
    }
    .card-title-num {
        width: 32px; height: 32px;
        background: var(--gold);
        color: var(--dark);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem; font-weight: 700;
        font-family: 'DM Sans', sans-serif;
    }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
    .form-full { grid-column: 1/-1; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-group label { font-size: 0.82rem; font-weight: 600; color: var(--text); text-transform: uppercase; letter-spacing: 0.5px; }
    .form-group input, .form-group select, .form-group textarea {
        border: 1.5px solid var(--cream-2);
        border-radius: 2px;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        color: var(--text);
        background: var(--cream);
        transition: border-color 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none;
        border-color: var(--gold);
        background: var(--white);
    }
    .form-group textarea { resize: vertical; min-height: 90px; }

    /* PAYMENT METHODS */
    .payment-options { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    .payment-option {
        border: 2px solid var(--cream-2);
        border-radius: 4px;
        padding: 1.2rem;
        cursor: pointer;
        text-align: center;
        transition: all 0.2s;
        position: relative;
    }
    .payment-option input { position: absolute; opacity: 0; }
    .payment-option.selected { border-color: var(--gold); background: rgba(201,168,76,0.05); }
    .payment-icon { font-size: 1.8rem; margin-bottom: 0.5rem; }
    .payment-label { font-size: 0.8rem; font-weight: 600; color: var(--text); }

    /* ORDER SUMMARY */
    .summary-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 4px;
        padding: 2rem;
        position: sticky;
        top: 90px;
    }
    .summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--gold);
        color: var(--dark);
    }
    .cart-items { max-height: 300px; overflow-y: auto; margin-bottom: 1.5rem; }
    .cart-item {
        display: flex; gap: 1rem; align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid var(--cream-2);
    }
    .cart-item-img {
        width: 60px; height: 60px;
        background: var(--cream);
        border-radius: 2px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: var(--gold); opacity: 0.5;
        flex-shrink: 0; overflow: hidden;
    }
    .cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .cart-item-info { flex: 1; }
    .cart-item-name { font-size: 0.9rem; font-weight: 600; color: var(--dark); }
    .cart-item-qty { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.2rem; }
    .cart-item-price { font-weight: 700; font-size: 0.95rem; color: var(--dark); }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 0.8rem; font-size: 0.9rem; }
    .summary-row.total { font-size: 1.2rem; font-weight: 700; color: var(--dark); padding-top: 1rem; border-top: 2px solid var(--dark); margin-top: 0.5rem; font-family: 'Playfair Display', serif; }
    .summary-row .label { color: var(--text-muted); }
    .summary-row .value { color: var(--dark); font-weight: 600; }

    .btn-place-order {
        width: 100%;
        background: var(--dark);
        color: var(--gold);
        border: 2px solid var(--gold);
        padding: 1.1rem;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 2px;
        transition: all 0.2s;
        margin-top: 1.5rem;
    }
    .btn-place-order:hover { background: var(--gold); color: var(--dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.3); }
    .secure-note { text-align: center; color: var(--text-muted); font-size: 0.8rem; margin-top: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem; }

    @media (max-width: 900px) {
        .checkout-layout { grid-template-columns: 1fr; }
        .form-grid { grid-template-columns: 1fr; }
        .payment-options { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="checkout-page">
    <div class="breadcrumb" style="color:var(--text-muted);font-size:0.85rem;margin-bottom:1rem;">
        <a href="{{ route('home') }}" style="color:var(--gold);text-decoration:none">Home</a> /
        <a href="{{ route('products.index') }}" style="color:var(--gold);text-decoration:none">Products</a> / Checkout
    </div>
    <h1 class="page-title">Your <em>Cart</em> & Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="checkout-layout">
            <div class="checkout-left">
                <!-- SHIPPING INFO -->
                <div class="checkout-card">
                    <div class="card-title">
                        <span class="card-title-num">1</span>
                        Shipping Information
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="{{ auth()->user()->name ?? '' }}" required placeholder="John">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" required placeholder="Doe">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required placeholder="john@example.com">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" required placeholder="+92 300 0000000">
                        </div>
                        <div class="form-group form-full">
                            <label>Street Address</label>
                            <input type="text" name="address" required placeholder="House No., Street Name">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" required placeholder="Karachi">
                        </div>
                        <div class="form-group">
                            <label>Province</label>
                            <select name="province">
                                <option value="sindh">Sindh</option>
                                <option value="punjab">Punjab</option>
                                <option value="kpk">KPK</option>
                                <option value="balochistan">Balochistan</option>
                            </select>
                        </div>
                        <div class="form-group form-full">
                            <label>Order Notes (Optional)</label>
                            <textarea name="notes" placeholder="Any special instructions..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- PAYMENT METHOD -->
                <div class="checkout-card">
                    <div class="card-title">
                        <span class="card-title-num">2</span>
                        Payment Method
                    </div>
                    <div class="payment-options">
                        <label class="payment-option selected" id="pm-cod">
                            <input type="radio" name="payment_method" value="cod" checked>
                            <div class="payment-icon">💵</div>
                            <div class="payment-label">Cash on Delivery</div>
                        </label>
                        <label class="payment-option" id="pm-bank">
                            <input type="radio" name="payment_method" value="bank_transfer">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-label">Bank Transfer</div>
                        </label>
                        <label class="payment-option" id="pm-easypaisa">
                            <input type="radio" name="payment_method" value="easypaisa">
                            <div class="payment-icon">📱</div>
                            <div class="payment-label">EasyPaisa</div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- ORDER SUMMARY -->
            <div class="checkout-right">
                <div class="summary-card">
                    <div class="summary-title">Order Summary</div>
                    <div class="cart-items" id="cartItemsList">
                        @php $cart = session('cart', []); $subtotal = 0; @endphp
                        @forelse($cart as $item)
                        @php $subtotal += $item['price'] * $item['quantity']; @endphp
                        <div class="cart-item">
                            <div class="cart-item-img">
                                @if(isset($item['image']))
                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="">
                                @else
                                    <i class="fas fa-gem"></i>
                                @endif
                            </div>
                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $item['name'] }}</div>
                                <div class="cart-item-qty">Qty: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="cart-item-price">PKR {{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                        </div>
                        @empty
                        <div style="text-align:center;padding:2rem;color:var(--text-muted)">
                            <i class="fas fa-shopping-bag" style="font-size:2rem;color:var(--gold);opacity:0.3"></i>
                            <p style="margin-top:0.5rem;font-size:0.9rem">Your cart is empty</p>
                            <a href="{{ route('products.index') }}" style="color:var(--gold);font-size:0.85rem">Browse Products →</a>
                        </div>
                        @endforelse
                    </div>

                    @php $shipping = $subtotal > 2000 ? 0 : 200; $total = $subtotal + $shipping; @endphp
                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value">PKR {{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Shipping</span>
                        <span class="value" style="{{ $shipping == 0 ? 'color:#28a745' : '' }}">
                            {{ $shipping == 0 ? 'FREE' : 'PKR ' . number_format($shipping, 0) }}
                        </span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>PKR {{ number_format($total, 0) }}</span>
                    </div>
                    <input type="hidden" name="total_amount" value="{{ $total }}">
                    <button type="submit" class="btn-place-order">
                        <i class="fas fa-lock" style="margin-right:0.5rem"></i>
                        Place Order
                    </button>
                    <div class="secure-note"><i class="fas fa-shield-alt"></i> 100% Secure Checkout</div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.payment-option').forEach(opt => {
    opt.addEventListener('click', function() {
        document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
        this.classList.add('selected');
    });
});
</script>
@endsection
