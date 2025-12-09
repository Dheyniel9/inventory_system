@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="content-stack">
  <div class="header-row">
    <div class="header-title">
      <h1>{{ $user->name }}</h1>
      <p class="subhead">User details and information</p>
    </div>
    <div class="header-actions">
      <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="icon">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        Edit
      </a>
      <a href="{{ route('users.index') }}" class="btn btn-outline">← Back</a>
    </div>
  </div>

  <div class="card-panel">
    <div class="card-body">
      <div class="user-top">
        <div class="avatar-wrapper">
          <img src="{{ $user->avatar_url }}" alt="" class="avatar">
        </div>
        <div>
          <h3>{{ $user->name }}</h3>
          <p class="subhead">{{ $user->email }}</p>
          <div class="badge-row">
            <span class="badge status">{{ ucfirst($user->roles->first()->name ?? 'No Role') }}</span>
            <span class="badge {{ $user->is_active ? 'badge-success' : 'badge-muted' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </div>
        </div>
      </div>

      <h4>User Information</h4>
      <div class="info-grid">
        <div>
          <dt class="info-label">Full Name</dt>
          <dd class="info-value">{{ $user->name }}</dd>
        </div>

        <div>
          <dt class="info-label">Email Address</dt>
          <dd class="info-value">
            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
          </dd>
        </div>

        @if($user->phone)
        <div>
          <dt class="info-label">Phone</dt>
          <dd class="info-value">
            <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
          </dd>
        </div>
        @endif

        <div>
          <dt class="info-label">Role</dt>
          <dd class="info-value">
            <span class="badge status">{{ ucfirst($user->roles->first()->name ?? 'No Role') }}</span>
          </dd>
        </div>

        <div>
          <dt class="info-label">Account Status</dt>
          <dd class="info-value">
            <span class="badge {{ $user->is_active ? 'badge-success' : 'badge-muted' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </dd>
        </div>

        <div>
          <dt class="info-label">Email Verified</dt>
          <dd class="info-value">
            <span class="badge {{ $user->email_verified_at ? 'badge-success' : 'badge-warning' }}">
              {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
            </span>
          </dd>
        </div>

        <div>
          <dt class="info-label">Member Since</dt>
          <dd class="info-value">{{ $user->created_at->format('F j, Y') }}</dd>
        </div>

        <div>
          <dt class="info-label">Last Updated</dt>
          <dd class="info-value">{{ $user->updated_at->format('F j, Y g:i A') }}</dd>
        </div>
      </div>
    </div>
  </div>

  @if($user->roles->first())
  <div class="card-panel">
    <div class="card-body">
      <h4>Permissions</h4>
      <div class="permissions-grid">
        @forelse($user->roles->first()->permissions as $permission)
        <div class="permission-row">
          <svg viewBox="0 0 20 20" fill="currentColor" class="permission-icon">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
          </svg>
          <span>{{ $permission->name }}</span>
        </div>
        @empty
        <p class="info-muted">No permissions assigned to this role.</p>
        @endforelse
      </div>
    </div>
  </div>
  @endif

  @if($user->id !== auth()->id())
  <div class="actions-row">
    <form method="POST" action="{{ route('users.toggle-status', $user) }}">
      @csrf @method('PATCH')
      <button type="submit" class="btn btn-warning">
        {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
      </button>
    </form>
    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
      @csrf @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete User</button>
    </form>
  </div>
  @endif
</div>

<style>
  :root {
    --border: 1px solid #d1d5db;
    --shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
  }

  .content-stack {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .header-title h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
  }

  .subhead {
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #6b7280;
  }

  .header-actions {
    display: flex;
    gap: 0.75rem;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    border: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }

  .btn .icon {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.25rem;
  }

  .btn-primary {
    background-color: #2563eb;
    color: #fff;
  }

  .btn-primary:hover {
    background-color: #3b82f6;
  }

  .btn-outline {
    background-color: #fff;
    color: #111827;
    border: var(--border);
  }

  .btn-outline:hover {
    background-color: #f9fafb;
  }

  .card-panel {
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: var(--shadow);
  }

  .card-body {
    padding: 1rem;
  }

  .user-top {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
  }

  .avatar {
    width: 5rem;
    height: 5rem;
    border-radius: 9999px;
    object-fit: cover;
  }

  .badge-row {
    display: flex;
    gap: 0.75rem;
    margin-top: 0.5rem;
  }

  .badge {
    border-radius: 9999px;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
  }

  .badge.status {
    background-color: #dbeafe;
    color: #1e40af;
  }

  .badge-success {
    background-color: #dcfce7;
    color: #166534;
  }

  .badge-muted {
    background-color: #f3f4f6;
    color: #374151;
  }

  .badge-warning {
    background-color: #fef08a;
    color: #92400e;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
    gap: 1.5rem;
  }

  .info-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
  }

  .info-value {
    font-size: 0.875rem;
    color: #111827;
    margin-top: 0.25rem;
  }

  .info-value a {
    color: #2563eb;
  }

  .info-value a:hover {
    color: #3b82f6;
  }

  .permissions-grid {
    display: grid;
    gap: 0.5rem;
  }

  .permission-row {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #374151;
    font-size: 0.875rem;
  }

  .permission-icon {
    width: 1rem;
    height: 1rem;
    color: #22c55e;
  }

  .info-muted {
    color: #6b7280;
    font-size: 0.875rem;
  }

  .actions-row {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
  }

  .btn-warning {
    background-color: #ca8a04;
    color: #fff;
  }

  .btn-warning:hover {
    background-color: #eab308;
  }

  .btn-danger {
    background-color: #dc2626;
    color: #fff;
  }

  .btn-danger:hover {
    background-color: #ef4444;
  }

  @media (min-width: 768px) {
    .info-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }
</style>
@endsection
