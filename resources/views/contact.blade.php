@extends('layouts.app')
@section('title', 'Contact Us - LuxeStore')

@section('head_styles')
<style>
    .contact-hero {
        background: var(--dark);
        padding: 6rem 5%;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at center, rgba(201,168,76,0.08) 0%, transparent 65%);
    }
    .contact-hero span {
        display: block; color: var(--gold);
        font-size: 0.75rem; letter-spacing: 3px;
        text-transform: uppercase; margin-bottom: 1rem;
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem; color: var(--white); font-weight: 900;
        position: relative;
    }
    .contact-hero h1 em { color: var(--gold); font-style: italic; }
    .contact-hero p { color: rgba(255,255,255,0.5); margin-top: 1rem; font-size: 1.1rem; position: relative; }

    .contact-page { padding: 5rem 5%; display: grid; grid-template-columns: 1fr 1.5fr; gap: 5rem; max-width: 1200px; margin: 0 auto; }

    /* INFO CARDS */
    .contact-info { display: flex; flex-direction: column; gap: 1.5rem; }
    .info-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 4px;
        padding: 1.8rem;
        display: flex; align-items: flex-start; gap: 1.2rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .info-card:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
    .info-icon {
        width: 48px; height: 48px;
        background: rgba(201,168,76,0.1);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold); font-size: 1.2rem;
        flex-shrink: 0;
    }
    .info-card h3 { font-family: 'Playfair Display', serif; font-size: 1rem; color: var(--dark); margin-bottom: 0.3rem; }
    .info-card p { color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; }
    .info-card a { color: var(--gold); text-decoration: none; }
    .info-card a:hover { text-decoration: underline; }

    /* SOCIAL LINKS */
    .social-links { display: flex; gap: 0.8rem; margin-top: 0.5rem; }
    .social-btn {
        width: 42px; height: 42px;
        background: var(--dark);
        color: var(--gold);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none;
        font-size: 1rem;
        transition: all 0.2s;
        border: 1px solid rgba(201,168,76,0.2);
    }
    .social-btn:hover { background: var(--gold); color: var(--dark); }

    /* FORM */
    .contact-form-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 4px;
        padding: 3rem;
    }
    .form-title { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--dark); margin-bottom: 0.5rem; }
    .form-subtitle { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label {
        display: block; font-size: 0.8rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.5px;
        color: var(--text); margin-bottom: 0.5rem;
    }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        border: 1.5px solid var(--cream-2);
        border-radius: 2px;
        padding: 0.9rem 1.1rem;
        font-size: 0.95rem;
        color: var(--text);
        background: var(--cream);
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none;
        border-color: var(--gold);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
    }
    .form-group textarea { min-height: 150px; resize: vertical; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
    .btn-submit {
        width: 100%;
        background: var(--dark);
        color: var(--gold);
        border: 2px solid var(--gold);
        padding: 1.1rem 2rem;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 2px;
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-submit:hover { background: var(--gold); color: var(--dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.3); }
    .error-msg { color: #dc3545; font-size: 0.8rem; margin-top: 0.3rem; }

    /* SUCCESS STATE */
    .success-state {
        text-align: center; padding: 4rem 2rem;
        display: none;
    }
    .success-icon { font-size: 4rem; color: var(--gold); margin-bottom: 1rem; }
    .success-state h3 { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--dark); }
    .success-state p { color: var(--text-muted); margin-top: 0.5rem; }

    @media (max-width: 900px) {
        .contact-page { grid-template-columns: 1fr; gap: 3rem; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="contact-hero">
    <span>✦ We're Here to Help</span>
    <h1>Get in <em>Touch</em></h1>
    <p>Have a question or concern? We'd love to hear from you.</p>
</div>

<div class="contact-page">
    <!-- LEFT: CONTACT INFO -->
    <div class="contact-info">
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
                <h3>Visit Our Store</h3>
                <p>123 Commerce Street<br>Karachi, Sindh, Pakistan</p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-phone"></i></div>
            <div>
                <h3>Call Us</h3>
                <p><a href="tel:+923001234567">+92 300 1234567</a><br>
                <a href="tel:+922112345678">+92 21 12345678</a></p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-envelope"></i></div>
            <div>
                <h3>Email Us</h3>
                <p><a href="mailto:hello@luxestore.pk">hello@luxestore.pk</a><br>
                <a href="mailto:support@luxestore.pk">support@luxestore.pk</a></p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-clock"></i></div>
            <div>
                <h3>Business Hours</h3>
                <p>Mon – Sat: 9:00 AM – 8:00 PM<br>Sunday: 11:00 AM – 6:00 PM</p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-share-alt"></i></div>
            <div>
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: FORM -->
    <div class="contact-form-card">
        <h2 class="form-title">Send Us a Message</h2>
        <p class="form-subtitle">We'll get back to you within 24 hours.</p>

        @if(session('contact_success'))
        <div style="background:#d4edda;color:#155724;border-left:4px solid #28a745;padding:1rem 1.5rem;border-radius:4px;margin-bottom:1.5rem;display:flex;align-items:center;gap:0.5rem;">
            <i class="fas fa-check-circle"></i>
            <strong>Message sent!</strong> We'll reply within 24 hours.
        </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Your Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Muhammad Ali">
                    @error('name')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="ali@example.com">
                    @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+92 300 0000000">
                </div>
                <div class="form-group">
                    <label>Subject *</label>
                    <select name="subject" required>
                        <option value="">Select a subject...</option>
                        <option value="order_inquiry" {{ old('subject') == 'order_inquiry' ? 'selected' : '' }}>Order Inquiry</option>
                        <option value="product_question" {{ old('subject') == 'product_question' ? 'selected' : '' }}>Product Question</option>
                        <option value="return_refund" {{ old('subject') == 'return_refund' ? 'selected' : '' }}>Return / Refund</option>
                        <option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                        <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('subject')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>Your Message *</label>
                <textarea name="message" required placeholder="Write your message here...">{{ old('message') }}</textarea>
                @error('message')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane" style="margin-right:0.5rem"></i>
                Send Message
            </button>
        </form>
    </div>
</div>
@endsection
