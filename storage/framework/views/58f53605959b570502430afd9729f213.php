<?php $__env->startSection('title', 'Community — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1>ExamConnect Community</h1>
    <p>Join a group, meet other candidates and discuss exam experiences.</p>
</header>

<div class="grid grid-3" style="gap: var(--space-5);">
    <?php $__empty_1 = true; $__currentLoopData = $communities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $community): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php ($isMember = $community->members->isNotEmpty()); ?>
        <article class="card community-card" style="padding: var(--space-6); display: flex; flex-direction: column; height: 100%;">
            <span class="badge badge-primary mb-3" style="width: fit-content;"><?php echo e($community->category); ?></span>
            <h2 style="font-size: var(--text-xl); margin-bottom: var(--space-3);"><?php echo e($community->name); ?></h2>
            <p class="flex-1" style="color: var(--color-text-soft); margin-bottom: var(--space-4);"><?php echo e($community->description); ?></p>
            <p class="text-sm mb-4" style="color: var(--color-text-muted);"><?php echo e(number_format($community->members_count)); ?> members</p>

            <div class="flex flex-wrap gap-3 mt-auto">
                <?php if($isMember): ?>
                    <a class="button button-primary" href="<?php echo e(route('community.chat', $community)); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        Open live chat
                    </a>
                    <form method="POST" action="<?php echo e(route('community.leave', $community)); ?>" class="d-inline" onsubmit="return confirm('Leave this community?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="button button-ghost" type="submit">Leave</button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('community.join', $community)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button class="button button-primary" type="submit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <line x1="23" y1="21" x2="17" y2="17"></line>
                            </svg>
                            Join community
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state" style="grid-column: 1 / -1;">
            <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3>No communities available</h3>
            <p>Please check back later.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/community/index.blade.php ENDPATH**/ ?>