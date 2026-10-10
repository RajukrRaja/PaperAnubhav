@extends('layouts.app')

@section('title', 'Moderation · ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Admin workspace</div>
    <h1>Moderation dashboard</h1>
    <p>Review candidate submissions before they become publicly visible.</p>
</header>

<div class="grid grid-4 stats-grid" style="margin-bottom: var(--space-8);">
    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Pending review</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);">{{ $pending }}</strong>
    </div>

    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Published</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);">{{ $published }}</strong>
    </div>

    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Members</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);">{{ $users }}</strong>
    </div>

    <div class="stat-card card text-center">
        <span class="text-sm" style="color: var(--color-text-muted);">Exams</span>
        <strong class="text-2xl" style="display: block; margin-top: var(--space-2);">{{ $exams }}</strong>
    </div>
</div>

<div class="section-head" style="margin-bottom: var(--space-5);">
    <h2>Pending submissions</h2>
</div>

@forelse($queue as $experience)
    <article class="card moderation-card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <span class="text-sm" style="color: var(--color-text-muted);">{{ $experience->exam->name }}</span>
                <span class="status-pill status-pill-pending">{{ $experience->status }}</span>
            </div>

            <h3 style="margin-bottom: var(--space-2);">{{ $experience->title }}</h3>
            <p style="margin-bottom: var(--space-3);">{{ $experience->summary }}</p>

            <p class="text-sm" style="color: var(--color-text-muted); margin-bottom: var(--space-4);">
                Submitted by {{ $experience->user->username }} · {{ $experience->created_at->format('d M Y H:i') }}
            </p>

            <div class="moderation-actions flex flex-wrap gap-3">
                <a class="button button-ghost" href="{{ route('experiences.edit', $experience) }}">Inspect / edit</a>

                <form method="POST" action="{{ route('admin.experiences.moderate', $experience) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="decision" value="publish">
                    <button class="button button-primary" type="submit">Approve & publish</button>
                </form>

                <form method="POST" action="{{ route('admin.experiences.moderate', $experience) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="decision" value="corrections">
                    <input type="text" name="reason" placeholder="Correction reason (optional)" aria-label="Correction reason" class="form-input" style="width: 200px; display: inline-block; margin-right: var(--space-2);">
                    <button class="button button-ghost" type="submit">Request corrections</button>
                </form>

                <form method="POST" action="{{ route('admin.experiences.moderate', $experience) }}" class="d-inline" onsubmit="return confirm('Reject this experience?');">
                    @csrf
                    <input type="hidden" name="decision" value="reject">
                    <input type="text" name="reason" placeholder="Rejection reason (optional)" aria-label="Rejection reason" class="form-input" style="width: 200px; display: inline-block; margin-right: var(--space-2);">
                    <button class="button button-danger" type="submit">Reject</button>
                </form>
            </div>
        </div>
    </article>
@empty
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-success-light); color: var(--color-success);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <h3>No pending submissions</h3>
        <p>All candidate experiences have been reviewed.</p>
    </div>
@endforelse
@endsection