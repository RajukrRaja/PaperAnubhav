<?php $__env->startSection('title', 'Study tools · ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Your preparation workspace</div>
    <h1>Study tools</h1>
    <p>Set goals, log focused study sessions and keep important exams on your watchlist.</p>
</header>

<div class="grid grid-4 stats-grid" style="margin-bottom: var(--space-8);">
    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Study time this week</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);">
            <?php echo e(intdiv($minutesThisWeek, 60)); ?>h <?php echo e($minutesThisWeek % 60); ?>m
        </strong>
    </div>

    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Active goals</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);"><?php echo e($activeGoals); ?></strong>
    </div>

    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Tracked sessions</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);"><?php echo e($sessions->count()); ?></strong>
    </div>

    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Followed exams</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);"><?php echo e($followedExams->count()); ?></strong>
    </div>
</div>

<div class="grid grid-2" style="gap: var(--space-6);">
    <section class="card tool-panel" style="padding: var(--space-6);">
        <div class="section-head" style="margin-bottom: var(--space-5);">
            <h2>Study goals</h2>
        </div>

        <form method="POST" action="<?php echo e(route('tools.goals.store')); ?>" class="mb-6" style="padding-bottom: var(--space-5); border-bottom: 1px solid var(--color-border-soft);">
            <?php echo csrf_field(); ?>
            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="goal_title" class="form-label">Goal title</label>
                <input type="text" id="goal_title" name="title" required maxlength="180" placeholder="e.g. Finish Electrostatics revision" class="form-input">
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-4);">
                <div class="form-group">
                    <label for="goal_target" class="form-label">Target units</label>
                    <input type="number" id="goal_target" name="target" min="1" max="1000" value="5" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="goal_due_date" class="form-label">Due date</label>
                    <input type="date" id="goal_due_date" name="due_date" min="<?php echo e(now()->toDateString()); ?>" class="form-input">
                </div>
            </div>

            <button class="button button-primary" type="submit">Create goal</button>
        </form>

        <?php if($goals->isEmpty()): ?>
            <p class="text-sm" style="color: var(--color-text-muted); text-align: center; padding: var(--space-4);">
                Your goals will appear here after you create one.
            </p>
        <?php else: ?>
            <?php $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card" style="margin-bottom: var(--space-4); padding: var(--space-4);">
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <strong><?php echo e($goal->title); ?></strong>
                        <span class="status-pill <?php echo e($goal->completed ? 'status-pill-success' : 'status-pill-primary'); ?>">
                            <?php echo e($goal->completed ? 'Completed' : $goal->progress . '/' . $goal->target); ?>

                        </span>
                    </div>

                    <div class="level-track" style="height: 6px; background: var(--color-border-soft); border-radius: var(--radius-pill); overflow: hidden; margin-bottom: var(--space-3);">
                        <span style="width: <?php echo e(min(100, round(($goal->progress / max(1, $goal->target)) * 100))); ?>%; height: 100%; display: block; background: var(--color-primary); border-radius: var(--radius-pill);"></span>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <?php if(!$goal->completed): ?>
                            <form method="POST" action="<?php echo e(route('tools.goals.update', $goal)); ?>" class="flex items-center gap-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <label class="form-label mb-0 inline-flex items-center gap-2" style="font-size: var(--text-sm);">
                                    Progress
                                    <input type="number" name="progress" min="0" max="<?php echo e($goal->target); ?>" value="<?php echo e($goal->progress); ?>" required class="form-input" style="width: 80px;">
                                </label>
                                <button class="button button-primary button-small" type="submit">Save</button>
                            </form>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('tools.goals.destroy', $goal)); ?>" class="d-inline" onsubmit="return confirm('Remove this goal?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="button button-ghost button-small" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

    <section class="card tool-panel" style="padding: var(--space-6);">
        <div class="section-head" style="margin-bottom: var(--space-5);">
            <h2>Log a study session</h2>
        </div>

        <form method="POST" action="<?php echo e(route('tools.sessions.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="session_subject" class="form-label">Subject <span class="text-error" aria-hidden="true">*</span></label>
                <input type="text" id="session_subject" name="subject" required maxlength="120" placeholder="e.g. General Science" class="form-input">
            </div>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="session_topic" class="form-label">Topic</label>
                <input type="text" id="session_topic" name="topic" maxlength="180" placeholder="e.g. Electromagnetic induction" class="form-input">
            </div>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="session_exam" class="form-label">Related exam</label>
                <select id="session_exam" name="exam_id" class="form-select">
                    <option value="">No specific exam</option>
                    <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($exam->id); ?>"><?php echo e($exam->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-4);">
                <div class="form-group">
                    <label for="session_duration" class="form-label">Duration (minutes) <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="number" id="session_duration" name="duration_minutes" min="1" max="1440" required value="60" class="form-input">
                </div>

                <div class="form-group">
                    <label for="session_date" class="form-label">Date studied <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="date" id="session_date" name="studied_on" max="<?php echo e(now()->toDateString()); ?>" value="<?php echo e(now()->toDateString()); ?>" required class="form-input">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-4);">
                <label for="session_notes" class="form-label">Notes</label>
                <textarea id="session_notes" name="notes" rows="2" maxlength="2000" placeholder="What did you cover or need to revise?" class="form-input"></textarea>
            </div>

            <button class="button button-primary" type="submit">Save session</button>
        </form>
    </section>
