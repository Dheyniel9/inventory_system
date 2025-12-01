@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="space-y-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-900">Profile</h1>
    <p class="mt-1 text-sm text-gray-500">Manage your personal information and account settings</p>
  </div>

  <!-- Profile Information -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
      <form action="{{ route('profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div class="sm:col-span-2 flex items-center space-x-6">
            <div class="flex-shrink-0">
              <img class="h-16 w-16 rounded-full"
                   src="{{ $user->avatar_url }}"
                   alt="">
            </div>
            <div class="flex-1">
              <label for="avatar"
                     class="block text-sm font-medium text-gray-700">Profile Photo</label>
              <input type="file"
                     name="avatar"
                     id="avatar"
                     accept="image/*"
                     class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
              @if($user->avatar)
              <div class="mt-2 flex items-center">
                <input type="checkbox"
                       name="remove_avatar"
                       id="remove_avatar"
                       value="1"
                       class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                <label for="remove_avatar"
                       class="ml-2 text-sm text-red-600">Remove current photo</label>
              </div>
              @endif
              @error('avatar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label for="name"
                   class="block text-sm font-medium text-gray-700">Full Name *</label>
            <input type="text"
                   name="name"
                   id="name"
                   required
                   value="{{ old('name', $user->name) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="email"
                   class="block text-sm font-medium text-gray-700">Email Address *</label>
            <input type="email"
                   name="email"
                   id="email"
                   required
                   value="{{ old('email', $user->email) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="phone"
                   class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text"
                   name="phone"
                   id="phone"
                   value="{{ old('phone', $user->phone) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->roles->first()->name ?? 'No Role') }}</p>
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit"
                  class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
            Update Profile
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Change Password -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
      <form action="{{ route('profile.password') }}"
            method="POST"
            class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
          <div>
            <label for="current_password"
                   class="block text-sm font-medium text-gray-700">Current Password *</label>
            <input type="password"
                   name="current_password"
                   id="current_password"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password"
                   class="block text-sm font-medium text-gray-700">New Password *</label>
            <input type="password"
                   name="password"
                   id="password"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password_confirmation"
                   class="block text-sm font-medium text-gray-700">Confirm New Password *</label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit"
                  class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
            Change Password
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Account Information -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <h3 class="text-lg font-medium text-gray-900 mb-4">Account Information</h3>
      <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
        <div>
          <dt class="text-sm font-medium text-gray-500">Member Since</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F j, Y') }}</dd>
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
          <dt class="text-sm font-medium text-gray-500">Account Status</dt>
          <dd class="mt-1">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Last Profile Update</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y g:i A') }}</dd>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
