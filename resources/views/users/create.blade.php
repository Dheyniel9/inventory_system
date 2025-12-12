@extends('layouts.app')

@section('title', 'Add User')

@section('css')
<style>
  .user-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .user-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .user-title h1 {
    font-size: 1.875rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
  }

  .user-title p {
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #6b7280;
  }

  .user-back-link {
    font-size: 0.875rem;
    font-weight: 500;
    color: #2563eb;
    text-decoration: none;
  }

  .user-back-link:hover {
    color: #1d4ed8;
  }

  .user-form-card {
    border-radius: 0.5rem;
    background: white;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
  }

  .user-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .user-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
  }

  .user-grid-full {
    grid-column: 1 / -1;
  }

  .user-form-group {
    display: flex;
    flex-direction: column;
  }

  .user-form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.25rem;
  }

  .user-form-input,
  .user-form-select,
  .user-form-textarea {
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

  .user-form-input:focus,
  .user-form-select:focus,
  .user-form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .user-form-textarea {
    resize: vertical;
  }

  .user-form-error {
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc2626;
  }

  .user-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    padding-top: 1rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 1rem;
  }

  .user-btn {
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

  .user-btn-cancel {
    background: white;
    color: #111827;
    border: 1px solid #d1d5db;
  }

  .user-btn-cancel:hover {
    background-color: #f9fafb;
  }

  .user-btn-submit {
    background-color: #3b82f6;
    color: white;
  }

  .user-btn-submit:hover {
    background-color: #2563eb;
  }

  @media (max-width: 768px) {
    .user-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .user-grid {
      grid-template-columns: 1fr;
    }

    .user-form-actions {
      flex-direction: column-reverse;
    }
  }
</style>
@endsection

@section('content')
<div class="user-container">
  <div class="user-header">
    <div>
      <h1>Add User</h1>
      <p>Create a new user account</p>
    </div>
    <div>
      <a href="{{ route('users.index') }}"
         class="user-back-link">← Back</a>
    </div>
  </div>

  <form action="{{ route('users.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="user-form-card">
    @csrf
    <div class="user-form">
      <div class="user-grid">
        <div class="user-grid-full">
          <div class="user-form-group">
            <label for="name"
                   class="user-form-label">Full Name *</label>
            <input type="text"
                   name="name"
                   id="name"
                   required
                   value="{{ old('name') }}"
                   class="user-form-input">
            @error('name') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="user-form-group">
            <label for="email"
                   class="user-form-label">Email *</label>
            <input type="email"
                   name="email"
                   id="email"
                   required
                   value="{{ old('email') }}"
                   class="user-form-input">
            @error('email') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="user-form-group">
            <label for="phone"
                   class="user-form-label">Phone</label>
            <input type="text"
                   name="phone"
                   id="phone"
                   value="{{ old('phone') }}"
                   class="user-form-input">
            @error('phone') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="user-form-group">
            <label for="password"
                   class="user-form-label">Password *</label>
            <input type="password"
                   name="password"
                   id="password"
                   required
                   class="user-form-input">
            @error('password') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="user-form-group">
            <label for="password_confirmation"
                   class="user-form-label">Confirm Password *</label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   required
                   class="user-form-input">
            @error('password_confirmation') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="user-form-group">
            <label for="role"
                   class="user-form-label">Role *</label>
            <select name="role"
                    id="role"
                    required
                    class="user-form-select">
              <option value="">Select Role</option>
              @foreach($roles as $role)
              <option value="{{ $role->name }}"
                      {{
                      old('role')==$role->name ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
              </option>
              @endforeach
            </select>
            @error('role') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <div class="user-form-group">
            <label for="avatar"
                   class="user-form-label">Avatar</label>
            <input type="file"
                   name="avatar"
                   id="avatar"
                   accept="image/*"
                   class="user-form-input">
            @error('avatar') <p class="user-form-error">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="user-grid-full">
          <div style="display: flex; align-items: center;">
            <input type="hidden"
                   name="is_active"
                   value="0">
            <input type="checkbox"
                   name="is_active"
                   id="is_active"
                   value="1"
                   {{
                   old('is_active',
                   true)
                   ? 'checked'
                   : ''
                   }}
                   style="width: 1rem; height: 1rem;">
            <label for="is_active"
                   style="margin-left: 0.5rem; font-size: 0.875rem;">Active User</label>
          </div>
        </div>
      </div>

      <div class="user-form-actions">
        <a href="{{ route('users.index') }}"
           class="user-btn user-btn-cancel">Cancel</a>
        <button type="submit"
                class="user-btn user-btn-submit">Create User</button>
      </div>
    </div>
  </form>
</div>
@endsection
