@extends('layouts.app')

@section('title', 'Post management — Admin')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Administration</div>
    <h1>Post management</h1>
    <p>Review published, pending, draft and rejected candidate experiences.</p>
</header>

<form method="GET" class="search-form flex flex-wrap gap-3" style="margin-bottom: var(--space-6);">
    <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 250px;">
        <label for="post_search" class="sr-only">Search posts</label>
        <input type="search" id="post_search" name="q" value="{{ request('q') }}" placeholder="Search post title" class="form-input">
    </div>

    <div class="form-group" style="margin-bottom: 0;">
        <label for="post_status" class="sr-only">Filter by status</label>
        <select id="post_status" name="status" class="form-select">
            <option value="">All statuses</option>
            @foreach(['pending', 'published', 'draft', 'rejected', 'needs_corrections'] as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="button button-primary" type="submit">Filter</button>
</form>

@forelse($posts as $post)
    <article class="card" style="margin-bottom: var(--space-4);">
        <div class="card-body" style="padding: var(--space-5) var(--space-6);">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <span class="text-sm" style="color: var(--color-text-muted);">{{ $post->exam->name }}</span>
                <span style="color: var(--color-text-muted);">·</span>
                <span class="text-sm" style="color: var(--color-text-muted);">{{ $post->user->name }}</span>
                <span class="status-pill {{ $post->status === 'published' ? 'status-pill-published' : ($post->status === 'pending' ? 'status-pill-pending' : ($post->status === 'rejected' ? 'status-pill-rejected' : 'status-pill-draft')) }}">
                    {{ ucfirst(str_replace('_', ' ', $post->status)) }}
                </span>
            </div>

            <h3 style="margin-bottom: var(--space-2);">{{ $post->title }}</h3>
            <p style="margin-bottom: var(--space-4);">{{ $post->summary }}</p>

            <div class="flex flex-wrap items-center gap-3">
                <a class="text-link text-sm" href="{{ route('experiences.show', $post) }}" target="_blank">Open public page</a>

                <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="d-inline flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select" style="width: auto;">
                        @foreach(['draft', 'pending', 'published', 'rejected', 'needs_corrections'] as $status)
                            <option value="{{ $status }}" {{ $post->status === $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                    <button class="button button-primary button-small" type="submit">Update status</button>
                </form>
            </div>
        </div>
    </article>
@empty
    <div class="empty-state">
        <p>No posts match these filters.</p>
    </div>
@endforelse

<div class="pagination">{{ $posts->links() }}</div>
@endsection