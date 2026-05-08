<?php $__env->startSection('title', 'Login - LuxeStore'); ?>

<?php $__env->startSection('head_styles'); ?>
<style>
    .auth-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
        background: linear-gradient(135deg, var(--cream) 0%, var(--cream-2) 100%);
    }
    .auth-card {
        background: var(--white);
        border: 1px solid var(--cream-2);
        border-radius: 8px;
        width: 100%;
        max-width: 460px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }
    .auth-header {
        background: var(--dark);
        padding: 2.5rem 2.5rem 2rem;
        text-align: center;
        border-bottom: 2px solid var(--gold);
    }
    .auth-logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--gold);
        text-decoration: none;
    }
    .auth-logo span { color: white; }
    .auth-header h2 {
        font-family: 'Playfair Display', serif;
        color: var(--white);
        font-size: 1.3rem;
        margin-top: 1rem;
        font-weight: 400;
    }
    .auth-body { padding: 2.5rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text);
        margin-bottom: 0.5rem;
    }
    .form-group input {
        width: 100%;
        border: 1.5px solid var(--cream-2);
        border-radius: 4px;
        padding: 0.85rem 1rem;
        font-size: 0.95rem;
        color: var(--text);
        background: var(--cream);
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s;
    }
    .form-group input:focus {
        outline: none;
        border-color: var(--gold);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
    }
    .error-msg { color: #dc3545; font-size: 0.8rem; margin-top: 0.3rem; display: block; }
    .remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
    .remember-label { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: var(--text-muted); cursor: pointer; }
    .remember-label input { accent-color: var(--gold); }
    .forgot-link { color: var(--gold); font-size: 0.85rem; text-decoration: none; }
    .forgot-link:hover { text-decoration: underline; }
    .btn-auth {
        width: 100%;
        background: var(--dark);
        color: var(--gold);
        border: 2px solid var(--gold);
        padding: 0.95rem;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-auth:hover { background: var(--gold); color: var(--dark); }
    .auth-footer {
        text-align: center;
        padding: 1.5rem 2.5rem;
        border-top: 1px solid var(--cream-2);
        font-size: 0.9rem;
        color: var(--text-muted);
    }
    .auth-footer a { color: var(--gold); text-decoration: none; font-weight: 600; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <a href="<?php echo e(route('home')); ?>" class="auth-logo">Luxe<span>Store</span></a>
            <h2>Welcome Back</h2>
        </div>
        <div class="auth-body">
            <?php if($errors->any()): ?>
            <div style="background:#f8d7da;color:#721c24;border-left:4px solid #dc3545;padding:0.8rem 1rem;border-radius:4px;margin-bottom:1.5rem;font-size:0.9rem;">
                <i class="fas fa-exclamation-circle"></i> <?php echo e($errors->first()); ?>

            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="you@example.com">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="••••••••">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="forgot-link">Forgot password?</a>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn-auth"><i class="fas fa-sign-in-alt" style="margin-right:0.4rem"></i> Login</button>
            </form>
        </div>
        <div class="auth-footer">
            Don't have an account? <a href="<?php echo e(route('register')); ?>">Create one →</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Manan\Downloads\luxestore-complete\ecommerce\resources\views/auth/login.blade.php ENDPATH**/ ?>