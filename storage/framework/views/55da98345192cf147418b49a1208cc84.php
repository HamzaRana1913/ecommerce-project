<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page_title', 'Dashboard Overview'); ?>

<?php $__env->startSection('admin_content'); ?>
<!-- STAT CARDS -->
<div class="stats-row">
    <div class="stat-card gold">
        <div class="stat-icon"><i class="fas fa-box-open"></i></div>
        <div class="stat-value"><?php echo e($stats['products'] ?? 0); ?></div>
        <div class="stat-label">Total Products</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 12% this month</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-value"><?php echo e($stats['orders'] ?? 0); ?></div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 8% this week</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="stat-value"><?php echo e(number_format($stats['revenue'] ?? 0, 0)); ?></div>
        <div class="stat-label">Revenue (PKR)</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 20% this month</div>
    </div>
    <div class="stat-card purple">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-value"><?php echo e($stats['users'] ?? 0); ?></div>
        <div class="stat-label">Registered Users</div>
        <div class="stat-change up"><i class="fas fa-arrow-up"></i> 5 new today</div>
    </div>
</div>

<!-- PRODUCTS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-box-open" style="color:var(--gold);margin-right:0.5rem"></i>Products</div>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-sm-gold"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="productsTable">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.8rem">
                            <div style="width:36px;height:36px;background:var(--cream);border-radius:4px;display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:0.9rem">
                                <i class="fas fa-gem"></i>
                            </div>
                            <strong><?php echo e($product->name); ?></strong>
                        </div>
                    </td>
                    <td><?php echo e($product->category ?? '—'); ?></td>
                    <td><strong>PKR <?php echo e(number_format($product->price, 0)); ?></strong></td>
                    <td>
                        <span style="color:<?php echo e($product->stock < 5 ? '#dc3545' : '#28a745'); ?>;font-weight:600">
                            <?php echo e($product->stock ?? 0); ?>

                        </span>
                    </td>
                    <td><span class="badge-status badge-active">Active</span></td>
                    <td>
                        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn-sm-gold" style="margin-right:0.3rem"><i class="fas fa-edit"></i></a>
                        <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Delete this product?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ORDERS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-shopping-cart" style="color:#4A90E2;margin-right:0.5rem"></i>Recent Orders</div>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn-sm-gold">View All</a>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="ordersTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><strong>#<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></strong></td>
                    <td><?php echo e($order->user->name ?? 'Guest'); ?></td>
                    <td><?php echo e($order->items->count() ?? 0); ?> items</td>
                    <td><strong>PKR <?php echo e(number_format($order->total_amount, 0)); ?></strong></td>
                    <td><?php echo e(ucfirst(str_replace('_',' ', $order->payment_method ?? 'cod'))); ?></td>
                    <td>
                        <span class="badge-status badge-<?php echo e($order->status ?? 'pending'); ?>">
                            <?php echo e(ucfirst($order->status ?? 'Pending')); ?>

                        </span>
                    </td>
                    <td><?php echo e($order->created_at->format('M d, Y') ?? '—'); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn-sm-gold"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ORDER ITEMS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-list" style="color:#27AE60;margin-right:0.5rem"></i>Order Items</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="orderItemsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orderItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><a href="<?php echo e(route('admin.orders.show', $item->order_id)); ?>" style="color:var(--gold)">#<?php echo e(str_pad($item->order_id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                    <td><?php echo e($item->product->name ?? 'Deleted Product'); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>PKR <?php echo e(number_format($item->price, 0)); ?></td>
                    <td><strong>PKR <?php echo e(number_format($item->price * $item->quantity, 0)); ?></strong></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- USERS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-users" style="color:#9B59B6;margin-right:0.5rem"></i>Customers</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.6rem">
                            <div style="width:32px;height:32px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:var(--gold)">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </div>
                            <?php echo e($user->name); ?>

                        </div>
                    </td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->orders->count() ?? 0); ?></td>
                    <td>PKR <?php echo e(number_format($user->orders->sum('total_amount') ?? 0, 0)); ?></td>
                    <td><?php echo e($user->created_at->format('M d, Y') ?? '—'); ?></td>
                    <td>
                        <span class="badge-status <?php echo e($user->is_admin ? 'badge-admin' : 'badge-active'); ?>">
                            <?php echo e($user->is_admin ? 'Admin' : 'Customer'); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ADMINS TABLE -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-user-shield" style="color:var(--gold);margin-right:0.5rem"></i>Administrators</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="adminsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $admins ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($admin->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.6rem">
                            <div style="width:32px;height:32px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:var(--gold)">
                                <?php echo e(strtoupper(substr($admin->name, 0, 1))); ?>

                            </div>
                            <strong><?php echo e($admin->name); ?></strong>
                        </div>
                    </td>
                    <td><?php echo e($admin->email); ?></td>
                    <td><?php echo e($admin->created_at->format('M d, Y') ?? '—'); ?></td>
                    <td><span class="badge-status badge-admin"><i class="fas fa-shield-alt"></i> Admin</span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>