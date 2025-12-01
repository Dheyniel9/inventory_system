@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="space-y-6">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-2xl font-bold text-gray-900">Edit Supplier</h1>
      <p class="mt-1 text-sm text-gray-500">Update supplier information</p>
    </div>
    <div class="mt-4 sm:mt-0">
      <a href="{{ route('suppliers.index') }}"
         class="text-sm font-medium text-primary-600 hover:text-primary-500">← Back</a>
    </div>
  </div>

  <form action="{{ route('suppliers.update', $supplier) }}"
        method="POST"
        class="rounded-lg bg-white shadow">
    @csrf
    @method('PUT')
    <div class="space-y-6 p-6">
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="sm:col-span-2">
          <label for="name"
                 class="block text-sm font-medium text-gray-700">Name *</label>
          <input type="text"
                 name="name"
                 id="name"
                 required
                 value="{{ old('name', $supplier->name) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="email"
                 class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email"
                 name="email"
                 id="email"
                 value="{{ old('email', $supplier->email) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="phone"
                 class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text"
                 name="phone"
                 id="phone"
                 value="{{ old('phone', $supplier->phone) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="contact_person"
                 class="block text-sm font-medium text-gray-700">Contact Person</label>
          <input type="text"
                 name="contact_person"
                 id="contact_person"
                 value="{{ old('contact_person', $supplier->contact_person) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('contact_person') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="city"
                 class="block text-sm font-medium text-gray-700">City</label>
          <input type="text"
                 name="city"
                 id="city"
                 value="{{ old('city', $supplier->city) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="country"
                 class="block text-sm font-medium text-gray-700">Country</label>
          <input type="text"
                 name="country"
                 id="country"
                 value="{{ old('country', $supplier->country) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('country') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="sm:col-span-2">
          <label for="address"
                 class="block text-sm font-medium text-gray-700">Address</label>
          <textarea name="address"
                    id="address"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('address', $supplier->address) }}</textarea>
          @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="sm:col-span-2">
          <div class="flex items-center">
            <input type="hidden"
                   name="is_active"
                   value="0">
            <input type="checkbox"
                   name="is_active"
                   id="is_active"
                   value="1"
                   {{
                   old('is_active',
                   $supplier->is_active) ? 'checked' : '' }}
            class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
            <label for="is_active"
                   class="ml-2 block text-sm text-gray-900">Active</label>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-3 border-t px-6 py-4">
      <a href="{{ route('suppliers.index') }}"
         class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</a>
      <button type="submit"
              class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">Update</button>
    </div>
  </form>
</div>
@endsection
