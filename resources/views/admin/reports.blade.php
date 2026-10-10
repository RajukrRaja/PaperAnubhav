@extends('layouts.app')

@section('title', 'Content reports · Admin · ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Trust and safety</div>
    <h1>Content reports</h1>
    <p>Review candidate-submitted flags. A report is an allegation, not proof that the content is false.</p>
</header>

@forelse($reports as $report)
    <article class="card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <span class="status-pill {{ $report->status === 'resolved' ? 'status-pill-success' : ($report->status === 'dismissed' ? 'status-pill-muted' : 'status-pill-primary') }}">
                    {{ ucfirst($report->status) }}
                </span>
                <span class="text-sm" style="color: var(--color-text-muted);">{{ $report->created_at }}</span>
                <span class="text-sm" style="color: var(--color-text-muted);">Reason: {{ ucfirst($report->reason) }}</span>
            </div>

            <h3 style="margin-bottom: var(--space-2);">{{ $report->experience_title ?: 'Experience unavailable or deleted' }}</h3>
            <p class="text-sm mb-3" style="color: var(--color-text-muted);">Reported by {{ $report->reporter_name ?: 'Deleted user' }}</p>

            @if($report->details)
                <p style="margin-bottom: var(--space-4);">{{ $report->details }}</p>
            @endif

            @if($report->resolution_note)
                <p style="margin-bottom: var(--space-4);"><strong>Previous note:</strong> {{ $report->resolution_note }}</p>
            @endif

            <form method="POST" action="{{ route('admin.reports.update', $report->id) }}" class="flex flex-wrap items-end gap-3" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border-soft);">
                @csrf
                @method('PATCH')

                <div class="form-group" style="margin-bottom: 0; min-width: 200px;">
                    <label for="report_status_{{ $report->id }}" class="form-label">Status</label>
                    <select id="report_status_{{ $report->id }}" name="status" class="form-select">
                        <option value="reviewing" {{ $report->status === 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                        <option value="resolved" {{ $report->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="dismissed" {{ $report->status === 'dismissed' ? 'selected' : '' }}>Dismiss report</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 250px;">
                    <label for="report_note_{{ $report->id }}" class="form-label">Resolution note</label>
                    <textarea id="report_note_{{ $report->id }}" name="resolution_note" rows="2" maxlength="1500" class="form-input">{{ $report->resolution_note }}</textarea>
                </div>

                <button class="button button-primary" type="submit">Save decision</button>
            </form>
        </div>
    </article>
@empty
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-success-light); color: var(--color-success);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <h3>No reports found</h3>
        <p>New reports from candidate experiences will appear here.</p>
    </div>
@endforelse

<div class="pagination">{{ $reports->links() }}</div>
@endsection