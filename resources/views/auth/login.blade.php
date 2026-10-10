@extends('layouts.app')

@section('title', 'Log in — ExamConnect')

@section('content')
<div class="auth-page" style="max-width: 420px; margin: 0 auto; padding: var(--space-12) var(--container-gutter);">
    <div class="card" style="padding: var(--space-8);">
        <header class="text-center mb-8">
            <div class="brand mx-auto mb-6" style="justify-content: center;">
                <span class="brand-mark">E</span>
                <span>ExamConnect</span>
            </div>
            <h1 style="margin-bottom: var(--space-2);">Welcome back</h1>
            <p style="color: var(--color-text-muted);">Sign in to continue your exam preparation journey</p>
        </header>

        @if(session('status'))
            <div class="alert alert-success mb-6" role="status">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error mb-6" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="form-group" style="margin-bottom: var(--space-5);">
                <label for="email" class="form-label">Email address <span class="text-error" aria-hidden="true">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-input">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: var(--space-5);">
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="form-label mb-0">Password <span class="text-error" aria-hidden="true">*</span></label>
                    <a href="{{ route('password.request') }}" class="text-link text-sm">Forgot password?</a>
                </div>
                <input type="password" id="password" name="password" required autocomplete="current-password" class="form-input">
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: var(--space-6);">
                <label class="form-checkbox-label">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    Remember me
                </label>
            </div>

            <button class="button button-primary button-block button-lg" type="submit">Sign in</button>
        </form>

        <p class="text-center mt-6" style="color: var(--color-text-muted);">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-link ml-2">Create one</a>
        </p>
    </div>
</div>
@endsection