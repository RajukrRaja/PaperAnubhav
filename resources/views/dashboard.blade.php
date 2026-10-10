@extends('layouts.app')

@section('title', 'Community feed · ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Community feed</div>
    <h1>Experiences that help you prepare</h1>
    <p>Learn from candidate-reported reviews. Always verify official details with the exam authority.</p>
    <a class="button button-primary mt-4" href="{{ route('experiences.create') }}">+ Write experience</a>
</header>

<div class="grid" style="grid-template-columns: minmax(0, 1fr) 320px; gap: var(--space-8);">
    <section>
        <div class="section-head compact" style="margin-bottom: var(--space-5);">
            <h2>Latest experiences</h2>
        </div>

        @forelse($experiences as $experience)
            <article class="card experience-card" style="margin-bottom: var(--space-4);">
                <div class="card-body" style="padding: var(--space-5) var(--space-6);">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <a href="{{ route('exams.show', $experience->exam) }}" class="text-link text-sm">{{ $experience->exam->name }}</a>
                        <span style="color: var(--color-text-muted);">·</span>
                        <span class="text-sm" style="color: var(--color-text-muted);">
                            {{ $experience->exam_date?->format('d M Y') ?? 'Date not provided' }}
                        </span>
                        <span class="status-pill status-pill-candidate-reported">Candidate-reported</span>
                    </div>

                    <h3 style="margin-bottom: var(--space-2);">
                        <a href="{{ route('experiences.show', $experience) }}" class="text-link" style="color: var(--color-text);">
                            {{ $experience->title }}
                        </a>
                    </h3>

                    <p style="margin-bottom: var(--space-4); color: var(--color-text-soft);">
                        {{ $experience->summary ?: \Illuminate\Support\Str::limit(strip_tags($experience->body), 180) }}
                    </p>

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
                        <span class="text-sm" style="color: var(--color-text-muted);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="inline mr-1">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                            {{ $experience->likes_count }}
                        </span>
                        <span class="text-sm" style="color: var(--color-text-muted);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="inline mr-1">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            {{ $experience->all_comments_count }}
                        </span>
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
                <h3>No published experiences yet</h3>
                <p>Be one of the first to share a useful, honest review.</p>
                <a class="button button-primary mt-4" href="{{ route('experiences.create') }}">Write an experience</a>
            </div>
        @endforelse

        <div class="pagination">{{ $experiences->links() }}</div>
    </section>

    <aside>
        <div class="card sidebar-card" style="padding: var(--space-5);">
            <div class="eyebrow mb-3">Browse exams</div>
            <h3 style="margin-bottom: var(--space-4);">Popular directories</h3>

            @foreach($exams as $exam)
                <a href="{{ route('exams.show', $exam) }}" class="flex items-center justify-between gap-3 p-3" style="text-decoration: none; color: var(--color-text); border-radius: var(--radius-md); transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-border-soft)'" onmouseout="this.style.background='transparent'">
                    <span>{{ $exam->name }}</span>
                    <span class="text-sm" style="color: var(--color-text-muted);">{{ $exam->experiences_count }} →</span>
                </a>
            @endforeach

            <a href="{{ route('exams.index') }}" class="text-link text-sm block mt-4 text-center">View all exams →</a>
        </div>
    </aside>
</div>
@endsection