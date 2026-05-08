@extends('layouts.app')
@section('title', '404 – Page Not Found')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:3rem 1.5rem">
    <div>
        <div style="font-family:'Playfair Display',serif;font-size:8rem;font-weight:900;color:var(--gold);line-height:1;opacity:0.3">404</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:2rem;color:var(--dark);margin-bottom:1rem">Page Not Found</h1>
        <p style="color:var(--text-muted);margin-bottom:2rem;max-width:400px">The page you're looking for doesn't exist or has been moved.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('home') }}" style="background:var(--dark);color:var(--gold);border:2px solid var(--gold);padding:0.8rem 2rem;font-weight:700;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;border-radius:4px;text-decoration:none">← Go Home</a>
            <a href="{{ route('products.index') }}" style="background:var(--gold);color:var(--dark);border:2px solid var(--gold);padding:0.8rem 2rem;font-weight:700;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;border-radius:4px;text-decoration:none">Browse Products</a>
        </div>
    </div>
</div>
@endsection
