@extends('layouts.app')

@section('title', 'Join ExamConnect')

@section('content')
<div class="auth-page" style="max-width: 420px; margin: 0 auto; padding: var(--space-12) var(--container-gutter);">
    <div class="card" style="padding: var(--space-8);">
        <header class="text-center mb-8">
            <div class="brand mx-auto mb-6" style="justify-content: center;">
                <span class="brand-mark">E</span>
                <span>ExamConnect</span>
            </div>
            <h1 style="margin-bottom: var(--space-2);">Join the community</h1>
            <p style="color: var(--color-text-muted);">Share experiences, connect with candidates, prepare better</p>
        </header>

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

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="name" class="form-label">Display name <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="100" class="form-input">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">Username <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required maxlength="30" class="form-input">
                    @error('username')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: var(--space-5);">
                <label for="email" class="form-label">Email address <span class="text-error" aria-hidden="true">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-input">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-2" style="margin-bottom: var(--space-5);">
                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password" class="form-input">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm password <span class="text-error" aria-hidden="true">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="form-input">
                    @error('password_confirmation')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <p class="form-hint mb-6">By creating an account, you agree to our <a href="#" class="text-link">Terms of Service</a> and <a href="#" class="text-link">Privacy Policy</a>.</p>

            <button class="button button-primary button-block button-lg" type="submit">Create account</button>
        </form>

        <p class="text-center mt-6" style="color: var(--color-text-muted);">
            Already have an account?
            <a href="{{ route('login') }}" class="text-link ml-2">Sign in</a>
        </p>
    </div>
</div>
@endsection