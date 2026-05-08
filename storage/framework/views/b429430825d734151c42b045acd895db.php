<?php $__env->startSection('title', '404 – Page Not Found'); ?>
<?php $__env->startSection('content'); ?>
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:3rem 1.5rem">
    <div>
        <div style="font-family:'Playfair Display',serif;font-size:8rem;font-weight:900;color:var(--gold);line-height:1;opacity:0.3">404</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:2rem;color:var(--dark);margin-bottom:1rem">Page Not Found</h1>
        <p style="color:var(--text-muted);margin-bottom:2rem;max-width:400px">The page you're looking for doesn't exist or has been moved.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="<?php echo e(route('home')); ?>" style="background:var(--dark);color:var(--gold);border:2px solid var(--gold);padding:0.8rem 2rem;font-weight:700;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;border-radius:4px;text-decoration:none">← Go Home</a>
            <a href="<?php echo e(route('products.index')); ?>" style="background:var(--gold);color:var(--dark);border:2px solid var(--gold);padding:0.8rem 2rem;font-weight:700;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;border-radius:4px;text-decoration:none">Browse Products</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/errors/404.blade.php ENDPATH**/ ?>