@extends('layouts.app')

@section('title', 'Saved experiences · ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Your library</div>
    <h1>Bookmarked experiences</h1>
</header>

@forelse($experiences as $bookmark)
    <article class="card experience-card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="card-meta mb-3">
                <span class="text-sm" style="color: var(--color-text-muted);">{{ $bookmark->experience->exam->name }}</span>
            </div>

            <h3 style="margin-bottom: var(--space-3);">
                <a href="{{ route('experiences.show', $bookmark->experience) }}" class="text-link" style="color: var(--color-text);">
                    {{ $bookmark->experience->title }}
                </a>
            </h3>

            <p style="margin-bottom: var(--space-4);">{{ $bookmark->experience->summary }}</p>

            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm" style="color: var(--color-text-muted);">
                    By {{ $bookmark->experience->anonymous_author ? 'Anonymous candidate' : '@' . $bookmark->experience->user->username }}
                </span>
                @if($bookmark->experience->difficulty)
                    <span class="badge badge-primary">
                        Difficulty {{ $bookmark->experience->difficulty }}/5
                    </span>
                @endif
            </div>
        </div>
    </article>
@empty
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <h3>No bookmarks yet</h3>
        <p>Save useful experiences to return to them later.</p>
        <a class="button button-primary mt-4" href="{{ route('exams.index') }}">Explore exams</a>
    </div>
@endforelse

<div class="pagination">{{ $experiences->links() }}</div>
@endsection