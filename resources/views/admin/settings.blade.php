@extends('layouts.app')

@section('title', 'Site settings — Admin')

@section('content')
@php
    $values = $settings->keyBy('key');
@endphp

<div class="form-page" style="max-width: 700px;">
    <header class="page-heading" style="margin-bottom: var(--space-8);">
        <div class="eyebrow">Administration</div>
        <h1>Platform settings</h1>
        <p style="color: var(--color-text-muted);">Manage site identity, community rules and registration preferences.</p>
    </header>

    <form method="POST" action="{{ route('admin.settings.save') }}" novalidate>
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="alert alert-error" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label for="site_name" class="form-label">Site name <span class="text-error" aria-hidden="true">*</span></label>
            <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $values['site_name']->value ?? 'ExamConnect') }}" required maxlength="100" class="form-input">
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $values['tagline']->value ?? 'Real candidate experiences') }}" maxlength="200" class="form-input">
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label for="community_guidelines" class="form-label">Community guidelines</label>
            <textarea id="community_guidelines" name="community_guidelines" rows="6" class="form-input">{{ old('community_guidelines', $values['community_guidelines']->value ?? 'Be respectful. Do not publish fabricated experiences. Clearly label remembered questions as candidate-reported.') }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label class="form-checkbox-label">
                <input type="checkbox" name="allow_registration" value="1" {{ old('allow_registration', ($values['allow_registration']->value ?? '1') === '1') ? 'checked' : '' }} class="form-checkbox">
                Allow new registrations (preference saved; enforcement must be wired into registration)
            </label>
        </div>

        <div class="form-group" style="margin-bottom: var(--space-5);">
            <label class="form-checkbox-label">
                <input type="checkbox" name="maintenance_mode" value="1" {{ old('maintenance_mode', ($values['maintenance_mode']->value ?? '0') === '1') ? 'checked' : '' }} class="form-checkbox">
                Maintenance mode preference (saved for future middleware enforcement)
            </label>
        </div>

        <button class="button button-primary" type="submit">Save settings</button>
    </form>
</div>
@endsection