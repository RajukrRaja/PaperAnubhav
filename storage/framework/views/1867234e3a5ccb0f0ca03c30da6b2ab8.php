<?php $__env->startSection('title', 'Saved experiences · ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Your library</div>
    <h1>Bookmarked experiences</h1>
</header>

<?php $__empty_1 = true; $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="card experience-card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="card-meta mb-3">
                <span class="text-sm" style="color: var(--color-text-muted);"><?php echo e($bookmark->experience->exam->name); ?></span>
            </div>

            <h3 style="margin-bottom: var(--space-3);">
                <a href="<?php echo e(route('experiences.show', $bookmark->experience)); ?>" class="text-link" style="color: var(--color-text);">
                    <?php echo e($bookmark->experience->title); ?>

                </a>
            </h3>

            <p style="margin-bottom: var(--space-4);"><?php echo e($bookmark->experience->summary); ?></p>

            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm" style="color: var(--color-text-muted);">
                    By <?php echo e($bookmark->experience->anonymous_author ? 'Anonymous candidate' : '@' . $bookmark->experience->user->username); ?>

                </span>
                <?php if($bookmark->experience->difficulty): ?>
                    <span class="badge badge-primary">
                        Difficulty <?php echo e($bookmark->experience->difficulty); ?>/5
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <h3>No bookmarks yet</h3>
        <p>Save useful experiences to return to them later.</p>
        <a class="button button-primary mt-4" href="<?php echo e(route('exams.index')); ?>">Explore exams</a>
    </div>
<?php endif; ?>

<div class="pagination"><?php echo e($experiences->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/profile/bookmarks.blade.php ENDPATH**/ ?>