</div>

<section class="card tool-panel tool-wide" style="margin-top: var(--space-8); padding: var(--space-6);">
    <div class="section-head" style="margin-bottom: var(--space-5);">
        <div>
            <h2>Recent study sessions</h2>
            <p>Your logged learning history.</p>
        </div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="flex flex-wrap items-center gap-4 p-4" style="border-bottom: 1px solid var(--color-border-soft);">
            <div class="text-center" style="min-width: 60px; padding: var(--space-3); background: var(--color-primary-light); border-radius: var(--radius-md);">
                <strong style="font-size: var(--text-xl);"><?php echo e($session->studied_on->format('d')); ?></strong>
                <div class="text-xs" style="color: var(--color-text-muted);"><?php echo e($session->studied_on->format('M Y')); ?></div>
            </div>

            <div class="flex-1 min-w-0">
                <strong><?php echo e($session->subject); ?></strong>
                <p class="text-sm mt-1" style="color: var(--color-text-muted);">
                    <?php echo e($session->topic ?: 'Topic not specified'); ?>

                    <?php if($session->exam): ?>
                        · <?php echo e($session->exam->name); ?>

                    <?php endif; ?>
                </p>
                <?php if($session->notes): ?>
                    <small style="color: var(--color-text-muted);"><?php echo e($session->notes); ?></small>
                <?php endif; ?>
            </div>

            <span class="text-sm font-medium" style="color: var(--color-text);"><?php echo e($session->duration_minutes); ?> min</span>

            <form method="POST" action="<?php echo e(route('tools.sessions.destroy', $session)); ?>" class="d-inline" onsubmit="return confirm('Remove this session?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="text-link text-sm" type="submit">Remove</button>
            </form>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-sm" style="color: var(--color-text-muted); text-align: center; padding: var(--space-8);">
            No study sessions logged yet.
        </p>
    <?php endif; ?>
</section>

