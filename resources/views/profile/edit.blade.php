
@extends('layouts.app')

@section('title', 'Edit profile — ExamConnect')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

<style>
    .ec-profile {
        max-width: 850px;
        margin: 0 auto;
        padding: 30px 20px 70px;
        color: #111827;
        --ec-primary: #4f46e5;
        --ec-border: #e5e7eb;
        --ec-muted: #6b7280;
    }

    .ec-profile *,
    .ec-crop-modal * {
        box-sizing: border-box;
    }

    .ec-heading {
        margin-bottom: 32px;
    }

    .ec-eyebrow {
        color: var(--ec-primary);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .ec-heading h1 {
        margin: 0 0 12px;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1.2;
    }

    .ec-heading p,
    .ec-muted {
        color: var(--ec-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .ec-section {
        padding: 28px 0;
        border-bottom: 1px solid var(--ec-border);
    }

    .ec-section h2 {
        margin: 0 0 7px;
        font-size: 19px;
        font-weight: 750;
    }

    .ec-section-desc {
        margin: 0 0 22px;
        color: var(--ec-muted);
        font-size: 13px;
        line-height: 1.65;
    }

    .ec-grid,
    .ec-image-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .ec-field,
    .ec-image-panel {
        min-width: 0;
    }

    .ec-field {
        margin-bottom: 22px;
    }

    .ec-grid .ec-field {
        margin-bottom: 0;
    }

    .ec-label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
    }

    .ec-input {
        display: block;
        width: 100%;
        min-height: 45px;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        background: #fff;
        color: #111827;
        font: inherit;
        font-size: 14px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .ec-input:focus {
        border-color: var(--ec-primary);
        box-shadow: 0 0 0 3px rgb(79 70 229 / 12%);
    }

    textarea.ec-input {
        min-height: 110px;
        resize: vertical;
    }

    .ec-hint {
        margin-top: 7px;
        color: var(--ec-muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .ec-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .ec-alert {
        margin-bottom: 24px;
        padding: 15px 18px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.7;
    }

    .ec-alert-error {
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #991b1b;
    }

    .ec-alert ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .ec-avatar-preview {
        display: flex;
        width: 132px;
        height: 132px;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 13px;
        border: 1px solid var(--ec-border);
        border-radius: 50%;
        background: #f3f4f6;
    }

    .ec-cover-preview {
        display: flex;
        width: 100%;
        aspect-ratio: 16 / 7;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 13px;
        border: 1px solid var(--ec-border);
        border-radius: 12px;
        background: #f3f4f6;
    }

    .ec-avatar-preview img,
    .ec-cover-preview img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ec-avatar-preview img {
        border-radius: 50%;
    }

    .ec-placeholder {
        padding: 12px;
        color: #9ca3af;
        font-size: 12px;
        text-align: center;
    }

    .ec-placeholder svg {
        display: block;
        width: 28px;
        height: 28px;
        margin: 0 auto 8px;
    }

    .ec-image-name {
        min-height: 18px;
        margin: 0 0 12px;
        color: var(--ec-muted);
        font-size: 12px;
        overflow-wrap: anywhere;
    }

    .ec-file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip-path: inset(50%);
    }

    .ec-buttons,
    .ec-form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .ec-form-actions {
        padding-top: 25px;
    }

    .ec-btn {
        display: inline-flex;
        min-height: 42px;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid transparent;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, border-color .2s;
    }

    .ec-btn-primary {
        border-color: var(--ec-primary);
        background: var(--ec-primary);
        color: #fff;
    }

    .ec-btn-primary:hover {
        border-color: #4338ca;
        background: #4338ca;
        color: #fff;
    }

    .ec-btn-secondary {
        border-color: #d1d5db;
        background: #fff;
        color: #374151;
    }

    .ec-btn-secondary:hover {
        background: #f9fafb;
    }

    .ec-btn:disabled {
        opacity: .55;
        cursor: not-allowed;
    }

    .ec-checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13px;
        line-height: 1.6;
        cursor: pointer;
    }

    .ec-checkbox-label input {
        margin-top: 3px;
        accent-color: var(--ec-primary);
    }

    /* Crop modal */

    .ec-crop-modal {
        position: fixed;
        z-index: 999999;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
        background: rgb(15 23 42 / 78%);
        backdrop-filter: blur(5px);
    }

    .ec-crop-modal.is-open {
        display: flex;
    }

    .ec-crop-dialog {
        display: flex;
        width: min(100%, 850px);
        max-height: 94vh;
        flex-direction: column;
        overflow: hidden;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 25px 80px rgb(0 0 0 / 25%);
    }

    .ec-crop-header {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--ec-border);
    }

    .ec-crop-header h2 {
        margin: 0 0 5px;
        font-size: 19px;
        font-weight: 800;
    }

    .ec-crop-header p {
        margin: 0;
        color: var(--ec-muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .ec-crop-close {
        display: flex;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--ec-border);
        border-radius: 9px;
        background: #fff;
        color: #374151;
        font-size: 24px;
        cursor: pointer;
    }

    .ec-crop-body {
        overflow-y: auto;
        padding: 22px 24px;
    }

    .ec-crop-stage {
        height: 390px;
        max-height: 45vh;
        overflow: hidden;
        border-radius: 12px;
        background-color: #111827;
        background-image:
            linear-gradient(45deg, #1f2937 25%, transparent 25%),
            linear-gradient(-45deg, #1f2937 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, #1f2937 75%),
            linear-gradient(-45deg, transparent 75%, #1f2937 75%);
        background-size: 24px 24px;
        background-position: 0 0, 0 12px, 12px -12px, -12px 0;
    }

    .ec-crop-stage img {
        display: block;
        max-width: 100%;
    }

    .ec-crop-controls {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin-top: 18px;
    }

    .ec-crop-control {
        display: flex;
        min-height: 70px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 5px;
        border: 1px solid var(--ec-border);
        border-radius: 10px;
        background: #fff;
        color: #374151;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .ec-crop-control:hover {
        border-color: #c7d2fe;
        background: #f5f3ff;
    }

    .ec-crop-control span {
        font-size: 21px;
        line-height: 1;
    }

    .ec-crop-zoom {
        margin-top: 20px;
    }

    .ec-crop-zoom-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 9px;
        font-size: 12px;
        font-weight: 700;
    }

    .ec-crop-zoom input {
        display: block;
        width: 100%;
        accent-color: var(--ec-primary);
        cursor: pointer;
    }

    .ec-crop-footer {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 18px 24px;
        border-top: 1px solid var(--ec-border);
        background: #fafafa;
    }

    .ec-crop-note {
        color: var(--ec-muted);
        font-size: 12px;
    }

    body.ec-modal-open {
        overflow: hidden;
    }

    @media (max-width: 600px) {
        .ec-profile {
            padding: 20px 14px 45px;
        }

        .ec-grid,
        .ec-image-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .ec-crop-modal {
            padding: 8px;
        }

        .ec-crop-dialog {
            max-height: 96vh;
            border-radius: 13px;
        }

        .ec-crop-header,
        .ec-crop-body {
            padding: 15px;
        }

        .ec-crop-stage {
            height: 300px;
            max-height: 38vh;
        }

        .ec-crop-controls {
            gap: 6px;
        }

        .ec-crop-control {
            min-height: 62px;
            font-size: 10px;
        }

        .ec-crop-footer {
            padding: 13px;
        }

        .ec-crop-footer .ec-buttons {
            width: 100%;
        }

        .ec-crop-footer .ec-btn {
            flex: 1;
        }
    }
</style>

<div class="ec-profile">

    <header class="ec-heading">
        <div class="ec-eyebrow">Account settings</div>
        <h1>Edit your profile</h1>
        <p>Update your information, personalize your photos and manage your privacy on ExamConnect.</p>
    </header>

    <form id="ecProfileForm"
          method="POST"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="ec-alert ec-alert-error" role="alert">
                <strong>Please review the following:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="ec-section">
            <h2>Basic information</h2>
            <p class="ec-section-desc">Help other candidates recognize you and connect with your journey.</p>

            <div class="ec-grid">
                <div class="ec-field">
                    <label class="ec-label" for="name">Display name *</label>
                    <input class="ec-input" type="text" id="name" name="name"
                           value="{{ old('name', $user->name) }}"
                           maxlength="100" required>
                    @error('name') <p class="ec-error">{{ $message }}</p> @enderror
                </div>

                <div class="ec-field">
                    <label class="ec-label" for="username">Username *</label>
                    <input class="ec-input" type="text" id="username" name="username"
                           value="{{ old('username', $user->username) }}"
                           maxlength="30" required>
                    @error('username') <p class="ec-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="ec-field" style="margin-top:22px">
                <label class="ec-label" for="email">Email address *</label>
                <input class="ec-input" type="email" id="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
                @error('email') <p class="ec-error">{{ $message }}</p> @enderror
            </div>

            <div class="ec-grid">
                <div class="ec-field">
                    <label class="ec-label" for="education">Education</label>
                    <input class="ec-input" type="text" id="education" name="education"
                           value="{{ old('education', $user->education) }}"
                           maxlength="160" placeholder="e.g. B.Tech, Graduation">
                    @error('education') <p class="ec-error">{{ $message }}</p> @enderror
                </div>

                <div class="ec-field">
                    <label class="ec-label" for="location">Location</label>
                    <input class="ec-input" type="text" id="location" name="location"
                           value="{{ old('location', $user->location) }}"
                           maxlength="120" placeholder="City, State">
                    @error('location') <p class="ec-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="ec-field" style="margin-top:22px">
                <label class="ec-label" for="preferred_language">Preferred language</label>
                <select class="ec-input" id="preferred_language" name="preferred_language">
                    <option value="en" {{ old('preferred_language', $user->preferred_language) === 'en' ? 'selected' : '' }}>English</option>
                    <option value="hi" {{ old('preferred_language', $user->preferred_language) === 'hi' ? 'selected' : '' }}>Hindi</option>
                    <option value="hinglish" {{ old('preferred_language', $user->preferred_language) === 'hinglish' ? 'selected' : '' }}>Hinglish</option>
                </select>
                @error('preferred_language') <p class="ec-error">{{ $message }}</p> @enderror
            </div>

            <div class="ec-field" style="margin-top:22px;margin-bottom:0">
                <label class="ec-label" for="bio">About you</label>
                <textarea class="ec-input" id="bio" name="bio" rows="4"
                          maxlength="1000"
                          placeholder="Share your preparation journey, goals and interests">{{ old('bio', $user->bio) }}</textarea>
                <p class="ec-hint">Maximum 1,000 characters.</p>
                @error('bio') <p class="ec-error">{{ $message }}</p> @enderror
            </div>
        </section>

        <section class="ec-section">
            <h2>Profile appearance</h2>
            <p class="ec-section-desc">Select a photo or cover, adjust the crop, and preview your changes before saving.</p>

            <div class="ec-image-grid">

                <div class="ec-image-panel">
                    <label class="ec-label">Profile photo</label>

                    <div class="ec-avatar-preview">
                        @if($user->avatar)
                            <img id="ecAvatarPreviewImg"
                                 src="{{ asset('storage/' . $user->avatar) }}"
                                 alt="Current profile photo">
                        @else
                            <div class="ec-placeholder" id="ecAvatarPlaceholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <circle cx="12" cy="8" r="4"></circle>
                                    <path d="M4 21a8 8 0 0 1 16 0"></path>
                                </svg>
                                No profile photo
                            </div>
                            <img id="ecAvatarPreviewImg" alt="Profile preview" hidden>
                        @endif
                    </div>

                    <p class="ec-image-name" id="ecAvatarName">JPG, PNG or WEBP</p>

                    <input class="ec-file-input" type="file" id="avatar" name="avatar"
                           accept="image/jpeg,image/png,image/webp">

                    <div class="ec-buttons">
                        <button type="button" class="ec-btn ec-btn-primary"
                                id="ecChooseAvatar">Choose photo</button>
                        <button type="button" class="ec-btn ec-btn-secondary"
                                id="ecEditAvatar" disabled>Edit crop</button>
                    </div>

                    <p class="ec-hint">Maximum 2 MB. A square crop works best.</p>
                    @error('avatar') <p class="ec-error">{{ $message }}</p> @enderror
                </div>

                <div class="ec-image-panel">
                    <label class="ec-label">Cover image</label>

                    <div class="ec-cover-preview">
                        @if($user->cover)
                            <img id="ecCoverPreviewImg"
                                 src="{{ asset('storage/' . $user->cover) }}"
                                 alt="Current cover image">
                        @else
                            <div class="ec-placeholder" id="ecCoverPlaceholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                    <circle cx="8.5" cy="9" r="1.5"></circle>
                                    <path d="m21 15-5-5L5 20"></path>
                                </svg>
                                No cover image
                            </div>
                            <img id="ecCoverPreviewImg" alt="Cover preview" hidden>
                        @endif
                    </div>

                    <p class="ec-image-name" id="ecCoverName">JPG, PNG or WEBP</p>

                    <input class="ec-file-input" type="file" id="cover" name="cover"
                           accept="image/jpeg,image/png,image/webp">

                    <div class="ec-buttons">
                        <button type="button" class="ec-btn ec-btn-primary"
                                id="ecChooseCover">Choose cover</button>
                        <button type="button" class="ec-btn ec-btn-secondary"
                                id="ecEditCover" disabled>Edit crop</button>
                    </div>

                    <p class="ec-hint">Maximum 4 MB. Wide landscape crop recommended.</p>
                    @error('cover') <p class="ec-error">{{ $message }}</p> @enderror
                </div>

            </div>
        </section>

        <section class="ec-section">
            <h2>Privacy settings</h2>
            <p class="ec-section-desc">Choose which personal details appear on your public profile.</p>

            <label class="ec-checkbox-label">
                <input type="checkbox" name="location_public" value="1"
                    {{ old('location_public', $user->location_public) ? 'checked' : '' }}>
                <span>Show my location on my public profile</span>
            </label>
        </section>

        <div class="ec-form-actions">
            <a href="{{ route('profile.show') }}" class="ec-btn ec-btn-secondary">Cancel</a>
            <button type="submit" class="ec-btn ec-btn-primary" id="ecSaveProfile">Save profile</button>
        </div>
    </form>

    <section class="ec-section" style="margin-top:30px">
        <h2>Change password</h2>
        <p class="ec-section-desc">Choose a strong password to secure your account.</p>

        <form method="POST" action="{{ route('profile.password') }}">
            @csrf
            @method('PUT')

            <div class="ec-field">
                <label class="ec-label" for="current_password">Current password *</label>
                <input class="ec-input" type="password" id="current_password"
                       name="current_password" autocomplete="current-password" required>
                @error('current_password') <p class="ec-error">{{ $message }}</p> @enderror
            </div>

            <div class="ec-field">
                <label class="ec-label" for="password">New password *</label>
                <input class="ec-input" type="password" id="password" name="password"
                       minlength="8" autocomplete="new-password" required>
                @error('password') <p class="ec-error">{{ $message }}</p> @enderror
            </div>

            <div class="ec-field">
                <label class="ec-label" for="password_confirmation">Confirm new password *</label>
                <input class="ec-input" type="password" id="password_confirmation"
                       name="password_confirmation" autocomplete="new-password" required>
                @error('password_confirmation') <p class="ec-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="ec-btn ec-btn-primary">Update password</button>
        </form>
    </section>
</div>

{{-- Image crop modal --}}
<div class="ec-crop-modal" id="ecCropModal"
     role="dialog" aria-modal="true" aria-labelledby="ecCropTitle">

    <div class="ec-crop-dialog">
        <div class="ec-crop-header">
            <div>
                <h2 id="ecCropTitle">Edit image</h2>
                <p>Drag the image to reposition it, or use the tools below.</p>
            </div>
            <button type="button" class="ec-crop-close" id="ecCropClose"
                    aria-label="Close">&times;</button>
        </div>

        <div class="ec-crop-body">
            <div class="ec-crop-stage">
                <img id="ecCropImage" alt="Image crop workspace">
            </div>

            <div class="ec-crop-controls">
                <button type="button" class="ec-crop-control" id="ecZoomOut"><span>−</span>Zoom out</button>
                <button type="button" class="ec-crop-control" id="ecZoomIn"><span>+</span>Zoom in</button>
                <button type="button" class="ec-crop-control" id="ecRotateLeft"><span>↶</span>Rotate left</button>
                <button type="button" class="ec-crop-control" id="ecRotateRight"><span>↷</span>Rotate right</button>
                <button type="button" class="ec-crop-control" id="ecFlipH"><span>↔</span>Flip horizontal</button>
                <button type="button" class="ec-crop-control" id="ecFlipV"><span>↕</span>Flip vertical</button>
                <button type="button" class="ec-crop-control" id="ecReset"><span>⟲</span>Reset</button>
                <button type="button" class="ec-crop-control" id="ecCenter"><span>⊙</span>Center image</button>
            </div>

            <div class="ec-crop-zoom">
                <div class="ec-crop-zoom-row">
                    <label for="ecZoomSlider">Zoom</label>
                    <span id="ecZoomValue">100%</span>
                </div>
                <input type="range" id="ecZoomSlider" min="0" max="100" value="0" step="1">
            </div>
        </div>

        <div class="ec-crop-footer">
            <span class="ec-crop-note">Changes appear in your preview before saving.</span>
            <div class="ec-buttons">
                <button type="button" class="ec-btn ec-btn-secondary" id="ecCropCancel">Cancel</button>
                <button type="button" class="ec-btn ec-btn-primary" id="ecCropApply">Apply crop</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

<script>
(function () {
    'use strict';

    function initializeEditor() {
        const modal = document.getElementById('ecCropModal');
        const cropImage = document.getElementById('ecCropImage');
        const form = document.getElementById('ecProfileForm');

        if (!modal || !cropImage || !form) return;

        const configs = {
            avatar: {
                input: document.getElementById('avatar'),
                preview: document.getElementById('ecAvatarPreviewImg'),
                placeholder: document.getElementById('ecAvatarPlaceholder'),
                name: document.getElementById('ecAvatarName'),
                choose: document.getElementById('ecChooseAvatar'),
                edit: document.getElementById('ecEditAvatar'),
                maxSize: 2 * 1024 * 1024,
                width: 512,
                height: 512,
                ratio: 1,
                title: 'Crop profile photo'
            },
            cover: {
                input: document.getElementById('cover'),
                preview: document.getElementById('ecCoverPreviewImg'),
                placeholder: document.getElementById('ecCoverPlaceholder'),
                name: document.getElementById('ecCoverName'),
                choose: document.getElementById('ecChooseCover'),
                edit: document.getElementById('ecEditCover'),
                maxSize: 4 * 1024 * 1024,
                width: 1600,
                height: 700,
                ratio: 16 / 7,
                title: 'Crop cover image'
            }
        };

        let cropper = null;
        let activeType = null;
        let sourceUrl = null;
        let sourceIsObjectUrl = false;
        let previousFocus = null;
        let initialCropData = null;

        function cleanupCropper() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            cropImage.onload = null;
            cropImage.onerror = null;
            cropImage.removeAttribute('src');

            if (sourceIsObjectUrl && sourceUrl) {
                URL.revokeObjectURL(sourceUrl);
            }

            sourceUrl = null;
            sourceIsObjectUrl = false;
            initialCropData = null;
        }

        function closeModal() {
            modal.classList.remove('is-open');
            document.body.classList.remove('ec-modal-open');

            cleanupCropper();
            activeType = null;

            if (previousFocus) previousFocus.focus();
        }

        function showPreview(type, url, filename) {
            const config = configs[type];

            config.preview.src = url;
            config.preview.hidden = false;

            if (config.placeholder) {
                config.placeholder.hidden = true;
            }

            config.name.textContent = filename || 'Cropped image ready';
            config.edit.disabled = false;
        }

        function updateZoomLabel() {
            if (!cropper) return;

            const data = cropper.getData();
            const natural = cropper.getImageData().naturalWidth;

            if (natural) {
                document.getElementById('ecZoomValue').textContent =
                    Math.round(data.width / natural * 100) + '%';
            }
        }

        function openCropper(type, file, existingUrl) {
            if (typeof Cropper === 'undefined') {
                alert('Cropper.js load nahi hua. Internet connection check karein aur page reload karein.');
                return;
            }

            const config = configs[type];

            cleanupCropper();
            activeType = type;
            previousFocus = document.activeElement;

            document.getElementById('ecCropTitle').textContent = config.title;
            document.getElementById('ecZoomSlider').value = 0;
            document.getElementById('ecZoomValue').textContent = '100%';

            if (file) {
                sourceUrl = URL.createObjectURL(file);
                sourceIsObjectUrl = true;
            } else {
                sourceUrl = existingUrl;
                sourceIsObjectUrl = false;
            }

            if (!sourceUrl) {
                alert('Please select an image first.');
                return;
            }

            modal.classList.add('is-open');
            document.body.classList.add('ec-modal-open');

            cropImage.onerror = function () {
                closeModal();
                alert('Image open nahi ho payi. Please another image choose karein.');
            };

            cropImage.onload = function () {
                if (!activeType || activeType !== type) return;

                cropper = new Cropper(cropImage, {
                    aspectRatio: config.ratio,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.95,
                    responsive: true,
                    restore: false,
                    guides: true,
                    center: true,
                    background: false,
                    movable: true,
                    zoomable: true,
                    zoomOnWheel: true,
                    zoomOnTouch: true,
                    rotatable: true,
                    scalable: true,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    ready: function () {
                        initialCropData = cropper.getData();
                        updateZoomLabel();
                    },
                    zoom: function (event) {
                        if (event.detail.ratio < 0.1) {
                            event.preventDefault();
                        }
                    }
                });
            };

            cropImage.src = sourceUrl;
        }

        Object.keys(configs).forEach(function (type) {
            const config = configs[type];

            config.choose.addEventListener('click', function () {
                config.input.click();
            });

            config.input.addEventListener('change', function () {
                const file = this.files && this.files[0];
                if (!file) return;

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type)) {
                    alert('Only JPG, PNG and WEBP images are allowed.');
                    this.value = '';
                    return;
                }

                if (file.size > config.maxSize) {
                    alert(type === 'avatar'
                        ? 'Profile photo maximum size is 2 MB.'
                        : 'Cover image maximum size is 4 MB.');

                    this.value = '';
                    return;
                }

                this.dataset.cropApplied = '0';
                openCropper(type, file, null);
            });

            config.edit.addEventListener('click', function () {
                const file = config.input.files && config.input.files[0];

                if (file) {
                    openCropper(type, file, null);
                    return;
                }

                if (!config.preview.hidden && config.preview.src) {
                    openCropper(type, null, config.preview.src);
                } else {
                    config.input.click();
                }
            });

            if (!config.preview.hidden && config.preview.getAttribute('src')) {
                config.edit.disabled = false;
            }
        });

        document.getElementById('ecZoomIn').addEventListener('click', function () {
            if (cropper) {
                cropper.zoom(0.1);
                updateZoomLabel();
            }
        });

        document.getElementById('ecZoomOut').addEventListener('click', function () {
            if (cropper) {
                cropper.zoom(-0.1);
                updateZoomLabel();
            }
        });

        document.getElementById('ecZoomSlider').addEventListener('input', function () {
            if (!cropper) return;

            cropper.zoomTo(1 + Number(this.value) / 100 * 2);
            updateZoomLabel();
        });

        document.getElementById('ecRotateLeft').addEventListener('click', function () {
            if (cropper) cropper.rotate(-90);
        });

        document.getElementById('ecRotateRight').addEventListener('click', function () {
            if (cropper) cropper.rotate(90);
        });

        document.getElementById('ecFlipH').addEventListener('click', function () {
            if (!cropper) return;

            const data = cropper.getData();
            cropper.scaleX(data.scaleX === -1 ? 1 : -1);
        });

        document.getElementById('ecFlipV').addEventListener('click', function () {
            if (!cropper) return;

            const data = cropper.getData();
            cropper.scaleY(data.scaleY === -1 ? 1 : -1);
        });

        document.getElementById('ecReset').addEventListener('click', function () {
            if (!cropper) return;

            cropper.reset();
            document.getElementById('ecZoomSlider').value = 0;
            updateZoomLabel();
        });

        document.getElementById('ecCenter').addEventListener('click', function () {
            if (!cropper) return;

            cropper.reset();
            updateZoomLabel();
        });

        document.getElementById('ecCropApply').addEventListener('click', function () {
            if (!cropper || !activeType) return;

            const type = activeType;
            const config = configs[type];
            const button = this;

            button.disabled = true;
            button.textContent = 'Processing...';

            try {
                const canvas = cropper.getCroppedCanvas({
                    width: config.width,
                    height: config.height,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                    fillColor: '#ffffff'
                });

                if (!canvas) throw new Error('Could not create cropped image.');

                canvas.toBlob(function (blob) {
                    button.disabled = false;
                    button.textContent = 'Apply crop';

                    if (!blob) {
                        alert('Image processing failed. Please try again.');
                        return;
                    }

                    const croppedFile = new File(
                        [blob],
                        type === 'avatar' ? 'profile-photo.jpg' : 'cover-image.jpg',
                        { type: 'image/jpeg', lastModified: Date.now() }
                    );

                    // Replace the real file input so Laravel receives the crop.
                    try {
                        const transfer = new DataTransfer();
                        transfer.items.add(croppedFile);
                        config.input.files = transfer.files;
                    } catch (error) {
                        alert('Your browser could not attach the cropped image. Please update your browser.');
                        return;
                    }

                    config.input.dataset.cropApplied = '1';

                    const previewUrl = URL.createObjectURL(blob);

                    if (config.input.dataset.previewUrl) {
                        URL.revokeObjectURL(config.input.dataset.previewUrl);
                    }

                    config.input.dataset.previewUrl = previewUrl;

                    showPreview(type, previewUrl, 'Cropped image ready');
                    closeModal();
                }, 'image/jpeg', 0.92);

            } catch (error) {
                button.disabled = false;
                button.textContent = 'Apply crop';
                console.error(error);
                alert(error.message || 'Unable to crop image.');
            }
        });

        document.getElementById('ecCropClose').addEventListener('click', closeModal);
        document.getElementById('ecCropCancel').addEventListener('click', closeModal);

        modal.addEventListener('click', function (event) {
            if (event.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        form.addEventListener('submit', function (event) {
            for (const type of Object.keys(configs)) {
                const config = configs[type];
                const file = config.input.files && config.input.files[0];

                if (file && config.input.dataset.cropApplied !== '1') {
                    event.preventDefault();
                    alert('Please apply the crop to your ' +
                        (type === 'avatar' ? 'profile photo' : 'cover image') +
                        ' before saving.');
                    return;
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeEditor);
    } else {
        initializeEditor();
    }
})();
</script>
@endsection
