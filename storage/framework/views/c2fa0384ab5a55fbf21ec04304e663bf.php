<?php $__env->startSection('title', 'All Products - LuxeStore'); ?>

<?php $__env->startSection('head_styles'); ?>
<style>
    .page-hero {
        background: var(--dark);
        padding: 5rem 5% 4rem;
        position: relative;
        overflow: hidden;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .page-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        color: var(--white);
        font-weight: 900;
    }
    .page-hero h1 em { color: var(--gold); font-style: italic; }
    .breadcrumb { color: rgba(255,255,255,0.4); font-size: 0.85rem; margin-bottom: 1rem; }
    .breadcrumb a { color: var(--gold); text-decoration: none; }

    .shop-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 2.5rem;
        padding: 3rem 5%;
    }

    /* SIDEBAR */
    .sidebar { position: sticky; top: 90px; align-self: start; }
    .sidebar-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 4px;
        padding: 1.8rem;
        margin-bottom: 1.5rem;
    }
    .sidebar-title {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        color: var(--dark);
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--gold);
        display: inline-block;
    }
    .filter-group { margin-bottom: 1rem; }
    .filter-label { display: flex; align-items: center; gap: 0.6rem; cursor: pointer; padding: 0.4rem 0; font-size: 0.9rem; color: var(--text); transition: color 0.2s; }
    .filter-label:hover { color: var(--gold); }
    .filter-label input[type="checkbox"] { accent-color: var(--gold); }
    .price-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: 0.8rem; }
    .price-input {
        border: 1px solid var(--cream-2);
        border-radius: 2px;
        padding: 0.5rem 0.7rem;
        font-size: 0.85rem;
        color: var(--text);
        width: 100%;
    }
    .btn-filter {
        width: 100%;
        background: var(--dark);
        color: var(--gold);
        border: 1px solid var(--gold);
        padding: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        border-radius: 2px;
        transition: all 0.2s;
        font-size: 0.85rem;
        text-transform: uppercase;
        margin-top: 0.5rem;
    }
    .btn-filter:hover { background: var(--gold); color: var(--dark); }

    /* PRODUCTS AREA */
    .products-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .products-count { color: var(--text-muted); font-size: 0.9rem; }
    .sort-select {
        border: 1px solid var(--cream-2);
        border-radius: 2px;
        padding: 0.6rem 1rem;
        font-size: 0.85rem;
        color: var(--text);
        background: var(--white);
        cursor: pointer;
    }
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }
    .product-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 4px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .product-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
    .product-img {
        height: 220px;
        background: var(--cream);
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .product-card:hover .product-img img { transform: scale(1.08); }
    .product-img-icon { font-size: 3.5rem; color: var(--gold); opacity: 0.3; }
    .product-actions {
        position: absolute;
        bottom: -50px;
        left: 0; right: 0;
        background: rgba(13,13,13,0.9);
        padding: 0.8rem;
        display: flex;
        gap: 0.5rem;
        transition: bottom 0.3s;
    }
    .product-card:hover .product-actions { bottom: 0; }
    .btn-cart, .btn-view {
        flex: 1;
        padding: 0.6rem;
        border: none;
        border-radius: 2px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: background 0.2s;
        display: inline-block;
    }
    .btn-cart { background: var(--gold); color: var(--dark); }
    .btn-cart:hover { background: var(--gold-light); }
    .btn-view { background: rgba(255,255,255,0.1); color: var(--white); border: 1px solid rgba(255,255,255,0.2); }
    .btn-view:hover { background: rgba(255,255,255,0.2); }
    .product-info { padding: 1.2rem; }
    .product-cat { color: var(--gold); font-size: 0.7rem; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 0.4rem; }
    .product-name { font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 600; color: var(--dark); margin-bottom: 0.6rem; line-height: 1.3; }
    .product-footer { display: flex; justify-content: space-between; align-items: center; }
    .product-price { font-weight: 700; font-size: 1.1rem; color: var(--dark); }
    .product-stock { font-size: 0.75rem; color: #28a745; font-weight: 500; }
    .product-stock.low { color: #dc3545; }

    /* PAGINATION */
    .pagination { display: flex; justify-content: center; gap: 0.5rem; margin-top: 3rem; }
    .pagination a, .pagination span {
        display: inline-flex; align-items: center; justify-content: center;
        width: 40px; height: 40px;
        border: 1px solid var(--cream-2);
        border-radius: 2px;
        color: var(--text);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s;
        background: var(--white);
    }
    .pagination a:hover { border-color: var(--gold); color: var(--gold); }
    .pagination .active { background: var(--gold); border-color: var(--gold); color: var(--dark); font-weight: 700; }

    @media (max-width: 900px) {
        .shop-layout { grid-template-columns: 1fr; }
        .sidebar { position: static; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hero">
    <div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Home</a> / Products</div>
    <h1>Our <em>Products</em></h1>
</div>

<div class="shop-layout">
    <!-- SIDEBAR FILTERS -->
    <aside class="sidebar">
        <form method="GET" action="<?php echo e(route('products.index')); ?>">
            <div class="sidebar-card">
                <div class="sidebar-title">Categories</div>
                <?php $categories = ['Electronics', 'Fashion', 'Home & Living', 'Beauty', 'Sports', 'Books']; ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="filter-label">
                    <input type="checkbox" name="category[]" value="<?php echo e(strtolower($cat)); ?>"
                        <?php echo e(in_array(strtolower($cat), request('category', [])) ? 'checked' : ''); ?>>
                    <?php echo e($cat); ?>

                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="sidebar-card">
                <div class="sidebar-title">Price Range</div>
                <div class="price-inputs">
                    <input type="number" class="price-input" name="min_price" placeholder="Min" value="<?php echo e(request('min_price')); ?>">
                    <input type="number" class="price-input" name="max_price" placeholder="Max" value="<?php echo e(request('max_price')); ?>">
                </div>
            </div>
            <button type="submit" class="btn-filter"><i class="fas fa-filter"></i> Apply Filters</button>
            <a href="<?php echo e(route('products.index')); ?>" style="display:block;text-align:center;margin-top:0.8rem;color:var(--text-muted);font-size:0.85rem;text-decoration:none;">Clear All</a>
        </form>
    </aside>

    <!-- PRODUCTS MAIN -->
    <div>
        <div class="products-header">
            <span class="products-count">Showing <?php echo e($products->count() ?? 0); ?> products</span>
            <select class="sort-select" onchange="window.location.href=this.value">
                <option value="?sort=newest">Newest First</option>
                <option value="?sort=price_asc">Price: Low to High</option>
                <option value="?sort=price_desc">Price: High to Low</option>
                <option value="?sort=name">Name A-Z</option>
            </select>
        </div>

        <div class="products-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="product-card">
                <div class="product-img">
                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset('storage/'.$product->image)); ?>" alt="<?php echo e($product->name); ?>">
                    <?php else: ?>
                        <div class="product-img-icon"><i class="fas fa-gem"></i></div>
                    <?php endif; ?>
                    <div class="product-actions">
                        <form action="<?php echo e(route('cart.add')); ?>" method="POST" style="flex:1">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <button type="submit" class="btn-cart" style="width:100%"><i class="fas fa-shopping-bag"></i> Add</button>
                        </form>
                        <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn-view"><i class="fas fa-eye"></i> View</a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat"><?php echo e($product->category ?? 'Premium'); ?></div>
                    <div class="product-name"><?php echo e($product->name); ?></div>
                    <div class="product-footer">
                        <div class="product-price">PKR <?php echo e(number_format($product->price, 0)); ?></div>
                        <div class="product-stock <?php echo e(($product->stock ?? 10) < 5 ? 'low' : ''); ?>">
                            <?php echo e(($product->stock ?? 10) < 5 ? 'Low Stock' : 'In Stock'); ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <!-- Demo products when DB is empty -->
            <?php for($i = 1; $i <= 8; $i++): ?>
            <div class="product-card" style="cursor:pointer">
                <div class="product-img">
                    <div class="product-img-icon"><i class="fas fa-star"></i></div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Premium Collection</div>
                    <div class="product-name">Luxury Product No. <?php echo e($i); ?></div>
                    <div class="product-footer">
                        <div class="product-price">PKR <?php echo e(number_format(rand(1500,25000), 0)); ?></div>
                        <div class="product-stock">In Stock</div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
            <?php endif; ?>
        </div>

        <?php if(isset($products) && $products->hasPages()): ?>
        <div class="pagination">
            <?php echo e($products->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/products/index.blade.php ENDPATH**/ ?>