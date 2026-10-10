<?php $__env->startSection('title', 'Share an experience · ExamConnect'); ?>

<?php $__env->startSection('content'); ?>

<div class="form-page" style="max-width: 800px;">

    <header class="page-heading" style="margin-bottom: var(--space-8);">
        <div class="eyebrow">Help the next candidate</div>
        <h1>Share your exam experience</h1>
        <p style="color: var(--color-text-muted);">
            Describe only what you personally remember. Your submission goes to moderation before publication.
        </p>
    </header>

    <form method="POST" action="<?php echo e(route('experiences.store')); ?>" novalidate>
        <?php echo csrf_field(); ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <fieldset class="mb-6">
            <legend class="form-label" style="font-size: var(--text-lg); margin-bottom: var(--space-5);">
                Exam details
            </legend>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="exam_id" class="form-label">
                        Examination <span class="text-error" aria-hidden="true">*</span>
                    </label>

                    <select id="exam_id" name="exam_id" class="form-select" required>
                        <option value="">Choose exam</option>
                        <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($exam->id); ?>"
                                <?php echo e(old('exam_id', $experience?->exam_id ?? request('exam_id')) == $exam->id ? 'selected' : ''); ?>>
                                <?php echo e($exam->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <?php $__errorArgs = ['exam_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="exam_date" class="form-label">Exam date</label>
                    <input
                        type="date"
                        id="exam_date"
                        name="exam_date"
                        max="<?php echo e(now()->toDateString()); ?>"
                        value="<?php echo e(old('exam_date', $experience?->exam_date?->format('Y-m-d') ?? '')); ?>"
                        class="form-input"
                    >

                    <?php $__errorArgs = ['exam_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="exam_year" class="form-label">Exam year</label>
                    <input type="number" id="exam_year" name="exam_year" min="2000" max="2100"
                        value="<?php echo e(old('exam_year', $experience?->exam_year ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['exam_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="shift" class="form-label">Shift / session</label>
                    <input type="text" id="shift" name="shift" maxlength="50"
                        placeholder="e.g. Shift 2"
                        value="<?php echo e(old('shift', $experience?->shift ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['shift'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="stage" class="form-label">Stage</label>
                    <input type="text" id="stage" name="stage" maxlength="100"
                        placeholder="e.g. CBT 1"
                        value="<?php echo e(old('stage', $experience?->stage ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['stage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="language" class="form-label">Language</label>
                    <select id="language" name="language" class="form-select">
                        <option value="en" <?php echo e(old('language', $experience?->language ?? 'en') === 'en' ? 'selected' : ''); ?>>English</option>
                        <option value="hi" <?php echo e(old('language', $experience?->language ?? 'en') === 'hi' ? 'selected' : ''); ?>>Hindi</option>
                        <option value="hinglish" <?php echo e(old('language', $experience?->language ?? 'en') === 'hinglish' ? 'selected' : ''); ?>>Hinglish</option>
                    </select>

                    <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="difficulty" class="form-label">Overall difficulty</label>
                    <select id="difficulty" name="difficulty" class="form-select">
                        <option value="">Choose rating</option>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo e($i); ?>"
                                <?php echo e(old('difficulty', $experience?->difficulty ?? '') == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?> / 5
                                <?php echo e([1 => 'Very easy', 2 => 'Easy', 3 => 'Moderate', 4 => 'Difficult', 5 => 'Very difficult'][$i]); ?>

                            </option>
                        <?php endfor; ?>
                    </select>

                    <?php $__errorArgs = ['difficulty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="attempted_count" class="form-label">Questions attempted</label>
                    <input type="number" id="attempted_count" name="attempted_count" min="0" max="500"
                        value="<?php echo e(old('attempted_count', $experience?->attempted_count ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['attempted_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="estimated_correct" class="form-label">Estimated correct</label>
                    <input type="number" id="estimated_correct" name="estimated_correct" min="0" max="500"
                        value="<?php echo e(old('estimated_correct', $experience?->estimated_correct ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['estimated_correct'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="estimated_incorrect" class="form-label">Estimated incorrect</label>
                    <input type="number" id="estimated_incorrect" name="estimated_incorrect" min="0" max="500"
                        value="<?php echo e(old('estimated_incorrect', $experience?->estimated_incorrect ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['estimated_incorrect'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="good_attempt" class="form-label">Good attempt</label>
                    <input type="number" id="good_attempt" name="good_attempt" min="0" max="500"
                        value="<?php echo e(old('good_attempt', $experience?->good_attempt ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['good_attempt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="center_region" class="form-label">Center region</label>
                    <input type="text" id="center_region" name="center_region" maxlength="100"
                        placeholder="City / Region"
                        value="<?php echo e(old('center_region', $experience?->center_region ?? '')); ?>" class="form-input">

                    <?php $__errorArgs = ['center_region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-6">
            <legend class="form-label" style="font-size: var(--text-lg); margin-bottom: var(--space-5);">
                Subject difficulty (optional)
            </legend>

            <?php
                $subjectDifficulties = $experience?->subject_difficulties ?? [];
            ?>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="subject_quant" class="form-label">Quantitative Aptitude</label>
                    <select id="subject_quant" name="subject_difficulties[quant]" class="form-select">
                        <option value="">Not rated</option>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo e($i); ?>"
                                <?php echo e(old('subject_difficulties.quant', $subjectDifficulties['quant'] ?? '') == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?> / 5
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_reasoning" class="form-label">Logical Reasoning</label>
                    <select id="subject_reasoning" name="subject_difficulties[reasoning]" class="form-select">
                        <option value="">Not rated</option>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo e($i); ?>"
                                <?php echo e(old('subject_difficulties.reasoning', $subjectDifficulties['reasoning'] ?? '') == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?> / 5
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="subject_english" class="form-label">English Language</label>
                    <select id="subject_english" name="subject_difficulties[english]" class="form-select">
                        <option value="">Not rated</option>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo e($i); ?>"
                                <?php echo e(old('subject_difficulties.english', $subjectDifficulties['english'] ?? '') == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?> / 5
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_gk" class="form-label">General Awareness</label>
                    <select id="subject_gk" name="subject_difficulties[gk]" class="form-select">
                        <option value="">Not rated</option>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo e($i); ?>"
                                <?php echo e(old('subject_difficulties.gk', $subjectDifficulties['gk'] ?? '') == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?> / 5
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="subject_other" class="form-label">Other / Technical</label>
                <select id="subject_other" name="subject_difficulties[other]" class="form-select">
                    <option value="">Not rated</option>
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo e($i); ?>"
                            <?php echo e(old('subject_difficulties.other', $subjectDifficulties['other'] ?? '') == $i ? 'selected' : ''); ?>>
                            <?php echo e($i); ?> / 5
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </fieldset>

        <fieldset class="mb-6">
            <legend class="form-label" style="font-size: var(--text-lg); margin-bottom: var(--space-5);">
                Your experience
            </legend>

            <div class="form-group">
                <label for="title" class="form-label">
                    Experience title <span class="text-error" aria-hidden="true">*</span>
                </label>
                <input type="text" id="title" name="title" required minlength="8" maxlength="180"
                    value="<?php echo e(old('title', $experience?->title ?? '')); ?>"
                    placeholder="What should future candidates know?" class="form-input">

                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="form-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="summary" class="form-label">Short summary</label>
                <textarea id="summary" name="summary" rows="3" maxlength="500"
                    class="form-input"
                    placeholder="A brief overview of your experience..."><?php echo e(old('summary', $experience?->summary ?? '')); ?></textarea>

                <?php $__errorArgs = ['summary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="form-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="body" class="form-label">Full experience</label>
                <textarea id="body" name="body" rows="7" maxlength="20000"
                    class="form-input"
                    placeholder="Describe the paper, environment and what you personally observed."><?php echo e(old('body', $experience?->body ?? '')); ?></textarea>

                <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="form-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <p class="form-hint">
                    Be specific: question patterns, difficulty shifts, time pressure, surprises. Avoid hearsay.
                </p>
            </div>
        </fieldset>

        <fieldset class="mb-6">
            <legend class="form-label" style="font-size: var(--text-lg); margin-bottom: var(--space-5);">
                Additional insights (optional)
            </legend>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="time_management" class="form-label">Time management</label>
                    <textarea id="time_management" name="time_management" rows="3"
                        class="form-input"><?php echo e(old('time_management', $experience?->time_management ?? '')); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="unexpected_topics" class="form-label">Unexpected topics</label>
                    <textarea id="unexpected_topics" name="unexpected_topics" rows="3"
                        class="form-input"><?php echo e(old('unexpected_topics', $experience?->unexpected_topics ?? '')); ?></textarea>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="exam_day_notes" class="form-label">Exam-day notes</label>
                    <textarea id="exam_day_notes" name="exam_day_notes" rows="3"
                        class="form-input"><?php echo e(old('exam_day_notes', $experience?->exam_day_notes ?? '')); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="preparation_strategy" class="form-label">Preparation strategy</label>
                    <textarea id="preparation_strategy" name="preparation_strategy" rows="3"
                        class="form-input"><?php echo e(old('preparation_strategy', $experience?->preparation_strategy ?? '')); ?></textarea>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="recommended_resources" class="form-label">Recommended resources</label>
                    <textarea id="recommended_resources" name="recommended_resources" rows="3"
                        class="form-input"><?php echo e(old('recommended_resources', $experience?->recommended_resources ?? '')); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="mistakes_to_avoid" class="form-label">Mistakes to avoid</label>
                    <textarea id="mistakes_to_avoid" name="mistakes_to_avoid" rows="3"
                        class="form-input"><?php echo e(old('mistakes_to_avoid', $experience?->mistakes_to_avoid ?? '')); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="advice" class="form-label">Advice for future candidates</label>
                <textarea id="advice" name="advice" rows="4"
                    class="form-input"><?php echo e(old('advice', $experience?->advice ?? '')); ?></textarea>
            </div>
        </fieldset>

        <fieldset class="mb-6">
            <legend class="form-label" style="font-size: var(--text-lg); margin-bottom: var(--space-5);">
                Privacy
            </legend>

            <div class="form-group">
                <label class="form-checkbox-label">
                    <input
                        type="checkbox"
                        name="anonymous_author"
                        value="1"
                        <?php echo e(old('anonymous_author', $experience?->anonymous_author ?? false) ? 'checked' : ''); ?>

                        class="form-checkbox"
                    >
                    Publish this experience anonymously
                </label>
            </div>
        </fieldset>

        <p class="form-hint" style="margin-bottom: var(--space-6);">
            Your post is labelled <strong>candidate-reported</strong>.
            It will not be public until moderation approves it.
            Do not include personal data or confidential material.
        </p>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="button button-primary button-lg">
                Submit for review
            </button>

            <a href="<?php echo e(route('exams.index')); ?>" class="button button-ghost button-lg">
                Cancel
            </a>
        </div>

    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/experiences/create.blade.php ENDPATH**/ ?>