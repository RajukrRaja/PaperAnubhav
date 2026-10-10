@extends('layouts.app')

@section('title', 'User management — Admin')

@section('content')
<header class="page-heading" style="margin-bottom: var(--space-8);">
    <div class="eyebrow">Administration</div>
    <h1>User management</h1>
    <p>Search accounts, change roles, edit public identity, activate or disable access, and remove accounts.</p>
</header>

<form method="GET" class="search-form flex flex-wrap gap-3" style="margin-bottom: var(--space-6);">
    <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 250px;">
        <label for="user_search" class="sr-only">Search users</label>
        <input type="search" id="user_search" name="q" value="{{ request('q') }}" placeholder="Search name, username or email" class="form-input">
    </div>

    <div class="form-group" style="margin-bottom: 0;">
        <label for="user_status" class="sr-only">Filter by status</label>
        <select id="user_status" name="status" class="form-select">
            <option value="">All accounts</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="disabled" {{ request('status') === 'disabled' ? 'selected' : '' }}>Disabled</option>
        </select>
    </div>

    <button class="button button-primary" type="submit">Filter</button>
</form>

@forelse($users as $user)
    <article class="card admin-user-card" style="margin-bottom: var(--space-4);">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-2" style="margin-bottom: var(--space-4);">
                <div class="form-group">
                    <label for="name_{{ $user->id }}" class="form-label">Name</label>
                    <input type="text" id="name_{{ $user->id }}" name="name" value="{{ $user->name }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="username_{{ $user->id }}" class="form-label">Username</label>
                    <input type="text" id="username_{{ $user->id }}" name="username" value="{{ $user->username }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="email_{{ $user->id }}" class="form-label">Email</label>
                    <input type="email" id="email_{{ $user->id }}" name="email" value="{{ $user->email }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="role_{{ $user->id }}" class="form-label">Role</label>
                    <select id="role_{{ $user->id }}" name="role" class="form-select">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>Moderator</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_{{ $user->id }}" class="form-label">Status</label>
                    <select id="status_{{ $user->id }}" name="is_active" class="form-select">
                        <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>
            </div>

            <p class="text-sm" style="color: var(--color-text-muted); margin-bottom: var(--space-4);">
                ID {{ $user->id }} · Joined {{ $user->created_at->format('M j, Y') }} · {{ $user->experiences()->count() }} reviews
            </p>

            <button class="button button-primary button-small" type="submit">Save changes</button>
        </form>

        <div class="card-footer" style="border-top: 1px solid var(--color-border-soft); padding-top: var(--space-4); margin-top: var(--space-4);">
            <div class="flex flex-wrap gap-3">
                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="button button-ghost button-small" {{ $user->id === auth()->id() ? 'disabled' : '' }} type="submit">
                        {{ $user->is_active ? 'Disable account' : 'Activate account' }}
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="d-inline" onsubmit="return confirm('Permanently delete this user and related data?');">
                    @csrf
                    @method('DELETE')
                    <button class="button button-danger button-small" {{ $user->id === auth()->id() ? 'disabled' : '' }} type="submit">Delete user</button>
                </form>
            </div>
        </div>
    </article>
@empty
    <div class="empty-state">
        <p>No users found.</p>
    </div>
@endforelse

<div class="pagination">{{ $users->links() }}</div>
@endsection