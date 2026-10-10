@extends('layouts.app')

@section('title', 'Messages — ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1>Messages</h1>
    <p>Your direct message conversations.</p>
</header>

@if(session('success'))
    <div class="alert alert-success" role="status">{{ session('success') }}</div>
@endif

@forelse($users as $person)
    <article class="card" style="margin-bottom: var(--space-3); overflow: hidden;">
        <a href="{{ route('messages.show', $person->username) }}" class="flex items-center gap-4 p-4" style="text-decoration: none; color: inherit; transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-border-soft)'" onmouseout="this.style.background='transparent'">
            <div class="avatar avatar-md">
                @if($person->avatar_path)
                    <img src="{{ asset('storage/' . $person->avatar_path) }}" alt="{{ $person->name }}">
                @else
                    {{ strtoupper(substr($person->name, 0, 1)) }}
                @endif
            </div>

            <div class="flex-1 min-w-0">
                <h3 style="margin-bottom: var(--space-1);">{{ $person->name }}</h3>
                <p class="text-sm" style="color: var(--color-text-muted); margin: 0;">{{ '@' . $person->username }}</p>
            </div>

            <span class="text-link text-sm font-medium">Open chat →</span>
        </a>
    </article>
@empty
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <h3>No conversations yet</h3>
        <p>Visit a member profile and select Message to start a conversation.</p>
        <a href="{{ route('people.index') }}" class="button button-primary mt-4">Discover people</a>
    </div>
@endforelse
@endsection