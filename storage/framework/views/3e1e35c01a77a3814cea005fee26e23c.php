<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> — LuxeStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --dark: #0D0D0D;
            --dark-2: #1A1A1A;
            --dark-3: #252525;
            --sidebar-w: 260px;
            --cream: #F5F0E8;
            --white: #FFFFFF;
            --text: #2C2C2C;
            --text-muted: #7A7A7A;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DM Sans',sans-serif; background:#F0F0F5; display:flex; min-height:100vh; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--dark);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            border-right: 1px solid rgba(201,168,76,0.15);
        }
        .sidebar-logo {
            padding: 1.8rem 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-logo a {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold);
            text-decoration: none;
        }
        .sidebar-logo a span { color: white; }
        .sidebar-label {
            color: rgba(255,255,255,0.3);
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 0.3rem;
        }
        .sidebar-nav { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        .nav-section-title {
            color: rgba(255,255,255,0.25);
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.5rem 1.5rem;
            margin-bottom: 0.3rem;
        }
        .nav-item {
            display: flex; align-items: center; gap: 0.9rem;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.15s;
            border-left: 3px solid transparent;
            margin: 1px 0;
        }
        .nav-item:hover { color: var(--white); background: rgba(255,255,255,0.05); border-left-color: rgba(201,168,76,0.4); }
        .nav-item.active { color: var(--gold); background: rgba(201,168,76,0.08); border-left-color: var(--gold); font-weight: 600; }
        .nav-item i { width: 18px; text-align: center; font-size: 0.95rem; }
        .nav-badge {
            margin-left: auto;
            background: var(--gold);
            color: var(--dark);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
        }
        .sidebar-footer {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .admin-profile { display: flex; align-items: center; gap: 0.8rem; }
        .admin-avatar {
            width: 36px; height: 36px;
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--dark); font-weight: 700; font-size: 0.85rem;
        }
        .admin-name { color: var(--white); font-size: 0.85rem; font-weight: 500; }
        .admin-role { color: rgba(255,255,255,0.35); font-size: 0.75rem; }
        .btn-logout {
            margin-left: auto;
            background: none; border: none;
            color: rgba(255,255,255,0.3);
            cursor: pointer; font-size: 1rem;
            transition: color 0.2s;
        }
        .btn-logout:hover { color: #dc3545; }

        /* MAIN CONTENT */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: var(--white);
            padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #E8E8F0;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-title { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--dark); font-weight:700; }
        .topbar-right { display:flex; align-items:center; gap:1rem; }
        .topbar-btn {
            width: 38px; height: 38px;
            border-radius: 50%;
            border: 1px solid #E8E8F0;
            background: var(--white);
            color: var(--text-muted);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .topbar-btn:hover { border-color: var(--gold); color: var(--gold); }
        .page-content { padding: 2rem; flex: 1; }

        /* FLASH */
        .flash { padding:0.8rem 1.2rem; border-radius:4px; margin-bottom:1.5rem; font-size:0.9rem; display:flex; align-items:center; gap:0.5rem; }
        .flash-success { background:#d4edda; color:#155724; border-left:4px solid #28a745; }
        .flash-error { background:#f8d7da; color:#721c24; border-left:4px solid #dc3545; }

        /* STAT CARDS */
        .stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; margin-bottom:2rem; }
        .stat-card {
            background: var(--white);
            border-radius:8px;
            padding:1.8rem;
            border: 1px solid #E8E8F0;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,0,0,0.08); }
        .stat-card::after {
            content:'';
            position:absolute;
            top:0; right:0;
            width:80px; height:80px;
            border-radius: 0 0 0 100%;
            opacity: 0.08;
        }
        .stat-card.gold::after { background:var(--gold); }
        .stat-card.blue::after { background:#4A90E2; }
        .stat-card.green::after { background:#27AE60; }
        .stat-card.purple::after { background:#9B59B6; }
        .stat-icon { font-size:1.8rem; margin-bottom:1rem; }
        .stat-card.gold .stat-icon { color:var(--gold); }
        .stat-card.blue .stat-icon { color:#4A90E2; }
        .stat-card.green .stat-icon { color:#27AE60; }
        .stat-card.purple .stat-icon { color:#9B59B6; }
        .stat-value { font-family:'Playfair Display',serif; font-size:2rem; font-weight:700; color:var(--dark); }
        .stat-label { color:var(--text-muted); font-size:0.85rem; margin-top:0.3rem; }
        .stat-change { font-size:0.78rem; margin-top:0.5rem; }
        .stat-change.up { color:#27AE60; }
        .stat-change.down { color:#dc3545; }

        /* DATA TABLE CARDS */
        .table-card {
            background: var(--white);
            border-radius:8px;
            border: 1px solid #E8E8F0;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .table-card-header {
            padding:1.5rem 2rem;
            border-bottom: 1px solid #E8E8F0;
            display:flex; justify-content:space-between; align-items:center;
        }
        .table-card-title { font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--dark); font-weight:700; }
        .table-card-body { padding:1.5rem; }
        .btn-sm-gold {
            background:var(--gold); color:var(--dark); border:none;
            padding:0.4rem 1rem; border-radius:4px; font-size:0.8rem;
            font-weight:600; cursor:pointer; text-decoration:none;
            transition:background 0.2s;
        }
        .btn-sm-gold:hover { background:var(--gold-light); }
        .badge-status {
            padding:0.3rem 0.8rem; border-radius:20px; font-size:0.75rem; font-weight:600;
        }
        .badge-pending { background:#fff3cd; color:#856404; }
        .badge-processing { background:#cce5ff; color:#004085; }
        .badge-completed { background:#d4edda; color:#155724; }
        .badge-cancelled { background:#f8d7da; color:#721c24; }
        .badge-active { background:#d4edda; color:#155724; }
        .badge-admin { background:rgba(201,168,76,0.15); color:#856404; }

        @media(max-width:1024px) {
            .stats-row { grid-template-columns:repeat(2,1fr); }
            .sidebar { transform:translateX(-100%); }
            .main-content { margin-left:0; }
        }
    </style>
    <?php echo $__env->yieldContent('admin_styles'); ?>
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>">Luxe<span>Store</span></a>
            <div class="sidebar-label">Admin Panel</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-title">Overview</div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <div class="nav-section-title" style="margin-top:1rem">Catalog</div>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.products*') ? 'active' : ''); ?>">
                <i class="fas fa-box-open"></i> Products
            </a>
            <a href="<?php echo e(route('admin.products.create')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.products.create') ? 'active' : ''); ?>">
                <i class="fas fa-plus-circle"></i> Add Product
            </a>
            <div class="nav-section-title" style="margin-top:1rem">Sales</div>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.orders*') ? 'active' : ''); ?>">
                <i class="fas fa-shopping-cart"></i> Orders
                <span class="nav-badge"><?php echo e(\App\Models\Order::where('status','pending')->count() ?? 0); ?></span>
            </a>
            <a href="<?php echo e(route('admin.order-items.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.order-items*') ? 'active' : ''); ?>">
                <i class="fas fa-list"></i> Order Items
            </a>
            <div class="nav-section-title" style="margin-top:1rem">Users</div>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>">
                <i class="fas fa-users"></i> Customers
            </a>
            <a href="<?php echo e(route('admin.admins.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.admins*') ? 'active' : ''); ?>">
                <i class="fas fa-user-shield"></i> Admins
            </a>
            <div class="nav-section-title" style="margin-top:1rem">Engagement</div>
            <a href="<?php echo e(route('admin.contacts.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.contacts*') ? 'active' : ''); ?>">
                <i class="fas fa-envelope"></i> Contact Messages
                <?php $unread = \App\Models\Contact::where('is_read', false)->count(); ?>
                <?php if($unread > 0): ?>
                    <span class="nav-badge"><?php echo e($unread); ?></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo e(route('home')); ?>" class="nav-item" target="_blank" style="margin-top:auto">
                <i class="fas fa-external-link-alt"></i> View Store
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="admin-profile">
                <div class="admin-avatar"><?php echo e(strtoupper(substr(auth()->user()->name ?? 'A', 0, 1))); ?></div>
                <div>
                    <div class="admin-name"><?php echo e(auth()->user()->name ?? 'Admin'); ?></div>
                    <div class="admin-role">Administrator</div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></div>
            <div class="topbar-right">
                <a href="<?php echo e(route('home')); ?>" class="topbar-btn" title="View Store" target="_blank"><i class="fas fa-store"></i></a>
                <a href="<?php echo e(route('admin.products.create')); ?>" class="topbar-btn" title="Add Product"><i class="fas fa-plus"></i></a>
            </div>
        </div>

        <div class="page-content">
            <?php if(session('success')): ?>
            <div class="flash flash-success"><i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session('error')): ?>
            <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('admin_content'); ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Initialize all DataTables
        $(document).ready(function () {
            $('.data-table').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'desc']],
                language: {
                    search: '<i class="fas fa-search"></i>',
                    lengthMenu: 'Show _MENU_',
                    info: 'Showing _START_ to _END_ of _TOTAL_ records',
                    paginate: { previous: '←', next: '→' }
                },
                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            });
        });
    </script>
    <?php echo $__env->yieldContent('admin_scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/layouts/admin.blade.php ENDPATH**/ ?>