<section class="card tool-panel tool-wide" style="margin-top: var(--space-8); padding: var(--space-6);">
    <div class="section-head" style="margin-bottom: var(--space-5);">
        <div>
            <h2>Community polls</h2>
            <p>Create a poll or vote on candidate community questions. One vote per poll.</p>
        </div>
    </div>

    <form method="POST" action="<?php echo e(route('tools.polls.store')); ?>" class="card mb-6" style="padding: var(--space-5);">
        <?php echo csrf_field(); ?>

        <div class="form-group" style="margin-bottom: var(--space-4);">
            <label for="poll_question" class="form-label">Poll question</label>
            <input type="text" id="poll_question" name="question" maxlength="240" required placeholder="Which subject are you revising today?" class="form-input">
        </div>

        <div class="form-group" style="margin-bottom: var(--space-4);">
            <label for="poll_exam" class="form-label">Related exam (optional)</label>
            <select id="poll_exam" name="exam_id" class="form-select">
                <option value="">All exams</option>
                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($exam->id); ?>"><?php echo e($exam->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="grid grid-2" style="margin-bottom: var(--space-4);">
            <div class="form-group">
                <label for="poll_option_1" class="form-label">Option 1 <span class="text-error" aria-hidden="true">*</span></label>
                <input type="text" id="poll_option_1" name="options[]" required maxlength="180" class="form-input">
            </div>

            <div class="form-group">
                <label for="poll_option_2" class="form-label">Option 2 <span class="text-error" aria-hidden="true">*</span></label>
                <input type="text" id="poll_option_2" name="options[]" required maxlength="180" class="form-input">
            </div>
        </div>

        <div class="grid grid-2" style="margin-bottom: var(--space-4);">
            <div class="form-group">
                <label for="poll_option_3" class="form-label">Option 3 (optional)</label>
                <input type="text" id="poll_option_3" name="options[]" maxlength="180" class="form-input">
            </div>

            <div class="form-group">
                <label for="poll_option_4" class="form-label">Option 4 (optional)</label>
                <input type="text" id="poll_option_4" name="options[]" maxlength="180" class="form-input">
            </div>
        </div>

        <button class="button button-primary" type="submit">Publish poll</button>
    </form>

    <div class="grid grid-2" style="gap: var(--space-4);">
        <?php $__empty_1 = true; $__currentLoopData = $polls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $totalVotes = $poll->options->sum(fn($option) => $option->votes->count());
            ?>

            <article class="card poll-card" style="padding: var(--space-5);">
                <div class="text-sm mb-2" style="color: var(--color-text-muted);">
                    <?php echo e($poll->exam?->name ?? 'All exams'); ?> · by <?php echo e($poll->user->name); ?>

                </div>

                <h3 style="margin-bottom: var(--space-4);"><?php echo e($poll->question); ?></h3>

                <?php if($poll->userVote): ?>
                    <p class="poll-result-note text-sm mb-3" style="color: var(--color-primary);">
                        You voted · <?php echo e($totalVotes); ?> total votes
                    </p>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('tools.polls.vote', $poll)); ?>">
                    <?php echo csrf_field(); ?>

                    <?php $__currentLoopData = $poll->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $count = $option->votes->count();
                            $percentage = $totalVotes ? round(($count / $totalVotes) * 100) : 0;
                        ?>

                        <label class="flex items-center gap-3 mb-3">
                            <input type="radio" name="option_id" value="<?php echo e($option->id); ?>"
                                required
                                <?php echo e($poll->userVote && $poll->userVote->poll_option_id == $option->id ? 'checked' : ''); ?>

                                <?php echo e($poll->userVote || !$poll->isOpen() ? 'disabled' : ''); ?>

                                class="form-radio">
                            <span class="flex-1"><?php echo e($option->label); ?></span>
                            <strong class="text-sm" style="color: var(--color-text-muted); min-width: 45px;"><?php echo e($percentage); ?>%</strong>
                        </label>

                        <div class="poll-track" style="height: 4px; background: var(--color-border-soft); border-radius: var(--radius-pill); overflow: hidden; margin-bottom: var(--space-3);">
                            <span style="width: <?php echo e($percentage); ?>%; height: 100%; display: block; background: var(--color-primary); border-radius: var(--radius-pill);"></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(!$poll->userVote && $poll->isOpen()): ?>
                        <button class="button button-primary button-block button-small" type="submit">Vote</button>
                    <?php elseif($poll->userVote): ?>
                        <p class="text-sm text-center" style="color: var(--color-success);">Your vote recorded</p>
                    <?php else: ?>
                        <p class="text-sm text-center" style="color: var(--color-text-muted);">Poll closed</p>
                    <?php endif; ?>
                </form>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state" style="grid-column: 1 / -1;">
                <p>No polls available right now.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="card tool-panel tool-wide" style="margin-top: var(--space-8); padding: var(--space-6);">
    <div class="section-head" style="margin-bottom: var(--space-5);">
        <div>
            <h2>Exam watchlist</h2>
            <p>Follow exams to keep them close to your preparation workspace.</p>
        </div>
        <a class="text-link" href="<?php echo e(route('exams.index')); ?>">Browse exams</a>
    </div>

    <div class="grid grid-2" style="gap: var(--space-4);">
        <?php $__empty_1 = true; $__currentLoopData = $followedExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card" style="padding: var(--space-4); display: flex; justify-content: space-between; align-items: center; gap: var(--space-4);">
                <div class="flex-1 min-w-0">
                    <strong>
                        <a href="<?php echo e(route('exams.show', $exam)); ?>" class="text-link"><?php echo e($exam->name); ?></a>
                    </strong>
                    <p class="text-sm mt-1" style="color: var(--color-text-muted);"><?php echo e($exam->experiences_count); ?> published experiences</p>
                </div>

                <form method="POST" action="<?php echo e(route('exams.unfollow', $exam)); ?>" class="d-inline" onsubmit="return confirm('Unfollow this exam?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="button button-ghost button-small" type="submit">Unfollow</button>
                </form>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <p>You are not following any exams. Open an exam page and add it to your watchlist.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/tools/index.blade.php ENDPATH**/ ?>