<?php $__env->startSection('title', 'Join ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page" style="max-width: 420px; margin: 0 auto; padding: var(--space-12) var(--container-gutter);">
    <div class="card" style="padding: var(--space-8);">
        <header class="text-center mb-8">
            <div class="brand mx-auto mb-6" style="justify-content: center;">
                <span class="brand-mark">E</span>
                <span>ExamConnect</span>
            </div>
            <h1 style="margin-bottom: var(--space-2);">Join the community</h1>
            <p style="color: var(--color-text-muted);">Share experiences, connect with candidates, prepare better</p>
        </header>

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

        <form method="POST" action="<?php echo e(route('register')); ?>" novalidate>
            <?php echo csrf_field(); ?>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="name" class="form-label">Display name <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required maxlength="100" class="form-input">
                    <?php $__errorArgs = ['name'];
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

                <div class="form-group">
                    <label for="username" class="form-label">Username <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>" required maxlength="30" class="form-input">
                    <?php $__errorArgs = ['username'];
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
            </div>

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

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password" class="form-input">
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

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm password <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="form-input">
                    <?php $__errorArgs = ['password_confirmation'];
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
            </div>

            <p class="form-hint mb-6">By creating an account, you agree to our <a href="#" class="text-link">Terms of Service</a> and <a href="#" class="text-link">Privacy Policy</a>.</p>

            <button class="button button-primary button-block button-lg" type="submit">Create account</button>
        </form>

        <p class="text-center mt-6" style="color: var(--color-text-muted);">
            Already have an account?
            <a href="<?php echo e(route('login')); ?>" class="text-link ml-2">Sign in</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/auth/register.blade.php ENDPATH**/ ?>