
<div class="directory-toolbar">
    <div>
        <span class="toolbar-label">BROWSE EXAMS</span>
        <span class="toolbar-detail">
            Explore examinations and candidate experiences
        </span>
    </div>

    <div class="result-count">
        <?php echo e($exams->total()); ?>

        <?php echo e($exams->total() === 1 ? 'examination' : 'examinations'); ?>

    </div>
</div>

<section class="exam-list" aria-label="Examination results">
    <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="exam-row">
            <div class="exam-symbol" aria-hidden="true">
                <?php echo e(strtoupper(substr($exam->name ?? 'E', 0, 1))); ?>

            </div>

            <div class="exam-information">
                <div class="exam-meta">
                    <span class="exam-category">
                        <?php echo e($exam->category?->name ?? 'Examination'); ?>

                    </span>
                </div>

                <h2 class="exam-name">
                    <a href="<?php echo e(route('exams.show', $exam)); ?>">
                        <?php echo e($exam->name); ?>

                    </a>
                </h2>

                <p class="exam-description">
                    <?php echo e(filled($exam->description)
                        ? \Illuminate\Support\Str::limit($exam->description, 180)
                        : 'Explore candidate reviews and preparation insights.'); ?>

                </p>

                <div class="exam-bottom-meta">
                    <span class="experience-count">
                        <strong><?php echo e($exam->experiences_count ?? 0); ?></strong>
                        <?php echo e((int) ($exam->experiences_count ?? 0) === 1
                            ? 'experience'
                            : 'experiences'); ?>

                    </span>
                </div>
            </div>

            <div class="exam-action">
                <a href="<?php echo e(route('exams.show', $exam)); ?>"
                   class="explore-link">
                    Explore exam →
                </a>
            </div>
        </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="directory-empty">
            <h2>No examinations found</h2>
            <p>
                No exams match your search. Try a different name or keyword.
            </p>
        </div>
    <?php endif; ?>
</section>

<?php if($exams->hasPages()): ?>
    <div class="directory-pagination">
        <?php echo e($exams->onEachSide(1)->links()); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\ExamConnect\resources\views/exams/partials/results.blade.php ENDPATH**/ ?>