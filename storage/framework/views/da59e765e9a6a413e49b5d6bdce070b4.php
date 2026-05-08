<?php $__env->startSection('title', isset($product) ? 'Edit Product' : 'Add Product'); ?>
<?php $__env->startSection('page_title', isset($product) ? 'Edit Product' : 'Add New Product'); ?>

<?php $__env->startSection('admin_styles'); ?>
<style>
    .product-form-card {
        background: white;
        border-radius: 8px;
        border: 1px solid #E8E8F0;
        max-width: 800px;
    }
    .form-section {
        padding: 2rem;
        border-bottom: 1px solid #E8E8F0;
    }
    .form-section:last-child { border-bottom: none; }
    .form-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        color: var(--dark);
        margin-bottom: 1.5rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    .form-section-title i { color: var(--gold); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
    .form-group { margin-bottom: 1.2rem; }
    .form-group label { display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text); margin-bottom: 0.5rem; }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        border: 1.5px solid #E8E8F0;
        border-radius: 4px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: border-color 0.2s;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none; border-color: var(--gold);
    }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .img-preview {
        width: 120px; height: 120px;
        border: 2px dashed #E8E8F0;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; color: var(--gold); opacity: 0.4;
        overflow: hidden; margin-bottom: 0.8rem;
    }
    .img-preview img { width: 100%; height: 100%; object-fit: cover; }
    .btn-save {
        background: var(--dark); color: var(--gold);
        border: 2px solid var(--gold); padding: 0.8rem 2rem;
        font-weight: 700; font-size: 0.9rem; letter-spacing: 0.5px;
        text-transform: uppercase; cursor: pointer; border-radius: 4px;
        transition: all 0.2s; margin-right: 1rem;
    }
    .btn-save:hover { background: var(--gold); color: var(--dark); }
    .btn-cancel {
        background: #f8f9fa; color: var(--text-muted);
        border: 1px solid #E8E8F0; padding: 0.8rem 2rem;
        font-weight: 600; font-size: 0.9rem;
        cursor: pointer; border-radius: 4px; text-decoration: none;
        display: inline-block;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="product-form-card">
    <form action="<?php echo e(isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store')); ?>"
          method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if(isset($product)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <!-- BASIC INFO -->
        <div class="form-section">
            <div class="form-section-title"><i class="fas fa-info-circle"></i> Basic Information</div>
            <div class="form-group">
                <label>Product Name *</label>
                <input type="text" name="name" value="<?php echo e(old('name', $product->name ?? '')); ?>" required placeholder="Enter product name">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:#dc3545;font-size:0.8rem"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Describe the product..."><?php echo e(old('description', $product->description ?? '')); ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="">Select Category</option>
                        <?php $__currentLoopData = ['Electronics','Fashion','Home & Living','Beauty','Sports','Books']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(strtolower($cat)); ?>" <?php echo e(old('category', $product->category ?? '') == strtolower($cat) ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price (PKR) *</label>
                    <input type="number" name="price" value="<?php echo e(old('price', $product->price ?? '')); ?>" required min="0" step="0.01" placeholder="0.00">
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:#dc3545;font-size:0.8rem"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-group" style="max-width:200px">
                <label>Stock Quantity *</label>
                <input type="number" name="stock" value="<?php echo e(old('stock', $product->stock ?? 0)); ?>" required min="0">
            </div>
        </div>

        <!-- IMAGE -->
        <div class="form-section">
            <div class="form-section-title"><i class="fas fa-image"></i> Product Image</div>
            <div class="img-preview" id="imgPreview">
                <?php if(isset($product) && $product->image): ?>
                    <img src="<?php echo e(asset('storage/'.$product->image)); ?>" id="previewImg">
                <?php else: ?>
                    <i class="fas fa-image" id="previewIcon"></i>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Upload Image (JPG, PNG, max 2MB)</label>
                <input type="file" name="image" accept="image/*" id="imageInput">
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="form-section" style="display:flex;align-items:center">
            <button type="submit" class="btn-save">
                <i class="fas fa-save" style="margin-right:0.4rem"></i>
                <?php echo e(isset($product) ? 'Update Product' : 'Save Product'); ?>

            </button>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_scripts'); ?>
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('imgPreview');
        preview.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover">';
    };
    reader.readAsDataURL(file);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/admin/products/create.blade.php ENDPATH**/ ?>