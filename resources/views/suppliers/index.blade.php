@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<div class="space-y-6">
  <div class="sm:flex sm:items-center sm:justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-900">Suppliers</h1>
      <p class="mt-1 text-sm text-gray-500">Manage your business suppliers</p>
    </div>
    <div class="mt-4 sm:mt-0">
      <a href="{{ route('suppliers.create') }}"
         class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5"
             viewBox="0 0 20 20"
             fill="currentColor">
          <path
                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
        </svg>
        Add Supplier
      </a>
    </div>
  </div>

  <!-- Search and Filters -->
  <div class="rounded-lg bg-white p-4 shadow">
    <form method="GET"
          class="flex flex-col gap-4 sm:flex-row">
      <div class="flex-1">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Search suppliers..."
               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
      </div>
      <div>
        <select name="is_active"
                class="block rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <option value="">All Status</option>
          <option value="1"
                  {{
                  request('is_active')=='1'
                  ? 'selected'
                  : ''
                  }}>Active</option>
          <option value="0"
                  {{
                  request('is_active')=='0'
                  ? 'selected'
                  : ''
                  }}>Inactive</option>
        </select>
      </div>
      <div>
        <input type="text"
               name="city"
               value="{{ request('city') }}"
               placeholder="Filter by city..."
               class="block rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
      </div>
      <div>
        <input type="text"
               name="country"
               value="{{ request('country') }}"
               placeholder="Filter by country..."
               class="block rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
      </div>
      <button type="submit"
              class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
        Search
      </button>
      <a href="{{ route('suppliers.index') }}"
         class="inline-flex items-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">
        Reset
      </a>
    </form>
  </div>

  <!-- Table -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <table class="min-w-full divide-y divide-gray-300">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col"
              class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Contact</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Location</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Contact Person</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
          <th scope="col"
              class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 bg-white">
        @forelse($suppliers as $supplier)
        <tr>
          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
            {{ $supplier->name }}
            @if($supplier->address)
            <p class="text-xs text-gray-500 truncate max-w-xs">{{ $supplier->address }}</p>
            @endif
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            @if($supplier->email)
            <div>{{ $supplier->email }}</div>
            @endif
            @if($supplier->phone)
            <div>{{ $supplier->phone }}</div>
            @endif
            @if(!$supplier->email && !$supplier->phone)
            -
            @endif
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            @if($supplier->city || $supplier->country)
            {{ collect([$supplier->city, $supplier->country])->filter()->implode(', ') }}
            @else
            -
            @endif
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $supplier->contact_person ?? '-' }}</td>
          <td class="whitespace-nowrap px-3 py-4 text-sm">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $supplier->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
              {{ $supplier->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
            <div class="flex items-center justify-end gap-2">
              <a href="{{ route('suppliers.show', $supplier) }}"
                 class="text-primary-600 hover:text-primary-900">View</a>
              <a href="{{ route('suppliers.edit', $supplier) }}"
                 class="text-primary-600 hover:text-primary-900">Edit</a>
              <form method="POST"
                    action="{{ route('suppliers.toggle-status', $supplier) }}"
                    class="inline">
                @csrf @method('PATCH')
                <button type="submit"
                        class="text-yellow-600 hover:text-yellow-900">
                  {{ $supplier->is_active ? 'Deactivate' : 'Activate' }}
                </button>
              </form>
              <form method="POST"
                    action="{{ route('suppliers.destroy', $supplier) }}"
                    class="inline"
                    onsubmit="return confirm('Are you sure?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="text-red-600 hover:text-red-900">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6"
              class="px-6 py-12 text-center text-sm text-gray-500">No suppliers found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    @if($suppliers->hasPages())
    <div class="border-t border-gray-200 px-4 py-3 sm:px-6">{{ $suppliers->links() }}</div>
    @endif
  </div>
</div>
@endsection
