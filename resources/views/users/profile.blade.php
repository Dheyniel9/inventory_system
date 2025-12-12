@extends('layouts.app')

@section('title', 'Profile')

@section('css')
<style>
  .profile-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .profile-header h1 {
    font-size: 1.875rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
  }

  .profile-header p {
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #6b7280;
  }

  .profile-card {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
  }

  .profile-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #111827;
    margin: 0 0 1rem 0;
  }

  .profile-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .profile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
  }

  .profile-grid-full {
    grid-column: 1 / -1;
  }

  .profile-avatar-section {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
  }

  .profile-avatar-wrapper {
    flex-shrink: 0;
  }

  .profile-avatar {
    width: 4rem;
    height: 4rem;
    border-radius: 9999px;
    object-fit: cover;
  }

  .profile-avatar-input {
    flex: 1;
  }

  .profile-form-group {
    display: flex;
    flex-direction: column;
  }

  .profile-form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.25rem;
  }

  .profile-form-input,
  .profile-form-textarea {
    margin-top: 0.25rem;
    display: block;
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    font-size: 0.875rem;
    font-family: inherit;
  }

  .profile-form-input:focus,
  .profile-form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .profile-form-error {
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc2626;
  }

  .profile-file-input {
    display: block;
    width: 100%;
    font-size: 0.875rem;
  }

  .profile-file-input::file-selector-button {
    margin-right: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    border: none;
    font-size: 0.875rem;
    font-weight: 600;
    background-color: #f0f9ff;
    color: #0c4a6e;
    cursor: pointer;
  }

  .profile-file-input::file-selector-button:hover {
    background-color: #e0f2fe;
  }

  .profile-checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
  }

  .profile-checkbox {
    width: 1rem;
    height: 1rem;
  }

  .profile-checkbox-label {
    font-size: 0.875rem;
    color: #dc2626;
  }

  .profile-info-text {
    font-size: 0.875rem;
    color: #6b7280;
  }

  .profile-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    padding-top: 1rem;
  }

  .profile-btn {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    transition: background-color 0.2s;
  }

  .profile-btn-submit {
    background-color: #3b82f6;
    color: white;
  }

  .profile-btn-submit:hover {
    background-color: #2563eb;
  }

  .profile-btn-link {
    color: #2563eb;
    text-decoration: none;
    font-size: 0.875rem;
  }

  .profile-btn-link:hover {
    color: #1d4ed8;
  }

  @media (max-width: 768px) {
    .profile-avatar-section {
      flex-direction: column;
    }

    .profile-grid {
      grid-template-columns: 1fr;
    }

    .profile-form-actions {
      flex-direction: column-reverse;
    }
  }
</style>
@endsection

