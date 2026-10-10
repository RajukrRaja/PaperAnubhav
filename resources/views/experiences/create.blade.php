@extends('layouts.app')

@section('title', 'Share an experience · ExamConnect')

@section('content')

<div class="form-page" style="max-width: 800px;">

    <header class="page-heading" style="margin-bottom: var(--space-8);">
        <div class="eyebrow">Help the next candidate</div>
        <h1>Share your exam experience</h1>
        <p style="color: var(--color-text-muted);">
            Describe only what you personally remember. Your submission goes to moderation before publication.
        </p>
    </header>

    <form method="POST" action="{{ route('experiences.store') }}" novalidate>
        @csrf

        @if($errors->any())
            <div class="alert alert-error" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}"
                                {{ old('exam_id', $experience?->exam_id ?? request('exam_id')) == $exam->id ? 'selected' : '' }}>
                                {{ $exam->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('exam_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exam_date" class="form-label">Exam date</label>
                    <input
                        type="date"
                        id="exam_date"
                        name="exam_date"
                        max="{{ now()->toDateString() }}"
                        value="{{ old('exam_date', $experience?->exam_date?->format('Y-m-d') ?? '') }}"
                        class="form-input"
                    >

                    @error('exam_date')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="exam_year" class="form-label">Exam year</label>
                    <input type="number" id="exam_year" name="exam_year" min="2000" max="2100"
                        value="{{ old('exam_year', $experience?->exam_year ?? '') }}" class="form-input">

                    @error('exam_year')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="shift" class="form-label">Shift / session</label>
                    <input type="text" id="shift" name="shift" maxlength="50"
                        placeholder="e.g. Shift 2"
                        value="{{ old('shift', $experience?->shift ?? '') }}" class="form-input">

                    @error('shift')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="stage" class="form-label">Stage</label>
                    <input type="text" id="stage" name="stage" maxlength="100"
                        placeholder="e.g. CBT 1"
                        value="{{ old('stage', $experience?->stage ?? '') }}" class="form-input">

                    @error('stage')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="language" class="form-label">Language</label>
                    <select id="language" name="language" class="form-select">
                        <option value="en" {{ old('language', $experience?->language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ old('language', $experience?->language ?? 'en') === 'hi' ? 'selected' : '' }}>Hindi</option>
                        <option value="hinglish" {{ old('language', $experience?->language ?? 'en') === 'hinglish' ? 'selected' : '' }}>Hinglish</option>
                    </select>

                    @error('language')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="difficulty" class="form-label">Overall difficulty</label>
                    <select id="difficulty" name="difficulty" class="form-select">
                        <option value="">Choose rating</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ old('difficulty', $experience?->difficulty ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} / 5
                                {{ [1 => 'Very easy', 2 => 'Easy', 3 => 'Moderate', 4 => 'Difficult', 5 => 'Very difficult'][$i] }}
                            </option>
                        @endfor
                    </select>

                    @error('difficulty')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="attempted_count" class="form-label">Questions attempted</label>
                    <input type="number" id="attempted_count" name="attempted_count" min="0" max="500"
                        value="{{ old('attempted_count', $experience?->attempted_count ?? '') }}" class="form-input">

                    @error('attempted_count')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="estimated_correct" class="form-label">Estimated correct</label>
                    <input type="number" id="estimated_correct" name="estimated_correct" min="0" max="500"
                        value="{{ old('estimated_correct', $experience?->estimated_correct ?? '') }}" class="form-input">

                    @error('estimated_correct')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="estimated_incorrect" class="form-label">Estimated incorrect</label>
                    <input type="number" id="estimated_incorrect" name="estimated_incorrect" min="0" max="500"
                        value="{{ old('estimated_incorrect', $experience?->estimated_incorrect ?? '') }}" class="form-input">

                    @error('estimated_incorrect')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="good_attempt" class="form-label">Good attempt</label>
                    <input type="number" id="good_attempt" name="good_attempt" min="0" max="500"
                        value="{{ old('good_attempt', $experience?->good_attempt ?? '') }}" class="form-input">

                    @error('good_attempt')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="center_region" class="form-label">Center region</label>
                    <input type="text" id="center_region" name="center_region" maxlength="100"
                        placeholder="City / Region"
                        value="{{ old('center_region', $experience?->center_region ?? '') }}" class="form-input">

                    @error('center_region')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-6">
            <legend class="form-label" style="font-size: var(--text-lg); margin-bottom: var(--space-5);">
                Subject difficulty (optional)
            </legend>

            @php
                $subjectDifficulties = $experience?->subject_difficulties ?? [];
            @endphp

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="subject_quant" class="form-label">Quantitative Aptitude</label>
                    <select id="subject_quant" name="subject_difficulties[quant]" class="form-select">
                        <option value="">Not rated</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ old('subject_difficulties.quant', $subjectDifficulties['quant'] ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} / 5
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_reasoning" class="form-label">Logical Reasoning</label>
                    <select id="subject_reasoning" name="subject_difficulties[reasoning]" class="form-select">
                        <option value="">Not rated</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ old('subject_difficulties.reasoning', $subjectDifficulties['reasoning'] ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} / 5
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="subject_english" class="form-label">English Language</label>
                    <select id="subject_english" name="subject_difficulties[english]" class="form-select">
                        <option value="">Not rated</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ old('subject_difficulties.english', $subjectDifficulties['english'] ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} / 5
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_gk" class="form-label">General Awareness</label>
                    <select id="subject_gk" name="subject_difficulties[gk]" class="form-select">
                        <option value="">Not rated</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ old('subject_difficulties.gk', $subjectDifficulties['gk'] ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} / 5
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="subject_other" class="form-label">Other / Technical</label>
                <select id="subject_other" name="subject_difficulties[other]" class="form-select">
                    <option value="">Not rated</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}"
                            {{ old('subject_difficulties.other', $subjectDifficulties['other'] ?? '') == $i ? 'selected' : '' }}>
                            {{ $i }} / 5
                        </option>
                    @endfor
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
                    value="{{ old('title', $experience?->title ?? '') }}"
                    placeholder="What should future candidates know?" class="form-input">

                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary" class="form-label">Short summary</label>
                <textarea id="summary" name="summary" rows="3" maxlength="500"
                    class="form-input"
                    placeholder="A brief overview of your experience...">{{ old('summary', $experience?->summary ?? '') }}</textarea>

                @error('summary')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="body" class="form-label">Full experience</label>
                <textarea id="body" name="body" rows="7" maxlength="20000"
                    class="form-input"
                    placeholder="Describe the paper, environment and what you personally observed.">{{ old('body', $experience?->body ?? '') }}</textarea>

                @error('body')
                    <p class="form-error">{{ $message }}</p>
                @enderror

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
                        class="form-input">{{ old('time_management', $experience?->time_management ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="unexpected_topics" class="form-label">Unexpected topics</label>
                    <textarea id="unexpected_topics" name="unexpected_topics" rows="3"
                        class="form-input">{{ old('unexpected_topics', $experience?->unexpected_topics ?? '') }}</textarea>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="exam_day_notes" class="form-label">Exam-day notes</label>
                    <textarea id="exam_day_notes" name="exam_day_notes" rows="3"
                        class="form-input">{{ old('exam_day_notes', $experience?->exam_day_notes ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="preparation_strategy" class="form-label">Preparation strategy</label>
                    <textarea id="preparation_strategy" name="preparation_strategy" rows="3"
                        class="form-input">{{ old('preparation_strategy', $experience?->preparation_strategy ?? '') }}</textarea>
                </div>
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="recommended_resources" class="form-label">Recommended resources</label>
                    <textarea id="recommended_resources" name="recommended_resources" rows="3"
                        class="form-input">{{ old('recommended_resources', $experience?->recommended_resources ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="mistakes_to_avoid" class="form-label">Mistakes to avoid</label>
                    <textarea id="mistakes_to_avoid" name="mistakes_to_avoid" rows="3"
                        class="form-input">{{ old('mistakes_to_avoid', $experience?->mistakes_to_avoid ?? '') }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="advice" class="form-label">Advice for future candidates</label>
                <textarea id="advice" name="advice" rows="4"
                    class="form-input">{{ old('advice', $experience?->advice ?? '') }}</textarea>
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
                        {{ old('anonymous_author', $experience?->anonymous_author ?? false) ? 'checked' : '' }}
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

            <a href="{{ route('exams.index') }}" class="button button-ghost button-lg">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection