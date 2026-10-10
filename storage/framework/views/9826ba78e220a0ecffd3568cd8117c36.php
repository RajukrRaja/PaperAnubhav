<?php $__env->startSection('title', 'Discover People — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1>Discover People</h1>
    <p>Find candidates, connect with students, and grow your exam preparation network.</p>
</header>

<?php if(session('success')): ?>
    <div class="alert alert-success" role="status"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-error" role="alert">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $currentUser = auth()->user();

        $isFollowing = $currentUser->following()
            ->where('users.id', $person->id)
            ->exists();

        $followsMe = $person->following()
            ->where('users.id', $currentUser->id)
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
            </a>

            <div class="flex-1 min-w-0">
                <h3 style="margin-bottom: var(--space-1);">
                    <a href="<?php echo e(route('profile.public', $person->username)); ?>" class="text-link" style="color: var(--color-text);"><?php echo e($person->name); ?></a>
                </h3>

                <p class="text-sm mb-1" style="color: var(--color-text-muted); margin: 0;"><?php echo e('@' . $person->username); ?></p>

                <p class="text-sm mb-2" style="color: var(--color-text-muted); margin: 0;"><?php echo e($person->followers_count); ?> followers</p>

                <?php if($followsMe && $isFollowing): ?>
                    <span class="badge badge-success text-xs">Mutual connection</span>
                <?php elseif($followsMe): ?>
                    <span class="badge badge-primary text-xs">Follows you</span>
                <?php endif; ?>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <?php if($isFollowing): ?>
                    <form method="POST" action="<?php echo e(route('users.unfollow', $person)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="button button-ghost button-small" type="submit">Following</button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('users.follow', $person)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button class="button button-primary button-small" type="submit"><?php echo e($followsMe ? 'Follow Back' : 'Follow'); ?></button>
                    </form>
                <?php endif; ?>

                <a class="button button-ghost button-small" href="<?php echo e(route('messages.show', $person->username)); ?>">Message</a>
                <a class="button button-ghost button-small" href="<?php echo e(route('profile.public', $person->username)); ?>">View Profile</a>
            </div>
        </a>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <h3>No new people to discover</h3>
        <p>You are already following everyone currently available, or no active candidate profiles are available yet.</p>
    </div>
<?php endif; ?>

<?php if($users->hasPages()): ?>
    <div class="pagination"><?php echo e($users->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/social/people.blade.php ENDPATH**/ ?>