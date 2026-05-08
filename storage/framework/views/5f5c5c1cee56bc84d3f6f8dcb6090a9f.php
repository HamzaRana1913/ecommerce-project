<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('page_title', 'All Orders'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-shopping-cart" style="color:#4A90E2;margin-right:0.5rem"></i>Orders (<?php echo e($orders->count()); ?>)</div>
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap">
            <?php
                $statuses = ['pending','processing','shipped','completed','cancelled'];
                $counts = $orders->groupBy('status')->map->count();
            ?>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="badge-status badge-<?php echo e($s); ?>" style="font-size:0.75rem">
                <?php echo e(ucfirst($s)); ?>: <?php echo e($counts[$s] ?? 0); ?>

            </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="ordersTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><strong style="color:var(--gold)">#<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></strong></td>
                    <td>
                        <div style="font-weight:600"><?php echo e($order->shipping_name); ?></div>
                        <div style="font-size:0.78rem;color:var(--text-muted)"><?php echo e($order->user->name ?? 'Guest'); ?></div>
                    </td>
                    <td style="font-size:0.82rem">
                        <div><?php echo e($order->shipping_email); ?></div>
                        <div style="color:var(--text-muted)"><?php echo e($order->shipping_phone); ?></div>
                    </td>
                    <td><?php echo e($order->items->count()); ?> item(s)</td>
                    <td><strong>PKR <?php echo e(number_format($order->total_amount, 0)); ?></strong></td>
                    <td style="font-size:0.85rem"><?php echo e(ucwords(str_replace('_',' ',$order->payment_method))); ?></td>
                    <td>
                        <span class="badge-status badge-<?php echo e($order->status); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </td>
                    <td style="font-size:0.82rem;color:var(--text-muted)"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn-sm-gold"><i class="fas fa-eye"></i> View</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>