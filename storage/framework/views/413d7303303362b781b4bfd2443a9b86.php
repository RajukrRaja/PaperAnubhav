<?php $__env->startSection('title', 'Site settings — Admin'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $values = $settings->keyBy('key');
?>

<div class="form-page" style="max-width: 700px;">
    <header class="page-heading" style="margin-bottom: var(--space-8);">
        <div class="eyebrow">Administration</div>
        <h1>Platform settings</h1>
        <p style="color: var(--color-text-muted);">Manage site identity, community rules and registration preferences.</p>
    </header>

    <form method="POST" action="<?php echo e(route('admin.settings.save')); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label for="site_name" class="form-label">Site name <span class="text-error" aria-hidden="true">*</span></label>
            <input type="text" id="site_name" name="site_name" value="<?php echo e(old('site_name', $values['site_name']->value ?? 'ExamConnect')); ?>" required maxlength="100" class="form-input">
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" id="tagline" name="tagline" value="<?php echo e(old('tagline', $values['tagline']->value ?? 'Real candidate experiences')); ?>" maxlength="200" class="form-input">
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label for="community_guidelines" class="form-label">Community guidelines</label>
            <textarea id="community_guidelines" name="community_guidelines" rows="6" class="form-input"><?php echo e(old('community_guidelines', $values['community_guidelines']->value ?? 'Be respectful. Do not publish fabricated experiences. Clearly label remembered questions as candidate-reported.')); ?></textarea>
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label class="form-checkbox-label">
                <input type="checkbox" name="allow_registration" value="1" <?php echo e(old('allow_registration', ($values['allow_registration']->value ?? '1') === '1') ? 'checked' : ''); ?> class="form-checkbox">
                Allow new registrations (preference saved; enforcement must be wired into registration)
            </label>
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label class="form-checkbox-label">
                <input type="checkbox" name="maintenance_mode" value="1" <?php echo e(old('maintenance_mode', ($values['maintenance_mode']->value ?? '0') === '1') ? 'checked' : ''); ?> class="form-checkbox">
                Maintenance mode preference (saved for future middleware enforcement)
            </label>
        </div>

        <button class="button button-primary" type="submit">Save settings</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/admin/settings.blade.php ENDPATH**/ ?>