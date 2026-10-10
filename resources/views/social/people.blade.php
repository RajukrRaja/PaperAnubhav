@extends('layouts.app')

@section('title', 'Discover People — ExamConnect')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <h1>Discover People</h1>
    <p>Find candidates, connect with students, and grow your exam preparation network.</p>
</header>

@if(session('success'))
    <div class="alert alert-success" role="status">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-error" role="alert">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@forelse($users as $person)
    @php
        $currentUser = auth()->user();

        $isFollowing = $currentUser->following()
            ->where('users.id', $person->id)
            ->exists();

        $followsMe = $person->following()
            ->where('users.id', $currentUser->id)
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
            </a>

            <div class="flex-1 min-w-0">
                <h3 style="margin-bottom: var(--space-1);">
                    <a href="{{ route('profile.public', $person->username) }}" class="text-link" style="color: var(--color-text);">{{ $person->name }}</a>
                </h3>

                <p class="text-sm mb-1" style="color: var(--color-text-muted); margin: 0;">{{ '@' . $person->username }}</p>

                <p class="text-sm mb-2" style="color: var(--color-text-muted); margin: 0;">{{ $person->followers_count }} followers</p>

                @if($followsMe && $isFollowing)
                    <span class="badge badge-success text-xs">Mutual connection</span>
                @elseif($followsMe)
                    <span class="badge badge-primary text-xs">Follows you</span>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if($isFollowing)
                    <form method="POST" action="{{ route('users.unfollow', $person) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="button button-ghost button-small" type="submit">Following</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('users.follow', $person) }}" class="d-inline">
                        @csrf
                        <button class="button button-primary button-small" type="submit">{{ $followsMe ? 'Follow Back' : 'Follow' }}</button>
                    </form>
                @endif

                <a class="button button-ghost button-small" href="{{ route('messages.show', $person->username) }}">Message</a>
                <a class="button button-ghost button-small" href="{{ route('profile.public', $person->username) }}">View Profile</a>
            </div>
        </a>
    </article>
@empty
    <div class="empty-state">
        <div class="avatar avatar-xl mx-auto mb-4" style="background: var(--color-border-soft); color: var(--color-text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <h3>No new people to discover</h3>
        <p>You are already following everyone currently available, or no active candidate profiles are available yet.</p>
    </div>
@endforelse

@if($users->hasPages())
    <div class="pagination">{{ $users->links() }}</div>
@endif
@endsection