<?php $__env->startSection('title', 'Administrators'); ?>
<?php $__env->startSection('page_title', 'Administrators'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-user-shield" style="color:var(--gold);margin-right:0.5rem"></i>Administrators (<?php echo e($admins->count()); ?>)</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="adminsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Last Login</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($admin->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.7rem">
                            <div style="width:36px;height:36px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--gold);font-size:0.85rem;flex-shrink:0">
                                <?php echo e(strtoupper(substr($admin->name, 0, 1))); ?>

                            </div>
                            <div>
                                <strong><?php echo e($admin->name); ?></strong>
                                <?php if($admin->id === auth()->id()): ?>
                                    <span style="background:rgba(201,168,76,0.15);color:var(--gold);font-size:0.7rem;padding:0.1rem 0.5rem;border-radius:10px;margin-left:0.4rem">You</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td><?php echo e($admin->email); ?></td>
                    <td style="font-size:0.85rem;color:var(--text-muted)"><?php echo e($admin->created_at->format('M d, Y')); ?></td>
                    <td style="font-size:0.85rem;color:var(--text-muted)"><?php echo e($admin->updated_at->format('M d, Y')); ?></td>
                    <td>
                        <span class="badge-status badge-admin">
                            <i class="fas fa-shield-alt" style="margin-right:0.3rem"></i>Administrator
                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/admin/users/admins.blade.php ENDPATH**/ ?>