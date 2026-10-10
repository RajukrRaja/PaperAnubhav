<?php $__env->startSection('title', 'Post management — Admin'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Administration</div>
    <h1>Post management</h1>
    <p>Review published, pending, draft and rejected candidate experiences.</p>
</header>

<form method="GET" class="search-form flex flex-wrap gap-3" style="margin-bottom: var(--space-6);">
    <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 250px;">
        <label for="post_search" class="sr-only">Search posts</label>
        <input type="search" id="post_search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search post title" class="form-input">
    </div>

    <div class="form-group" style="margin-bottom: 0;">
        <label for="post_status" class="sr-only">Filter by status</label>
        <select id="post_status" name="status" class="form-select">
            <option value="">All statuses</option>
            <?php $__currentLoopData = ['pending', 'published', 'draft', 'rejected', 'needs_corrections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status); ?>" <?php echo e(request('status') === $status ? 'selected' : ''); ?>>
                    <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <button class="button button-primary" type="submit">Filter</button>
</form>

<?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <span class="text-sm" style="color: var(--color-text-muted);"><?php echo e($post->exam->name); ?></span>
                <span style="color: var(--color-text-muted);">·</span>
                <span class="text-sm" style="color: var(--color-text-muted);"><?php echo e($post->user->name); ?></span>
                <span class="status-pill <?php echo e($post->status === 'published' ? 'status-pill-published' : ($post->status === 'pending' ? 'status-pill-pending' : ($post->status === 'rejected' ? 'status-pill-rejected' : 'status-pill-draft'))); ?>">
                    <?php echo e(ucfirst(str_replace('_', ' ', $post->status))); ?>

                </span>
            </div>

            <h3 style="margin-bottom: var(--space-2);"><?php echo e($post->title); ?></h3>
            <p style="margin-bottom: var(--space-4);"><?php echo e($post->summary); ?></p>

            <div class="flex flex-wrap items-center gap-3">
                <a class="text-link text-sm" href="<?php echo e(route('experiences.show', $post)); ?>" target="_blank">Open public page</a>

                <form method="POST" action="<?php echo e(route('admin.posts.update', $post)); ?>" class="d-inline flex items-center gap-2">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <select name="status" class="form-select" style="width: auto;">
                        <?php $__currentLoopData = ['draft', 'pending', 'published', 'rejected', 'needs_corrections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php echo e($post->status === $status ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="button button-primary button-small" type="submit">Update status</button>
                </form>
            </div>
        </div>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <p>No posts match these filters.</p>
    </div>
<?php endif; ?>

<div class="pagination"><?php echo e($posts->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/admin/posts.blade.php ENDPATH**/ ?>