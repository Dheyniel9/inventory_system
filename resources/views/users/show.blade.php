@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="space-y-6">
  <div class="sm:flex sm:items-center sm:justify-between">
    <div class="sm:flex-auto">
      <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
      <p class="mt-1 text-sm text-gray-500">User details and information</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:flex sm:gap-3">
      <a href="{{ route('users.edit', $user) }}"
         class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5"
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
         class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">←
        Back</a>
    </div>
  </div>

  <!-- User Information -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <div class="flex items-center space-x-6 mb-6">
        <div class="flex-shrink-0">
          <img class="h-20 w-20 rounded-full"
               src="{{ $user->avatar_url }}"
               alt="">
        </div>
        <div>
          <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
          <p class="text-sm text-gray-500">{{ $user->email }}</p>
          <div class="mt-2 flex items-center space-x-3">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
              {{ ucfirst($user->roles->first()->name ?? 'No Role') }}
            </span>
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </div>
        </div>
      </div>

      <h4 class="text-base font-semibold leading-6 text-gray-900 mb-4">User Information</h4>
      <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
        <div>
          <dt class="text-sm font-medium text-gray-500">Full Name</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Email Address</dt>
          <dd class="mt-1 text-sm text-gray-900">
            <a href="mailto:{{ $user->email }}"
               class="text-primary-600 hover:text-primary-500">{{ $user->email }}</a>
          </dd>
        </div>

        @if($user->phone)
        <div>
          <dt class="text-sm font-medium text-gray-500">Phone</dt>
          <dd class="mt-1 text-sm text-gray-900">
            <a href="tel:{{ $user->phone }}"
               class="text-primary-600 hover:text-primary-500">{{ $user->phone }}</a>
          </dd>
        </div>
        @endif

        <div>
          <dt class="text-sm font-medium text-gray-500">Role</dt>
          <dd class="mt-1">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
              {{ ucfirst($user->roles->first()->name ?? 'No Role') }}
            </span>
          </dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Account Status</dt>
          <dd class="mt-1">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Email Verified</dt>
          <dd class="mt-1">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
              {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
            </span>
          </dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Member Since</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F j, Y') }}</dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y g:i A') }}</dd>
        </div>
      </div>
    </div>
  </div>

  <!-- Permissions -->
  @if($user->roles->first())
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <h4 class="text-base font-semibold leading-6 text-gray-900 mb-4">Permissions</h4>
      <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($user->roles->first()->permissions as $permission)
        <div class="flex items-center">
          <svg class="h-4 w-4 text-green-500 mr-2"
               fill="currentColor"
               viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
          <span class="text-sm text-gray-700">{{ $permission->name }}</span>
        </div>
        @empty
        <p class="text-sm text-gray-500 col-span-full">No permissions assigned to this role.</p>
        @endforelse
      </div>
    </div>
  </div>
  @endif

  <!-- Actions -->
  @if($user->id !== auth()->id())
  <div class="flex justify-end gap-3">
    <form method="POST"
          action="{{ route('users.toggle-status', $user) }}"
          class="inline">
      @csrf @method('PATCH')
      <button type="submit"
              class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500">
        {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
      </button>
    </form>
    <form method="POST"
          action="{{ route('users.destroy', $user) }}"
          class="inline"
          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
      @csrf @method('DELETE')
      <button type="submit"
              class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">Delete
        User</button>
    </form>
  </div>
  @endif
</div>
@endsection