@section('content')
<div class="profile-container">
  <div class="profile-header">
    <h1 style="font-size: 1.875rem; font-weight: 700; color: #111827; margin: 0;">Profile</h1>
    <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Manage your personal information and account
      settings</p>
  </div>

  <!-- Profile Information -->
  <div class="profile-card">
    <h3>Profile Information</h3>
    <form action="{{ route('profile.update') }}"
          method="POST"
          enctype="multipart/form-data"
          class="profile-form">
      @csrf
      @method('PUT')

      <div class="profile-grid">
        <div class="profile-grid-full profile-avatar-section">
          <div class="profile-avatar-wrapper">
            <img class="profile-avatar"
                 src="{{ $user->avatar_url }}"
                 alt="">
          </div>
          <div class="profile-avatar-input">
            <div class="profile-form-group">
              <label for="avatar"
                     class="profile-form-label">Profile Photo</label>
              <input type="file"
                     name="avatar"
                     id="avatar"
                     accept="image/*"
                     class="profile-file-input">
              @if($user->avatar)
              <div class="profile-checkbox-group">
                <input type="checkbox"
                       name="remove_avatar"
                       id="remove_avatar"
                       value="1"
                       class="profile-checkbox">
                <label for="remove_avatar"
                       class="profile-checkbox-label">Remove current photo</label>
              </div>
              @endif
              @error('avatar') <p class="profile-form-error">{{ $message }}</p> @enderror
            </div>
          </div>
        </div>

        <div>
          <div class="profile-form-group">
            <label for="name"
                   class="profile-form-label">Full Name *</label>
            <input type="text"
                   name="name"
                   id="name"
                   required
                   value="{{ old('name', $user->name) }}"
                   class="profile-form-input">
            @error('name') <p class="profile-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="profile-form-group">
            <label for="email"
                   class="profile-form-label">Email Address *</label>
            <input type="email"
                   name="email"
                   id="email"
                   required
                   value="{{ old('email', $user->email) }}"
                   class="profile-form-input">
            @error('email') <p class="profile-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="profile-form-group">
            <label for="phone"
                   class="profile-form-label">Phone Number</label>
            <input type="text"
                   name="phone"
                   id="phone"
                   value="{{ old('phone', $user->phone) }}"
                   class="profile-form-input">
            @error('phone') <p class="profile-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="profile-form-group">
            <label class="profile-form-label">Role</label>
            <p class="profile-info-text"
               style="margin-top: 0.25rem;">{{ ucfirst($user->roles->first()->name ?? 'No Role') }}</p>
          </div>
        </div>
      </div>

      <div class="profile-form-actions">
        <button type="submit"
                class="profile-btn profile-btn-submit">
          Update Profile
        </button>
      </div>
    </form>
  </div>

  <!-- Change Password -->
  <div class="profile-card">
    <h3>Change Password</h3>
    <form action="{{ route('profile.password') }}"
          method="POST"
          class="profile-form">
      @csrf
      @method('PUT')

      <div class="profile-grid">
        <div class="profile-grid-full">
          <div class="profile-form-group">
            <label for="current_password"
                   class="profile-form-label">Current Password *</label>
            <input type="password"
                   name="current_password"
                   id="current_password"
                   required
                   class="profile-form-input">
            @error('current_password') <p class="profile-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="profile-grid-full">
          <div class="profile-form-group">
            <label for="password"
                   class="profile-form-label">New Password *</label>
            <input type="password"
                   name="password"
                   id="password"
                   required
                   class="profile-form-input">
            @error('password') <p class="profile-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="profile-grid-full">
          <div class="profile-form-group">
            <label for="password_confirmation"
                   class="profile-form-label">Confirm New Password *</label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   required
                   class="profile-form-input">
            @error('password_confirmation') <p class="profile-form-error">{{ $message }}</p> @enderror
          </div>
        </div>
      </div>

      <div class="profile-form-actions">
        <button type="submit"
                class="profile-btn profile-btn-submit">
          Change Password
        </button>
      </div>
    </form>
  </div>

  <!-- Account Information -->
  <div class="profile-card">
    <h3>Account Information</h3>
    <div class="profile-grid">
      <div>
        <dt class="profile-form-label">Member Since</dt>
        <dd class="profile-info-text">{{ $user->created_at->format('F j, Y') }}</dd>
      </div>

      <div>
        <dt class="profile-form-label">Email Verified</dt>
        <dd class="profile-info-text">
          <span class="user-status-badge"
                style="{{ $user->email_verified_at ? 'background-color: #dcfce7; color: #166534;' : 'background-color: #fef08a; color: #92400e;' }}">
            {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
          </span>
        </dd>
      </div>

      <div>
        <dt class="profile-form-label">Account Status</dt>
        <dd class="profile-info-text">
          <span class="user-status-badge {{ $user->is_active ? 'user-status-active' : 'user-status-inactive' }}">
            {{ $user->is_active ? 'Active' : 'Inactive' }}
          </span>
        </dd>
      </div>

      <div>
        <dt class="profile-form-label">Last Profile Update</dt>
        <dd class="profile-info-text">{{ $user->updated_at->format('F j, Y g:i A') }}</dd>
      </div>
    </div>
  </div>
</div>
@endsection
