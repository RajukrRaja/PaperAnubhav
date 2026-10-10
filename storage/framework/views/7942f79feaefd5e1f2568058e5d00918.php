<?php $__env->startSection('title', 'User management — Admin'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Administration</div>
    <h1>User management</h1>
    <p>Search accounts, change roles, edit public identity, activate or disable access, and remove accounts.</p>
</header>

<form method="GET" class="search-form flex flex-wrap gap-3" style="margin-bottom: var(--space-6);">
    <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 250px;">
        <label for="user_search" class="sr-only">Search users</label>
        <input type="search" id="user_search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search name, username or email" class="form-input">
    </div>

    <div class="form-group" style="margin-bottom: 0;">
        <label for="user_status" class="sr-only">Filter by status</label>
        <select id="user_status" name="status" class="form-select">
            <option value="">All accounts</option>
            <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
            <option value="disabled" <?php echo e(request('status') === 'disabled' ? 'selected' : ''); ?>>Disabled</option>
        </select>
    </div>

    <button class="button button-primary" type="submit">Filter</button>
</form>

<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="card admin-user-card" style="margin-bottom: var(--space-4);">
        <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-2" style="margin-bottom: var(--space-4);">
                <div class="form-group">
                    <label for="name_<?php echo e($user->id); ?>" class="form-label">Name</label>
                    <input type="text" id="name_<?php echo e($user->id); ?>" name="name" value="<?php echo e($user->name); ?>" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="username_<?php echo e($user->id); ?>" class="form-label">Username</label>
                    <input type="text" id="username_<?php echo e($user->id); ?>" name="username" value="<?php echo e($user->username); ?>" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="email_<?php echo e($user->id); ?>" class="form-label">Email</label>
                    <input type="email" id="email_<?php echo e($user->id); ?>" name="email" value="<?php echo e($user->email); ?>" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="role_<?php echo e($user->id); ?>" class="form-label">Role</label>
                    <select id="role_<?php echo e($user->id); ?>" name="role" class="form-select">
                        <option value="user" <?php echo e($user->role === 'user' ? 'selected' : ''); ?>>User</option>
                        <option value="moderator" <?php echo e($user->role === 'moderator' ? 'selected' : ''); ?>>Moderator</option>
                        <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_<?php echo e($user->id); ?>" class="form-label">Status</label>
                    <select id="status_<?php echo e($user->id); ?>" name="is_active" class="form-select">
                        <option value="1" <?php echo e($user->is_active ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e(!$user->is_active ? 'selected' : ''); ?>>Disabled</option>
                    </select>
                </div>
            </div>

            <p class="text-sm" style="color: var(--color-text-muted); margin-bottom: var(--space-4);">
                ID <?php echo e($user->id); ?> · Joined <?php echo e($user->created_at->format('M j, Y')); ?> · <?php echo e($user->experiences()->count()); ?> reviews
            </p>

            <button class="button button-primary button-small" type="submit">Save changes</button>
        </form>

        <div class="card-footer" style="border-top: 1px solid var(--color-border-soft); padding-top: var(--space-4); margin-top: var(--space-4);">
            <div class="flex flex-wrap gap-3">
                <form method="POST" action="<?php echo e(route('admin.users.toggle', $user)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button class="button button-ghost button-small" <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?> type="submit">
                        <?php echo e($user->is_active ? 'Disable account' : 'Activate account'); ?>

                    </button>
                </form>

                <form method="POST" action="<?php echo e(route('admin.users.delete', $user)); ?>" class="d-inline" onsubmit="return confirm('Permanently delete this user and related data?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="button button-danger button-small" <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?> type="submit">Delete user</button>
                </form>
            </div>
        </div>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <p>No users found.</p>
    </div>
<?php endif; ?>

<div class="pagination"><?php echo e($users->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/admin/users.blade.php ENDPATH**/ ?>