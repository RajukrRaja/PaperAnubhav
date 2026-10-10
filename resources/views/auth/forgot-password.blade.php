@extends('layouts.app')

@section('title', 'Forgot Password — ExamConnect')

@section('content')
<div class="auth-page" style="max-width: 420px; margin: 0 auto; padding: var(--space-12) var(--container-gutter);">
    <div class="card" style="padding: var(--space-8);">
        <header class="text-center mb-8">
            <div class="brand mx-auto mb-6" style="justify-content: center;">
                <span class="brand-mark">E</span>
                <span>ExamConnect</span>
            </div>
            <h1 style="margin-bottom: var(--space-2);">Forgot password?</h1>
            <p style="color: var(--color-text-muted);">Enter your email and we'll send you a reset link.</p>
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

        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf

            <div class="form-group" style="margin-bottom: var(--space-5);">
                <label for="email" class="form-label">Email address <span class="text-error" aria-hidden="true">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-input">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <button class="button button-primary button-block button-lg" type="submit">Send reset link</button>
        </form>

        <p class="text-center mt-6" style="color: var(--color-text-muted);">
            <a href="{{ route('login') }}" class="text-link">Back to login</a>
        </p>
    </div>
</div>
@endsection