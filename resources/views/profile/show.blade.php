@extends('layouts.app')
@section('title', auth()->user()->name . ' — ExamConnect profile')
@section('content')
@php
    $profileUser = auth()->user();
    $totalPoints = (int) ($points ?? 0);
    $levelProgress = $totalPoints % 100;
    $nextLevelPoints = 100 - $levelProgress;
    $conversations = $conversations ?? collect();
    // Normalize image paths saved by different upload implementations.
    $resolveProfileImage = static function ($path): ?string {
        if (!is_string($path) || trim($path) === '') {
            return null;
        }
        $path = trim($path);
        if (filter_var($path, FILTER_VALIDATE_URL) && in_array(parse_url($path, PHP_URL_SCHEME), ['http', 'https'], true)) {
            return $path;
        }
        $path = ltrim($path, '/');
        $path = preg_replace('#^(public/|storage/)#i', '', $path);
        return $path !== '' ? asset('storage/' . $path) : null;
    };
    $avatarUrl = $resolveProfileImage($profileUser->avatar_path ?? null);
    $coverUrl = $resolveProfileImage($profileUser->cover_path ?? null);
@endphp
<style>
    .ec-profile {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 24px;
        color: var(--color-text, #172033);
    }
    .ec-profile *,
    .ec-profile *::before,
    .ec-profile *::after {
        box-sizing: border-box;
    }
    .ec-profile .ep-card {
        background: var(--color-surface, #fff);
        border: 1px solid var(--color-border-soft, #e2e8f0);
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }
    .ec-profile .ep-cover {
        min-height: 220px;
        border-radius: 22px 22px 0 0;
        background: linear-gradient(125deg, #312e81, #4f46e5, #818cf8);
        background-position: center;
        background-size: cover;
    }
    .ec-profile .ep-main {
        padding: 0 30px 26px;
        background: var(--color-surface, #fff);
        border: 1px solid var(--color-border-soft, #e2e8f0);
        border-top: 0;
        border-radius: 0 0 22px 22px;
    }
    .ec-profile .ep-profile-row {
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: -58px;
        position: relative;
    }
    .ec-profile .ep-avatar {
        width: 120px;
        height: 120px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 5px solid var(--color-surface, #fff);
        border-radius: 50%;
        background: #eef2ff;
        color: #4338ca;
        font-size: 42px;
        font-weight: 800;
    }
    .ec-profile .ep-avatar {
        position: relative;
    }
    .ec-profile .ep-avatar img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .ec-profile .ep-avatar-initial {
        display: none;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    .ec-profile .ep-avatar-fallback .ep-avatar-initial,
    .ec-profile .ep-avatar:not(:has(img)) .ep-avatar-initial,
    .ec-profile .ep-avatar img[hidden] + .ep-avatar-initial {
        display: flex;
    }
    .ec-profile .ep-identity {
        flex: 1;
        min-width: 200px;
        padding-bottom: 7px;
    }
    .ec-profile .ep-identity h1 {
        margin: 0 0 8px;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 800;
        line-height: 1.2;
        overflow-wrap: anywhere;
    }
    .ec-profile .ep-muted {
        color: var(--color-text-muted, #64748b);
    }
    .ec-profile .ep-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-left: auto;
        padding-bottom: 7px;
    }
    .ec-profile .ep-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 16px;
        border: 1px solid var(--color-border-soft, #e2e8f0);
        border-radius: 11px;
        background: #fff;
        color: var(--color-text, #172033);
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
    }
    .ec-profile .ep-btn-primary {
        color: #fff;
        background: var(--color-primary, #4f46e5);
        border-color: var(--color-primary, #4f46e5);
    }
    .ec-profile .ep-dropdown {
        position: relative;
    }
    .ec-profile .ep-dropdown-menu {
        position: absolute;
        top: calc(100% + 9px);
        right: 0;
        z-index: 20;
        width: 255px;
        padding: 7px;
        border: 1px solid var(--color-border-soft, #e2e8f0);
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 15px 40px rgba(15,23,42,.14);
    }
    .ec-profile .ep-dropdown-menu[hidden] {
        display: none !important;
    }
    .ec-profile .ep-dropdown-menu a {
        display: block;
        padding: 11px 12px;
        border-radius: 9px;
        color: #172033;
        text-decoration: none;
    }
    .ec-profile .ep-dropdown-menu a:hover {
        background: #f8fafc;
    }
    .ec-profile .ep-dropdown-menu strong,
    .ec-profile .ep-dropdown-menu small {
        display: block;
    }
    .ec-profile .ep-dropdown-menu small {
        margin-top: 4px;
        color: #64748b;
    }
    .ec-profile .ep-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 22px;
    }
    .ec-profile .ep-stat {
        min-width: 0;
        padding: 20px;
        transition: transform .18s ease, box-shadow .18s ease;
    }
    .ec-profile .ep-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 25px rgba(15,23,42,.06);
    }
    .ec-profile .ep-stat-label {
        color: var(--color-text-muted, #64748b);
        font-size: 13px;
        font-weight: 600;
    }
    .ec-profile .ep-stat-value {
        display: block;
        margin-top: 14px;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 800;
        overflow-wrap: anywhere;
    }
    .ec-profile .ep-level {
        margin-top: 18px;
        padding: 24px;
    }
    .ec-profile .ep-progress {
        height: 9px;
        margin: 16px 0;
        overflow: hidden;
        border-radius: 99px;
        background: #e2e8f0;
    }
    .ec-profile .ep-progress span {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: var(--color-primary, #4f46e5);
    }
    .ec-profile .ep-checkin {
        margin-top: 16px;
    }
    .ec-profile .ep-tabs {
        display: flex;
        gap: 26px;
        margin-top: 32px;
        border-bottom: 1px solid var(--color-border-soft, #e2e8f0);
    }
    .ec-profile .ep-tab {
        position: relative;
        padding: 15px 3px;
        border: 0;
        border-bottom: 3px solid transparent;
        background: transparent;
        color: var(--color-text-muted, #64748b);
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
    }
    .ec-profile .ep-tab.active {
        color: var(--color-primary, #4f46e5);
        border-bottom-color: var(--color-primary, #4f46e5);
    }
    .ec-profile .ep-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 21px;
        height: 21px;
        margin-left: 5px;
        padding: 0 5px;
        border-radius: 99px;
        background: #fee2e2;
        color: #b91c1c;
        font-size: 11px;
    }
    .ec-profile .ep-panel {
        padding-top: 24px;
    }
    .ec-profile .ep-panel[hidden] {
        display: none !important;
    }
    .ec-profile .ep-section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 20px;
    }
    .ec-profile .ep-section-head h2 {
        margin: 0;
        font-size: 23px;
        font-weight: 800;
    }
    .ec-profile .ep-review {
        margin-bottom: 16px;
        padding: 23px;
    }
    .ec-profile .ep-review h3 {
        margin: 12px 0;
        font-size: 20px;
        line-height: 1.4;
    }
    .ec-profile .ep-review h3 a {
        color: var(--color-text, #172033);
        text-decoration: none;
    }
    .ec-profile .ep-review h3 a:hover {
        color: var(--color-primary, #4f46e5);
    }
    .ec-profile .ep-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 9px;
        color: var(--color-text-muted, #64748b);
        font-size: 13px;
    }
    .ec-profile .ep-review-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 18px;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid var(--color-border-soft, #e2e8f0);
        font-size: 13px;
    }
    .ec-profile .ep-link {
        color: var(--color-primary, #4f46e5);
        font-weight: 700;
        text-decoration: none;
    }
    .ec-profile .ep-empty {
        padding: 55px 20px;
        text-align: center;
        border: 1px dashed var(--color-border-soft, #cbd5e1);
        border-radius: 18px;
        background: #fafbff;
    }
    .ec-profile .ep-empty h3 {
        margin: 14px 0 7px;
        font-size: 20px;
    }
    .ec-profile .ep-empty p {
        color: var(--color-text-muted, #64748b);
    }
    .ec-profile .ep-conversation {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 17px 20px;
        border-bottom: 1px solid var(--color-border-soft, #e2e8f0);
        color: inherit;
        text-decoration: none;
    }
    .ec-profile .ep-conversation:last-child {
        border-bottom: 0;
    }
    .ec-profile .ep-conversation:hover {
        background: #f8fafc;
    }
    .ec-profile .ep-message-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        overflow: hidden;
        border-radius: 50%;
        background: #eef2ff;
        color: #4338ca;
        font-weight: 800;
    }
    .ec-profile .ep-message-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .ec-profile .ep-message-content {
        flex: 1;
        min-width: 0;
    }
    .ec-profile .ep-message-top {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 10px;
        margin-bottom: 5px;
    }
    .ec-profile .ep-message-preview {
        overflow: hidden;
        color: var(--color-text-muted, #64748b);
        font-size: 13px;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .ec-profile .ep-unread {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 21px;
        height: 21px;
        padding: 0 6px;
        border-radius: 99px;
        background: #dc2626;
        color: white;
        font-size: 11px;
        font-weight: 700;
    }
    .ec-profile .ep-pagination {
        margin-top: 22px;
    }
    @media (max-width: 900px) {
        .ec-profile .ep-profile-row {
            align-items: center;
        }
        .ec-profile .ep-actions {
            width: 100%;
            margin-left: 0;
        }
        .ec-profile .ep-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 600px) {
        .ec-profile {
            padding: 14px;
        }
        .ec-profile .ep-cover {
            min-height: 150px;
            border-radius: 16px 16px 0 0;
        }
        .ec-profile .ep-main {
            padding: 0 16px 20px;
            border-radius: 0 0 16px 16px;
        }
        .ec-profile .ep-profile-row {
            align-items: flex-start;
            gap: 12px;
            margin-top: -43px;
        }
        .ec-profile .ep-avatar {
            width: 88px;
            height: 88px;
            font-size: 30px;
            border-width: 4px;
        }
        .ec-profile .ep-identity {
            min-width: 0;
            padding-top: 48px;
            margin-left: -100px;
            width: 100%;
            flex-basis: 100%;
        }
        .ec-profile .ep-identity h1 {
            font-size: 26px;
        }
        .ec-profile .ep-actions {
            margin-top: 5px;
            padding-bottom: 0;
        }
        .ec-profile .ep-actions .ep-btn {
            flex: 1;
        }
        .ec-profile .ep-dropdown-menu {
            right: 0;
            width: min(255px, calc(100vw - 40px));
        }
        .ec-profile .ep-stats {
            gap: 10px;
            margin-top: 14px;
        }
        .ec-profile .ep-stat {
            padding: 15px;
        }
        .ec-profile .ep-stat-value {
            font-size: 27px;
        }
        .ec-profile .ep-level {
            padding: 18px;
        }
        .ec-profile .ep-tabs {
            gap: 22px;
            margin-top: 25px;
        }
        .ec-profile .ep-tab {
            padding: 13px 1px;
        }
        .ec-profile .ep-review {
            padding: 18px;
        }
        .ec-profile .ep-section-head h2 {
            font-size: 20px;
        }
        .ec-profile .ep-message-top {
            align-items: flex-start;
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .ec-profile *,
        .ec-profile *::before,
        .ec-profile *::after {
            transition: none !important;
            animation: none !important;
        }
    }
</style>
<div class="ec-profile">
    <section class="ep-profile-card">
        <div
            class="ep-cover"
            @if($coverUrl)
                style="background-image: url('{{ $coverUrl }}')"
                role="img"
                aria-label="{{ $profileUser->name }} cover photo"
            @endif
        ></div>
        <div class="ep-main">
            <div class="ep-profile-row">
                <div class="ep-avatar">
                    @if($avatarUrl)
                        <img
                            src="{{ $avatarUrl }}"
                            alt="{{ $profileUser->name }} profile photo"
                            loading="eager"
                            decoding="async"
                            onerror="this.hidden = true; this.parentElement.classList.add('ep-avatar-fallback');"
                        >
                        <span class="ep-avatar-initial" aria-hidden="true">{{ strtoupper(substr($profileUser->name, 0, 1)) }}</span>
                    @else
                        <span class="ep-avatar-initial" aria-hidden="true">{{ strtoupper(substr($profileUser->name, 0, 1)) }}</span>
                    @endif
                </div>
                <div class="ep-identity">
                    <h1>{{ $profileUser->name }}</h1>
                    <div class="ep-handle">
                        <span>{{ '@' . $profileUser->username }}</span>
                        <span aria-hidden="true">·</span>
                        <span>{{ $profileUser->education ?: 'ExamConnect member' }}</span>
                    </div>
                    @if($profileUser->bio)
                        <p class="ep-bio">{{ $profileUser->bio }}</p>
                    @endif
                </div>
                <div class="ep-actions">
                    <a class="ep-btn ep-btn-primary" href="{{ route('profile.edit') }}">
                        Edit profile
                    </a>
                    <div class="ep-dropdown">
                        <button
                            type="button"
                            class="ep-btn"
                            id="discoverDropdownButton"
                            aria-expanded="false"
                            aria-controls="discoverDropdownMenu"
                        >
                            Discover <span aria-hidden="true">▾</span>
                        </button>
                        <div class="ep-dropdown-menu" id="discoverDropdownMenu" hidden>
                            <a href="{{ route('people.index') }}">
                                <strong>Discover People</strong>
                                <small>Find candidates</small>
                            </a>
                            <a href="{{ route('social.list', 'followers') }}">
                                <strong>My Followers</strong>
                                <small>People following you</small>
                            </a>
                            <a href="{{ route('social.list', 'following') }}">
                                <strong>Following</strong>
                                <small>People you follow</small>
                            </a>
                            <a href="{{ route('messages.index') }}">
                                <strong>Messages</strong>
                                <small>Your conversations</small>
                            </a>
                            <a href="{{ route('community.index') }}">
                                <strong>Communities</strong>
                                <small>Connect with candidates</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ep-stats" aria-label="Profile statistics">
        <div class="ep-card ep-stat">
            <div class="ep-stat-label">Published reviews</div>
            <strong class="ep-stat-value">
                {{ $profileUser->experiences()->where('status', 'published')->count() }}
            </strong>
        </div>
        <div class="ep-card ep-stat">
            <div class="ep-stat-label">Points</div>
            <strong class="ep-stat-value">{{ number_format($totalPoints) }}</strong>
        </div>
        <div class="ep-card ep-stat">
            <div class="ep-stat-label">Current streak</div>
            <strong class="ep-stat-value">{{ (int) ($streak ?? 0) }}d</strong>
        </div>
        <div class="ep-card ep-stat">
            <div class="ep-stat-label">Followers</div>
            <strong class="ep-stat-value">
                <a class="ep-link" href="{{ route('social.list', 'followers') }}">
                    {{ $profileUser->followers()->count() }}
                </a>
            </strong>
            <span class="ep-stat-sub">
                <a class="ep-link" href="{{ route('social.list', 'following') }}">
                    Following ({{ $profileUser->following()->count() }})
                </a>
            </span>
        </div>
    </section>
    <section class="ep-card ep-level">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap;">
            <div>
                <strong style="font-size:21px;">
                    Level {{ intdiv($totalPoints, 100) + 1 }}
                </strong>
                <p class="ep-muted" style="margin:6px 0 0;">
                    {{ $nextLevelPoints }} points to next level
                </p>
            </div>
            <strong>{{ $levelProgress }}%</strong>
        </div>
        <div
            class="ep-progress"
            role="progressbar"
            aria-label="Level progress"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-valuenow="{{ $levelProgress }}"
        >
            <span style="width: {{ $levelProgress }}%;"></span>
        </div>
        <p class="ep-muted" style="margin:0;line-height:1.7;">
            Points are earned from published reviews, comments and community participation.
        </p>
        <form method="POST" action="{{ route('profile.activity') }}" class="ep-checkin">
            @csrf
            <button class="ep-btn" type="submit">Daily check-in</button>
        </form>
    </section>
    <div class="ep-tabs" role="tablist" aria-label="Profile sections">
        <button
            type="button"
            role="tab"
            id="tab-reviews"
            class="ep-tab active"
            data-tab="reviews"
            aria-selected="true"
            aria-controls="panel-reviews"
        >
            Reviews
        </button>
        <button
            type="button"
            role="tab"
            id="tab-messages"
            class="ep-tab"
            data-tab="messages"
            aria-selected="false"
            aria-controls="panel-messages"
        >
            Messages
            @php
                $unreadConversations = $conversations->where('unread_count', '>', 0)->count();
            @endphp
            @if($unreadConversations > 0)
                <span class="ep-badge">{{ $unreadConversations }}</span>
            @endif
        </button>
    </div>
    <section
        role="tabpanel"
        id="panel-reviews"
        class="ep-panel"
        aria-labelledby="tab-reviews"
    >
        <div class="ep-section-head">
            <h2>Your published reviews</h2>
            <a class="ep-btn ep-btn-primary" href="{{ route('experiences.create') }}">
                Write a review
            </a>
        </div>
        @forelse($posts as $post)
            <article class="ep-card ep-review">
                <div class="ep-meta">
                    <span>{{ $post->exam?->name ?? 'Exam' }}</span>
                    <span aria-hidden="true">·</span>
                    <span>{{ optional($post->published_at)->format('M j, Y') }}</span>
                </div>
                <h3>
                    <a href="{{ route('experiences.show', $post) }}">
                        {{ $post->title }}
                    </a>
                </h3>
                @if($post->summary)
                    <p style="line-height:1.7;margin:0;">
                        {{ $post->summary }}
                    </p>
                @endif
                <div class="ep-review-footer">
                    <span class="ep-muted">
                        Difficulty:
                        {{ $post->difficulty ? $post->difficulty . '/5' : 'Not rated' }}
                    </span>
                    <a href="{{ route('experiences.edit', $post) }}" class="ep-link">
                        Edit review
                    </a>
                </div>
            </article>
        @empty
            <div class="ep-empty">
                <h3>No published reviews yet</h3>
                <p>Approved exam experiences will appear here.</p>
                <a class="ep-btn ep-btn-primary" href="{{ route('experiences.create') }}">
                    Write your first review
                </a>
            </div>
        @endforelse
        <div class="ep-pagination">
            {{ $posts->links() }}
        </div>
    </section>
    <section
        role="tabpanel"
        id="panel-messages"
        class="ep-panel"
        aria-labelledby="tab-messages"
        hidden
    >
        <div class="ep-section-head">
            <h2>Messages</h2>
            <a class="ep-btn ep-btn-primary" href="{{ route('messages.index') }}">
                Open Inbox
            </a>
        </div>
        @if($conversations->isEmpty())
            <div class="ep-empty">
                <h3>No conversations yet</h3>
                <p>
                    Start a conversation by messaging someone from
                    <a href="{{ route('people.index') }}" class="ep-link">Discover People</a>.
                </p>
            </div>
        @else
            <div class="ep-card" style="overflow:hidden;">
                @foreach($conversations as $conversation)
                    @php
                        $otherUser = $conversation['user'];
                        $lastMessage = $conversation['last_message'];
                        $unreadCount = $conversation['unread_count'];
                    @endphp
                    <a
                        href="{{ route('messages.show', $otherUser->username) }}"
                        class="ep-conversation"
                    >
                        <div class="ep-message-avatar">
                            @if($otherUser->avatar_path)
                                <img
                                    src="{{ asset('storage/' . $otherUser->avatar_path) }}"
                                    alt="{{ $otherUser->name }}"
                                >
                            @else
                                {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="ep-message-content">
                            <div class="ep-message-top">
                                <strong>{{ $otherUser->name }}</strong>
                                <span class="ep-muted" style="font-size:12px;white-space:nowrap;">
                                    @if($lastMessage)
                                        {{ $lastMessage->created_at?->diffForHumans() }}
                                    @endif
                                </span>
                            </div>
                            <div class="ep-message-preview">
                                @if($lastMessage)
                                    {{ \Illuminate\Support\Str::limit($lastMessage->body, 60) }}
                                @else
                                    No messages yet
                                @endif
                            </div>
                        </div>
                        @if($unreadCount > 0)
                            <span class="ep-unread">{{ $unreadCount }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('.ec-profile');
    if (!root) return;
    const tabs = root.querySelectorAll('.ep-tab');
    const panels = root.querySelectorAll('[role="tabpanel"]');
    function activateTab(tab, updateHash = true) {
        const target = tab.dataset.tab;
        tabs.forEach(function (item) {
            const active = item === tab;
            item.classList.toggle('active', active);
            item.setAttribute('aria-selected', String(active));
            item.setAttribute('tabindex', active ? '0' : '-1');
        });
        panels.forEach(function (panel) {
            const active = panel.id === 'panel-' + target;
            panel.hidden = !active;
        });
        if (updateHash) {
            history.replaceState(null, '', '#' + target);
        }
    }
    tabs.forEach(function (tab, index) {
        tab.addEventListener('click', function () {
            activateTab(tab);
        });
        tab.addEventListener('keydown', function (event) {
            let nextIndex = index;
            if (event.key === 'ArrowRight') {
                nextIndex = (index + 1) % tabs.length;
            } else if (event.key === 'ArrowLeft') {
                nextIndex = (index - 1 + tabs.length) % tabs.length;
            } else {
                return;
            }
            event.preventDefault();
            tabs[nextIndex].focus();
            activateTab(tabs[nextIndex]);
        });
    });
    const hash = window.location.hash.replace('#', '');
    const initialTab = root.querySelector('.ep-tab[data-tab="' + hash + '"]');
    if (initialTab) {
        activateTab(initialTab, false);
    } else {
        activateTab(tabs[0], false);
    }
    const button = root.querySelector('#discoverDropdownButton');
    const menu = root.querySelector('#discoverDropdownMenu');
    if (!button || !menu) return;
    function closeMenu() {
        menu.hidden = true;
        button.setAttribute('aria-expanded', 'false');
    }
    button.addEventListener('click', function (event) {
        event.stopPropagation();
        const opening = menu.hidden;
        menu.hidden = !opening;
        button.setAttribute('aria-expanded', String(opening));
    });
    menu.addEventListener('click', function (event) {
        event.stopPropagation();
    });
    document.addEventListener('click', closeMenu);
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !menu.hidden) {
            closeMenu();
            button.focus();
        }
    });
});
</script>
@endsection
