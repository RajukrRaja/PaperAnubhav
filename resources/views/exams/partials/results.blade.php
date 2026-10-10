
<div class="directory-toolbar">
    <div>
        <span class="toolbar-label">BROWSE EXAMS</span>
        <span class="toolbar-detail">
            Explore examinations and candidate experiences
        </span>
    </div>

    <div class="result-count">
        {{ $exams->total() }}
        {{ $exams->total() === 1 ? 'examination' : 'examinations' }}
    </div>
</div>

<section class="exam-list" aria-label="Examination results">
    @forelse($exams as $exam)
        <article class="exam-row">
            <div class="exam-symbol" aria-hidden="true">
                {{ strtoupper(substr($exam->name ?? 'E', 0, 1)) }}
            </div>

            <div class="exam-information">
                <div class="exam-meta">
                    <span class="exam-category">
                        {{ $exam->category?->name ?? 'Examination' }}
                    </span>
                </div>

                <h2 class="exam-name">
                    <a href="{{ route('exams.show', $exam) }}">
                        {{ $exam->name }}
                    </a>
                </h2>

                <p class="exam-description">
                    {{ filled($exam->description)
                        ? \Illuminate\Support\Str::limit($exam->description, 180)
                        : 'Explore candidate reviews and preparation insights.' }}
                </p>

                <div class="exam-bottom-meta">
                    <span class="experience-count">
                        <strong>{{ $exam->experiences_count ?? 0 }}</strong>
                        {{ (int) ($exam->experiences_count ?? 0) === 1
                            ? 'experience'
                            : 'experiences' }}
                    </span>
                </div>
            </div>

            <div class="exam-action">
                <a href="{{ route('exams.show', $exam) }}"
                   class="explore-link">
                    Explore exam →
                </a>
            </div>
        </article>
    @empty
        <div class="directory-empty">
            <h2>No examinations found</h2>
            <p>
                No exams match your search. Try a different name or keyword.
            </p>
        </div>
    @endforelse
</section>

@if($exams->hasPages())
    <div class="directory-pagination">
        {{ $exams->onEachSide(1)->links() }}
    </div>
@endif
