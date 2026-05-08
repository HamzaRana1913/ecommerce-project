<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('page_title', 'All Customers'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-users" style="color:#9B59B6;margin-right:0.5rem"></i>Customers (<?php echo e($users->count()); ?>)</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Total Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.7rem">
                            <div style="width:36px;height:36px;background:rgba(201,168,76,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--gold);font-size:0.85rem;flex-shrink:0">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </div>
                            <strong><?php echo e($user->name); ?></strong>
                        </div>
                    </td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <strong><?php echo e($user->orders->count()); ?></strong>
                        <?php if($user->orders->count() > 0): ?>
                            <a href="<?php echo e(route('admin.orders.index')); ?>" style="color:var(--gold);font-size:0.75rem;margin-left:0.3rem">view →</a>
                        <?php endif; ?>
                    </td>
                    <td><strong>PKR <?php echo e(number_format($user->orders->sum('total_amount'), 0)); ?></strong></td>
                    <td style="font-size:0.85rem;color:var(--text-muted)"><?php echo e($user->created_at->format('M d, Y')); ?></td>
                    <td><span class="badge-status badge-active"><i class="fas fa-circle" style="font-size:0.5rem;margin-right:0.3rem"></i>Active</span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/admin/users/index.blade.php ENDPATH**/ ?>