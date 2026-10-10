<?php $__env->startSection('title', ucfirst($type) . ' — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1><?php echo e(ucfirst($type)); ?></h1>
    <a class="button button-ghost" href="<?php echo e(route('profile.show')); ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline mr-1">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Back to profile
    </a>
</header>

<?php if(session('success')): ?>
    <div class="alert alert-success" role="status"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $isFollowing = auth()->user()
            ->following()
            ->where('users.id', $person->id)
            ->exists();

        $followsMe = $person
            ->following()
            ->where('users.id', auth()->id())
            ->exists();
    ?>

    <article class="card" style="margin-bottom: var(--space-4); overflow: hidden;">
        <a href="<?php echo e(route('profile.public', $person->username)); ?>" class="flex items-center gap-4 p-4" style="text-decoration: none; color: inherit; transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-border-soft)'" onmouseout="this.style.background='transparent'">
            <div class="avatar avatar-md">
                <?php if($person->avatar_path): ?>
                    <img src="<?php echo e(asset('storage/' . $person->avatar_path)); ?>" alt="<?php echo e($person->name); ?>">
                <?php else: ?>
                    <?php echo e(strtoupper(substr($person->name, 0, 1))); ?>

                <?php endif; ?>
            </div>

            <div class="flex-1 min-w-0">
                <h3 style="margin-bottom: var(--space-1);">
                    <a href="<?php echo e(route('profile.public', $person->username)); ?>" class="text-link" style="color: var(--color-text);"><?php echo e($person->name); ?></a>
                </h3>

                <p class="text-sm mb-2" style="color: var(--color-text-muted); margin: 0;"><?php echo e('@' . $person->username); ?></p>

                <?php if($isFollowing && $followsMe): ?>
                    <span class="badge badge-success text-xs">You follow each other</span>
                <?php elseif($followsMe): ?>
                    <span class="badge badge-primary text-xs">Follows you</span>
                <?php endif; ?>
            </div>

            <?php if(auth()->id() !== $person->id): ?>
                <div class="flex flex-wrap items-center gap-2">
                    <?php if($isFollowing): ?>
                        <form method="POST" action="<?php echo e(route('users.unfollow', $person->id)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="button button-ghost button-small" type="submit">Following</button>
                        </form>
                    <?php else: ?>
                        <form method="POST" action="<?php echo e(route('users.follow', $person->id)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button class="button button-primary button-small" type="submit"><?php echo e($followsMe ? 'Follow Back' : 'Follow'); ?></button>
                        </form>
                    <?php endif; ?>

                    <a class="button button-ghost button-small" href="<?php echo e(route('messages.show', $person->username)); ?>">Message</a>
                </div>
            <?php endif; ?>
        </a>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
            </svg>
        </div>
        <h3>No <?php echo e($type); ?> yet</h3>
        <p>People you connect with will appear here.</p>
    </div>
<?php endif; ?>

<div class="pagination"><?php echo e($users->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/social/list.blade.php ENDPATH**/ ?>