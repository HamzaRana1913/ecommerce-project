<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('page_title', 'All Products'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-box-open" style="color:var(--gold);margin-right:0.5rem"></i>Products (<?php echo e($products->count()); ?>)</div>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-sm-gold"><i class="fas fa-plus"></i> Add New Product</a>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="productsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.8rem">
                            <div style="width:42px;height:42px;background:var(--cream);border-radius:4px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--gold)">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/'.$product->image)); ?>" style="width:100%;height:100%;object-fit:cover">
                                <?php else: ?>
                                    <i class="fas fa-gem" style="opacity:0.4"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <strong><?php echo e($product->name); ?></strong>
                                <?php if($product->description): ?>
                                <div style="font-size:0.78rem;color:var(--text-muted);margin-top:2px"><?php echo e(Str::limit($product->description, 50)); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if($product->category): ?>
                            <span class="badge bg-secondary"><?php echo e(ucfirst($product->category)); ?></span>
                        <?php else: ?>
                            <span style="color:var(--text-muted)">—</span>
                        <?php endif; ?>
                    </td>
                    <td><strong>PKR <?php echo e(number_format($product->price, 0)); ?></strong></td>
                    <td>
                        <span style="font-weight:600;color:<?php echo e($product->stock < 5 ? '#dc3545' : ($product->stock < 20 ? '#ffc107' : '#28a745')); ?>">
                            <?php echo e($product->stock); ?>

                        </span>
                        <?php if($product->stock == 0): ?>
                            <span class="badge bg-danger ms-1" style="font-size:0.7rem">Out</span>
                        <?php elseif($product->stock < 5): ?>
                            <span class="badge bg-warning ms-1" style="font-size:0.7rem">Low</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:0.85rem;color:var(--text-muted)"><?php echo e($product->created_at->format('M d, Y')); ?></td>
                    <td>
                        <div style="display:flex;gap:0.3rem">
                            <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-sm btn-outline-secondary" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn-sm-gold" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Delete \'<?php echo e(addslashes($product->name)); ?>\'?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/admin/products/index.blade.php ENDPATH**/ ?>