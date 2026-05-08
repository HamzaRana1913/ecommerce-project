@extends('layouts.app')
@section('title', 'Reset Password - LuxeStore')
@section('head_styles')
<style>
    .auth-page{min-height:80vh;display:flex;align-items:center;justify-content:center;padding:3rem 1rem;background:linear-gradient(135deg,var(--cream) 0%,var(--cream-2) 100%)}
    .auth-card{background:var(--white);border:1px solid var(--cream-2);border-radius:8px;width:100%;max-width:440px;overflow:hidden;box-shadow:var(--shadow-lg)}
    .auth-header{background:var(--dark);padding:2.5rem;text-align:center;border-bottom:2px solid var(--gold)}
    .auth-logo{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:900;color:var(--gold);text-decoration:none}
    .auth-logo span{color:white}
    .auth-body{padding:2.5rem}
    .form-group{margin-bottom:1.5rem}
    .form-group label{display:block;font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:var(--text);margin-bottom:0.5rem}
    .form-group input{width:100%;border:1.5px solid var(--cream-2);border-radius:4px;padding:0.85rem 1rem;font-size:0.95rem;background:var(--cream);font-family:'DM Sans',sans-serif;transition:all 0.2s}
    .form-group input:focus{outline:none;border-color:var(--gold);background:white}
    .btn-auth{width:100%;background:var(--dark);color:var(--gold);border:2px solid var(--gold);padding:0.95rem;font-weight:700;font-size:0.9rem;letter-spacing:1px;text-transform:uppercase;cursor:pointer;border-radius:4px;transition:all 0.2s;font-family:'DM Sans',sans-serif}
    .btn-auth:hover{background:var(--gold);color:var(--dark)}
    .auth-footer{text-align:center;padding:1.5rem;border-top:1px solid var(--cream-2);font-size:0.9rem;color:var(--text-muted)}
    .auth-footer a{color:var(--gold);text-decoration:none;font-weight:600}
</style>
@endsection
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <a href="{{ route('home') }}" class="auth-logo">Luxe<span>Store</span></a>
        </div>
        <div class="auth-body">
            <form action="{{ route('password.store') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                    @error('email')<span style="color:#dc3545;font-size:0.8rem;display:block;margin-top:0.3rem">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" required>
                    @error('password')<span style="color:#dc3545;font-size:0.8rem;display:block;margin-top:0.3rem">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn-auth">Reset Password</button>
            </form>
        </div>
        <div class="auth-footer"><a href="{{ route('login') }}">← Back to Login</a></div>
    </div>
</div>
@endsection
