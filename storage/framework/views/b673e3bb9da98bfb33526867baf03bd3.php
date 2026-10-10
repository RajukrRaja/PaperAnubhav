<?php $__env->startSection('title', 'Log in — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page" style="max-width: 420px; margin: 0 auto; padding: var(--space-12) var(--container-gutter);">
    <div class="card" style="padding: var(--space-8);">
        <header class="text-center mb-8">
            <div class="brand mx-auto mb-6" style="justify-content: center;">
                <span class="brand-mark">E</span>
                <span>ExamConnect</span>
            </div>
            <h1 style="margin-bottom: var(--space-2);">Welcome back</h1>
            <p style="color: var(--color-text-muted);">Sign in to continue your exam preparation journey</p>
        </header>

        <?php if(session('status')): ?>
            <div class="alert alert-success mb-6" role="status"><?php echo e(session('status')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error mb-6" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" novalidate>
            <?php echo csrf_field(); ?>

            <div class="form-group" style="margin-bottom: var(--space-5);">
                <label for="email" class="form-label">Email address <span class="text-error" aria-hidden="true">*</span></label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" class="form-input">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="form-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-5);">
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="form-label mb-0">Password <span class="text-error" aria-hidden="true">*</span></label>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-link text-sm">Forgot password?</a>
                </div>
                <input type="password" id="password" name="password" required autocomplete="current-password" class="form-input">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="form-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-6);">
                <label class="form-checkbox-label">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    Remember me
                </label>
            </div>

            <button class="button button-primary button-block button-lg" type="submit">Sign in</button>
        </form>

        <p class="text-center mt-6" style="color: var(--color-text-muted);">
            Don't have an account?
            <a href="<?php echo e(route('register')); ?>" class="text-link ml-2">Create one</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/auth/login.blade.php ENDPATH**/ ?>