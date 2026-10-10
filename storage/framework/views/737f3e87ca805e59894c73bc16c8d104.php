<?php $__env->startSection('title', 'Content reports · Admin · ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Trust and safety</div>
    <h1>Content reports</h1>
    <p>Review candidate-submitted flags. A report is an allegation, not proof that the content is false.</p>
</header>

<?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <span class="status-pill <?php echo e($report->status === 'resolved' ? 'status-pill-success' : ($report->status === 'dismissed' ? 'status-pill-muted' : 'status-pill-primary')); ?>">
                    <?php echo e(ucfirst($report->status)); ?>

                </span>
                <span class="text-sm" style="color: var(--color-text-muted);"><?php echo e($report->created_at); ?></span>
                <span class="text-sm" style="color: var(--color-text-muted);">Reason: <?php echo e(ucfirst($report->reason)); ?></span>
            </div>

            <h3 style="margin-bottom: var(--space-2);"><?php echo e($report->experience_title ?: 'Experience unavailable or deleted'); ?></h3>
            <p class="text-sm mb-3" style="color: var(--color-text-muted);">Reported by <?php echo e($report->reporter_name ?: 'Deleted user'); ?></p>

            <?php if($report->details): ?>
                <p style="margin-bottom: var(--space-4);"><?php echo e($report->details); ?></p>
            <?php endif; ?>

            <?php if($report->resolution_note): ?>
                <p style="margin-bottom: var(--space-4);"><strong>Previous note:</strong> <?php echo e($report->resolution_note); ?></p>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.reports.update', $report->id)); ?>" class="flex flex-wrap items-end gap-3" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border-soft);">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="form-group" style="margin-bottom: 0; min-width: 200px;">
                    <label for="report_status_<?php echo e($report->id); ?>" class="form-label">Status</label>
                    <select id="report_status_<?php echo e($report->id); ?>" name="status" class="form-select">
                        <option value="reviewing" <?php echo e($report->status === 'reviewing' ? 'selected' : ''); ?>>Reviewing</option>
                        <option value="resolved" <?php echo e($report->status === 'resolved' ? 'selected' : ''); ?>>Resolved</option>
                        <option value="dismissed" <?php echo e($report->status === 'dismissed' ? 'selected' : ''); ?>>Dismiss report</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 250px;">
                    <label for="report_note_<?php echo e($report->id); ?>" class="form-label">Resolution note</label>
                    <textarea id="report_note_<?php echo e($report->id); ?>" name="resolution_note" rows="2" maxlength="1500" class="form-input"><?php echo e($report->resolution_note); ?></textarea>
                </div>

                <button class="button button-primary" type="submit">Save decision</button>
            </form>
        </div>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-success-light); color: var(--color-success);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <h3>No reports found</h3>
        <p>New reports from candidate experiences will appear here.</p>
    </div>
<?php endif; ?>

<div class="pagination"><?php echo e($reports->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/admin/reports.blade.php ENDPATH**/ ?>