@extends('layouts.app')

@section('title', ($exam->meta_title ?: $exam->name) . ' · ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="flex flex-col gap-2">
        <div class="eyebrow">{{ $exam->category?->name ?? 'Examination' }} / Candidate community</div>
        <h1>{{ $exam->name }}</h1>
    </div>
    <p style="margin-top: var(--space-4); max-width: 700px;">{{ $exam->description }}</p>

    @if($exam->conducting_authority)
        <p style="margin-top: var(--space-4);"><strong>Conducting authority:</strong> {{ $exam->conducting_authority }}</p>
    @endif

    @if($exam->official_url)
        <a class="text-link" href="{{ $exam->official_url }}" target="_blank" rel="noopener noreferrer" style="margin-top: var(--space-4); display: inline-flex; align-items: center; gap: var(--space-2);">
            Official website
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
        </a>
    @endif

    @auth
        <div class="mt-5">
            @if(auth()->user()->followedExams()->where('exams.id', $exam->id)->exists())
                <form method="POST" action="{{ route('exams.unfollow', $exam) }}" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="button button-ghost" type="submit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        Following this exam · Remove
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('exams.follow', $exam) }}" class="d-inline">
                    @csrf
                    <button class="button button-primary" type="submit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        Follow exam
                    </button>
                </form>
            @endif
        </div>
    @endauth
</header>

<section class="section-head">
    <div>
        <h2>Candidate experiences</h2>
        <p>These are community-submitted reports, not official exam information.</p>
    </div>
    @auth
        <a class="button button-primary" href="{{ route('experiences.create', ['exam_id' => $exam->id]) }}">Share your experience</a>
    @else
        <a class="button button-primary" href="{{ route('register') }}">Share your experience</a>
    @endauth
</section>

@forelse($experiences as $experience)
    <article class="card experience-card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <time class="text-sm" style="color: var(--color-text-muted);">
                    {{ $experience->exam_date?->format('d M Y') ?? 'Date not provided' }}
                </time>
                <span class="text-sm" style="color: var(--color-text-muted);">·</span>
                <span class="text-sm" style="color: var(--color-text-muted);">{{ $experience->shift ?: 'Shift not specified' }}</span>
                <span class="status-pill status-pill-candidate-reported">Candidate-reported</span>
            </div>
            <h3 style="margin-bottom: var(--space-3);">
                <a href="{{ route('experiences.show', $experience) }}" class="text-link" style="color: var(--color-text);">
                    {{ $experience->title }}
                </a>
            </h3>
            <p style="margin-bottom: var(--space-4);">{{ $experience->summary }}</p>
            <div class="flex flex-wrap items-center gap-4">
                <span class="text-sm" style="color: var(--color-text-muted);">
                    By {{ $experience->anonymous_author ? 'Anonymous candidate' : '@' . $experience->user->username }}
                </span>
                @if($experience->difficulty)
                    <span class="badge badge-primary">
                        Difficulty {{ $experience->difficulty }}/5
                    </span>
                @else
                    <span class="badge badge-muted">Not rated</span>
                @endif
                @if($experience->likes_count > 0)
                    <span class="text-sm" style="color: var(--color-text-muted); display: flex; align-items: center; gap: var(--space-1);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        {{ $experience->likes_count }}
                    </span>
                @endif
            </div>
        </div>
    </article>
@empty
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
@endforelse

<div class="pagination">{{ $experiences->links() }}</div>
@endsection