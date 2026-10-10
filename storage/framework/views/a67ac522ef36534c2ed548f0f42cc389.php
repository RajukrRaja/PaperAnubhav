<?php $__env->startSection('title', ($exam->meta_title ?: $exam->name) . ' · ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="flex flex-col gap-2">
        <div class="eyebrow"><?php echo e($exam->category?->name ?? 'Examination'); ?> / Candidate community</div>
        <h1><?php echo e($exam->name); ?></h1>
    </div>
    <p style="margin-top: var(--space-4); max-width: 700px;"><?php echo e($exam->description); ?></p>

    <?php if($exam->conducting_authority): ?>
        <p style="margin-top: var(--space-4);"><strong>Conducting authority:</strong> <?php echo e($exam->conducting_authority); ?></p>
    <?php endif; ?>

    <?php if($exam->official_url): ?>
        <a class="text-link" href="<?php echo e($exam->official_url); ?>" target="_blank" rel="noopener noreferrer" style="margin-top: var(--space-4); display: inline-flex; align-items: center; gap: var(--space-2);">
            Official website
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
        </a>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <div class="mt-5">
            <?php if(auth()->user()->followedExams()->where('exams.id', $exam->id)->exists()): ?>
                <form method="POST" action="<?php echo e(route('exams.unfollow', $exam)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="button button-ghost" type="submit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        Following this exam · Remove
                    </button>
                </form>
            <?php else: ?>
                <form method="POST" action="<?php echo e(route('exams.follow', $exam)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="button button-primary" type="submit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        Follow exam
                    </button>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</header>

<section class="section-head">
    <div>
        <h2>Candidate experiences</h2>
        <p>These are community-submitted reports, not official exam information.</p>
    </div>
    <?php if(auth()->guard()->check()): ?>
        <a class="button button-primary" href="<?php echo e(route('experiences.create', ['exam_id' => $exam->id])); ?>">Share your experience</a>
    <?php else: ?>
        <a class="button button-primary" href="<?php echo e(route('register')); ?>">Share your experience</a>
    <?php endif; ?>
</section>

<?php $__empty_1 = true; $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="card experience-card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <time class="text-sm" style="color: var(--color-text-muted);">
                    <?php echo e($experience->exam_date?->format('d M Y') ?? 'Date not provided'); ?>

                </time>
                <span class="text-sm" style="color: var(--color-text-muted);">·</span>
                <span class="text-sm" style="color: var(--color-text-muted);"><?php echo e($experience->shift ?: 'Shift not specified'); ?></span>
                <span class="status-pill status-pill-candidate-reported">Candidate-reported</span>
            </div>
            <h3 style="margin-bottom: var(--space-3);">
                <a href="<?php echo e(route('experiences.show', $experience)); ?>" class="text-link" style="color: var(--color-text);">
                    <?php echo e($experience->title); ?>

                </a>
            </h3>
            <p style="margin-bottom: var(--space-4);"><?php echo e($experience->summary); ?></p>
            <div class="flex flex-wrap items-center gap-4">
                <span class="text-sm" style="color: var(--color-text-muted);">
                    By <?php echo e($experience->anonymous_author ? 'Anonymous candidate' : '@' . $experience->user->username); ?>

                </span>
                <?php if($experience->difficulty): ?>
                    <span class="badge badge-primary">
                        Difficulty <?php echo e($experience->difficulty); ?>/5
                    </span>
                <?php else: ?>
                    <span class="badge badge-muted">Not rated</span>
                <?php endif; ?>
                <?php if($experience->likes_count > 0): ?>
                    <span class="text-sm" style="color: var(--color-text-muted); display: flex; align-items: center; gap: var(--space-1);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <?php echo e($experience->likes_count); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>
    </article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
        </div>
        <h3>No reviews published yet</h3>
        <p>Help other candidates by sharing your experience after the exam.</p>
    </div>
<?php endif; ?>

<div class="pagination"><?php echo e($experiences->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/exams/show.blade.php ENDPATH**/ ?>