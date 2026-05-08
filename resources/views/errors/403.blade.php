@extends('layouts.app')
@section('title', '403 – Access Denied')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:3rem 1.5rem">
    <div>
        <div style="font-family:'Playfair Display',serif;font-size:8rem;font-weight:900;color:var(--gold);line-height:1;opacity:0.3">403</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:2rem;color:var(--dark);margin-bottom:1rem">Access Denied</h1>
        <p style="color:var(--text-muted);margin-bottom:2rem;max-width:400px">You don't have permission to view this page. Please log in with the correct account.</p>
        <a href="{{ route('home') }}" style="background:var(--dark);color:var(--gold);border:2px solid var(--gold);padding:0.8rem 2rem;font-weight:700;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;border-radius:4px;text-decoration:none;transition:all 0.2s">← Go Home</a>
    </div>
</div>
@endsection
