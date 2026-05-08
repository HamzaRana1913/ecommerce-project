<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'LuxeStore - Premium Shopping'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --dark: #0D0D0D;
            --dark-2: #1A1A1A;
            --dark-3: #252525;
            --cream: #F5F0E8;
            --cream-2: #EDE8DC;
            --text: #2C2C2C;
            --text-muted: #7A7A7A;
            --white: #FFFFFF;
            --shadow: 0 4px 30px rgba(0,0,0,0.08);
            --shadow-lg: 0 20px 60px rgba(0,0,0,0.15);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
            overflow-x: hidden;
        }
        /* NAVBAR */
        nav {
            background: var(--dark);
            padding: 0 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 72px;
            border-bottom: 1px solid rgba(201,168,76,0.2);
        }
        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--gold);
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .nav-logo span { color: var(--white); }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: color 0.2s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 1px;
            background: var(--gold);
            transition: width 0.3s;
        }
        .nav-links a:hover { color: var(--gold); }
        .nav-links a:hover::after { width: 100%; }
        .nav-actions { display: flex; align-items: center; gap: 1.2rem; }
        .cart-btn {
            background: var(--gold);
            color: var(--dark);
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 2px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            display: flex; align-items: center; gap: 0.5rem;
            transition: background 0.2s, transform 0.2s;
            letter-spacing: 0.3px;
        }
        .cart-btn:hover { background: var(--gold-light); transform: translateY(-1px); }
        .cart-count {
            background: var(--dark);
            color: var(--gold);
            border-radius: 50%;
            width: 20px; height: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 700;
        }

        /* FLASH MESSAGES */
        .flash-container { padding: 0 5%; margin-top: 1rem; }
        .flash {
            padding: 1rem 1.5rem;
            border-radius: 4px;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .flash-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .flash-error { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }

        /* FOOTER */
        footer {
            background: var(--dark);
            color: rgba(255,255,255,0.6);
            padding: 4rem 5% 2rem;
            margin-top: 6rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }
        .footer-brand p { font-size: 0.9rem; line-height: 1.7; margin-top: 1rem; }
        .footer-col h4 {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            margin-bottom: 1.2rem;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.6rem; }
        .footer-col ul li a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.9rem; transition: color 0.2s; }
        .footer-col ul li a:hover { color: var(--gold); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 1.5rem;
            display: flex; justify-content: space-between;
            font-size: 0.85rem;
        }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .footer-grid { grid-template-columns: 1fr; }
        }
    </style>
    <?php echo $__env->yieldContent('head_styles'); ?>
</head>
<body>
    <nav>
        <a href="<?php echo e(route('home')); ?>" class="nav-logo">Luxe<span>Store</span></a>
        <ul class="nav-links">
            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li><a href="<?php echo e(route('products.index')); ?>">Products</a></li>
            <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
            <?php if(auth()->guard()->check()): ?>
                <li><a href="<?php echo e(route('user.orders')); ?>">My Orders</a></li>
                <?php if(auth()->user()->is_admin): ?>
                    <li><a href="<?php echo e(route('admin.dashboard')); ?>" style="color:var(--gold)">Admin</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <div class="nav-actions">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" style="color:rgba(255,255,255,0.7);text-decoration:none;font-size:0.9rem;">Login</a>
                <a href="<?php echo e(route('register')); ?>" class="cart-btn">Register</a>
            <?php else: ?>
                <span style="color:rgba(255,255,255,0.6);font-size:0.85rem;">Hi, <?php echo e(auth()->user()->name); ?></span>
                <a href="<?php echo e(route('cart.index')); ?>" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i>
                    Cart
                    <span class="cart-count"><?php echo e(session('cart') ? count(session('cart')) : 0); ?></span>
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="background:none;border:none;color:rgba(255,255,255,0.5);cursor:pointer;font-size:0.85rem;">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>

    <?php if(session('success')): ?>
        <div class="flash-container">
            <div class="flash flash-success"><i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="flash-container">
            <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?></div>
        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?php echo e(route('home')); ?>" class="nav-logo">Luxe<span style="color:white">Store</span></a>
                <p>Curating the finest products for the discerning customer. Quality, elegance, and excellence in every purchase.</p>
            </div>
            <div class="footer-col">
                <h4>Shop</h4>
                <ul>
                    <li><a href="<?php echo e(route('products.index')); ?>">All Products</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Best Sellers</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Account</h4>
                <ul>
                    <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                    <li><a href="<?php echo e(route('checkout.index')); ?>">My Orders</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© <?php echo e(date('Y')); ?> LuxeStore. All rights reserved.</span>
            <span>Crafted with ♥ using Laravel</span>
        </div>
    </footer>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/layouts/app.blade.php ENDPATH**/ ?>