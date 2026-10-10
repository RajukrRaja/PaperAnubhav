<?php $__env->startSection('title', 'Messages — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1>Messages</h1>
    <p>Your direct message conversations.</p>
</header>

<?php if(session('success')): ?>
    <div class="alert alert-success" role="status"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="card" style="margin-bottom: var(--space-3); overflow: hidden;">
        <a href="<?php echo e(route('messages.show', $person->username)); ?>" class="flex items-center gap-4 p-4" style="text-decoration: none; color: inherit; transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-border-soft)'" onmouseout="this.style.background='transparent'">
            <div class="avatar avatar-md">
                <?php if($person->avatar_path): ?>
                    <img src="<?php echo e(asset('storage/' . $person->avatar_path)); ?>" alt="<?php echo e($person->name); ?>">
                <?php else: ?>
                    <?php echo e(strtoupper(substr($person->name, 0, 1))); ?>

                <?php endif; ?>
            </div>

            <div class="flex-1 min-w-0">
                <h3 style="margin-bottom: var(--space-1);"><?php echo e($person->name); ?></h3>
                <p class="text-sm" style="color: var(--color-text-muted); margin: 0;"><?php echo e('@' . $person->username); ?></p>
            </div>

            <span class="text-link text-sm font-medium">Open chat →</span>
        </a>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <h3>No conversations yet</h3>
        <p>Visit a member profile and select Message to start a conversation.</p>
        <a href="<?php echo e(route('people.index')); ?>" class="button button-primary mt-4">Discover people</a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/messages/index.blade.php ENDPATH**/ ?>