@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<style>
  .space-y-6 > * + * { margin-top: 1.5rem; }
</style>
<div class="space-y-6">
  <div style="display: flex; align-items: center; justify-content: space-between;">
    <div style="flex: 1;">
      <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">{{ $user->name }}</h1>
      <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">User details and information</p>
    </div>
    <div style="margin-top: 1rem; display: flex; gap: 0.75rem;">
      <a href="{{ route('users.edit', $user) }}"
         style="display: inline-flex; align-items: center; border-radius: 0.375rem; background-color: #2563eb; padding: 0.75rem 0.5rem; font-size: 0.875rem; font-weight: 600; color: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;" onmouseover="this.style.backgroundColor='#3b82f6'" onmouseout="this.style.backgroundColor='#2563eb'">
        <svg style="margin-left: -0.125rem; margin-right: 0.375rem; width: 1.25rem; height: 1.25rem;"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor">
          <path stroke-linecap="round"
                stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        Edit
      </a>
      <a href="{{ route('users.index') }}"
         style="display: inline-flex; align-items: center; border-radius: 0.375rem; background-color: white; padding: 0.75rem 0.5rem; font-size: 0.875rem; font-weight: 600; color: #111827; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #d1d5db; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">←
        Back</a>
    </div>
  </div>

  <!-- User Information -->
  <div style="overflow: hidden; border-radius: 0.5rem; background-color: white; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
    <div style="padding: 1rem;">
      <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
        <div style="flex-shrink: 0;">
          <img style="height: 5rem; width: 5rem; border-radius: 9999px;"
               src="{{ $user->avatar_url }}"
               alt="">
        </div>
        <div>
          <h3 style="font-size: 1.125rem; font-weight: 500; color: #111827;">{{ $user->name }}</h3>
          <p style="font-size: 0.875rem; color: #6b7280;">{{ $user->email }}</p>
          <div style="margin-top: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
            <span style="display: inline-flex; align-items: center; border-radius: 9999px; padding: 0.625rem; font-size: 0.75rem; font-weight: 500; background-color: #dbeafe; color: #1e40af;">
              {{ ucfirst($user->roles->first()->name ?? 'No Role') }}
            </span>
            <span style="display: inline-flex; align-items: center; border-radius: 9999px; padding: 0.625rem; font-size: 0.75rem; font-weight: 500; background-color: {{ $user->is_active ? '#dcfce7' : '#f3f4f6' }}; color: {{ $user->is_active ? '#166534' : '#374151' }};">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </div>
        </div>
      </div>

      <h4 style="font-size: 1rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">User Information</h4>
      <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); column-gap: 1rem; row-gap: 1.5rem;">
        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Full Name</dt>
          <dd style="margin-top: 0.25rem; font-size: 0.875rem; color: #111827;">{{ $user->name }}</dd>
        </div>

        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Email Address</dt>
          <dd style="margin-top: 0.25rem; font-size: 0.875rem; color: #111827;">
            <a href="mailto:{{ $user->email }}" style="color: #2563eb; text-decoration: none;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#2563eb'">{{ $user->email }}</a>
          </dd>
        </div>

        @if($user->phone)
        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Phone</dt>
          <dd style="margin-top: 0.25rem; font-size: 0.875rem; color: #111827;">
            <a href="tel:{{ $user->phone }}" style="color: #2563eb; text-decoration: none;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#2563eb'">{{ $user->phone }}</a>
          </dd>
        </div>
        @endif

        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Role</dt>
          <dd style="margin-top: 0.25rem;">
            <span style="display: inline-flex; align-items: center; border-radius: 9999px; padding: 0.625rem; font-size: 0.75rem; font-weight: 500; background-color: #dbeafe; color: #1e40af;">
              {{ ucfirst($user->roles->first()->name ?? 'No Role') }}
            </span>
          </dd>
        </div>

        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Account Status</dt>
          <dd style="margin-top: 0.25rem;">
            <span style="display: inline-flex; align-items: center; border-radius: 9999px; padding: 0.625rem; font-size: 0.75rem; font-weight: 500; background-color: {{ $user->is_active ? '#dcfce7' : '#f3f4f6' }}; color: {{ $user->is_active ? '#166534' : '#374151' }};">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </dd>
        </div>

        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Email Verified</dt>
          <dd style="margin-top: 0.25rem;">
            <span style="display: inline-flex; align-items: center; border-radius: 9999px; padding: 0.625rem; font-size: 0.75rem; font-weight: 500; background-color: {{ $user->email_verified_at ? '#dcfce7' : '#fef08a' }}; color: {{ $user->email_verified_at ? '#166534' : '#92400e' }};">
              {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
            </span>
          </dd>
        </div>

        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Member Since</dt>
          <dd style="margin-top: 0.25rem; font-size: 0.875rem; color: #111827;">{{ $user->created_at->format('F j, Y') }}</dd>
        </div>

        <div>
          <dt style="font-size: 0.875rem; font-weight: 500; color: #6b7280;">Last Updated</dt>
          <dd style="margin-top: 0.25rem; font-size: 0.875rem; color: #111827;">{{ $user->updated_at->format('F j, Y g:i A') }}</dd>
        </div>
      </div>
    </div>
  </div>

  <!-- Permissions -->
  @if($user->roles->first())
  <div style="overflow: hidden; border-radius: 0.5rem; background-color: white; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
    <div style="padding: 1rem;">
      <h4 style="font-size: 1rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Permissions</h4>
      <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 0.5rem;">
        @forelse($user->roles->first()->permissions as $permission)
        <div style="display: flex; align-items: center;">
          <svg style="height: 1rem; width: 1rem; color: #22c55e; margin-right: 0.5rem;"
               fill="currentColor"
               viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
          <span style="font-size: 0.875rem; color: #374151;">{{ $permission->name }}</span>
        </div>
        @empty
        <p style="font-size: 0.875rem; color: #6b7280; grid-column: 1 / -1;">No permissions assigned to this role.</p>
        @endforelse
      </div>
    </div>
  </div>
  @endif

  <!-- Actions -->
  @if($user->id !== auth()->id())
  <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
    <form method="POST"
          action="{{ route('users.toggle-status', $user) }}"
          class="inline">
      @csrf @method('PATCH')
      <button type="submit"
              style="border-radius: 0.375rem; background-color: #ca8a04; padding: 0.75rem 0.5rem; font-size: 0.875rem; font-weight: 600; color: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#eab308'" onmouseout="this.style.backgroundColor='#ca8a04'">
        {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
      </button>
    </form>
    <form method="POST"
          action="{{ route('users.destroy', $user) }}"
          class="inline"
          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
      @csrf @method('DELETE')
      <button type="submit"
              style="border-radius: 0.375rem; background-color: #dc2626; padding: 0.75rem 0.5rem; font-size: 0.875rem; font-weight: 600; color: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#ef4444'" onmouseout="this.style.backgroundColor='#dc2626'">Delete
        User</button>
    </form>
  </div>
  @endif
</div>
@endsection
