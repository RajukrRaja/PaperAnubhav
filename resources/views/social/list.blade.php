@extends('layouts.app')

@section('title', ucfirst($type) . ' — ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1>{{ ucfirst($type) }}</h1>
    <a class="button button-ghost" href="{{ route('profile.show') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline mr-1">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Back to profile
    </a>
</header>

@if(session('success'))
    <div class="alert alert-success" role="status">{{ session('success') }}</div>
@endif

@forelse($users as $person)
    @php
        $isFollowing = auth()->user()
            ->following()
            ->where('users.id', $person->id)
            ->exists();

        $followsMe = $person
            ->following()
            ->where('users.id', auth()->id())
            ->exists();
    @endphp

    <article class="card" style="margin-bottom: var(--space-4); overflow: hidden;">
        <a href="{{ route('profile.public', $person->username) }}" class="flex items-center gap-4 p-4" style="text-decoration: none; color: inherit; transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-border-soft)'" onmouseout="this.style.background='transparent'">
            <div class="avatar avatar-md">
                @if($person->avatar_path)
                    <img src="{{ asset('storage/' . $person->avatar_path) }}" alt="{{ $person->name }}">
                @else
                    {{ strtoupper(substr($person->name, 0, 1)) }}
                @endif
            </div>

            <div class="flex-1 min-w-0">
                <h3 style="margin-bottom: var(--space-1);">
                    <a href="{{ route('profile.public', $person->username) }}" class="text-link" style="color: var(--color-text);">{{ $person->name }}</a>
                </h3>

                <p class="text-sm mb-2" style="color: var(--color-text-muted); margin: 0;">{{ '@' . $person->username }}</p>

                @if($isFollowing && $followsMe)
                    <span class="badge badge-success text-xs">You follow each other</span>
                @elseif($followsMe)
                    <span class="badge badge-primary text-xs">Follows you</span>
                @endif
            </div>

            @if(auth()->id() !== $person->id)
                <div class="flex flex-wrap items-center gap-2">
                    @if($isFollowing)
                        <form method="POST" action="{{ route('users.unfollow', $person->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="button button-ghost button-small" type="submit">Following</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('users.follow', $person->id) }}" class="d-inline">
                            @csrf
                            <button class="button button-primary button-small" type="submit">{{ $followsMe ? 'Follow Back' : 'Follow' }}</button>
                        </form>
                    @endif

                    <a class="button button-ghost button-small" href="{{ route('messages.show', $person->username) }}">Message</a>
                </div>
            @endif
        </a>
    </article>
@empty
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
            </svg>
        </div>
        <h3>No {{ $type }} yet</h3>
        <p>People you connect with will appear here.</p>
    </div>
@endforelse

<div class="pagination">{{ $users->links() }}</div>
@endsection