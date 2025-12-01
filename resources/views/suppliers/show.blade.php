@extends('layouts.app')

@section('title', 'Supplier Details')

@section('content')
<div class="space-y-6">
  <div class="sm:flex sm:items-center sm:justify-between">
    <div class="sm:flex-auto">
      <h1 class="text-2xl font-bold text-gray-900">{{ $supplier->name }}</h1>
      <p class="mt-1 text-sm text-gray-500">Supplier details and information</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:flex sm:gap-3">
      <a href="{{ route('suppliers.edit', $supplier) }}"
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
      <a href="{{ route('suppliers.index') }}"
         class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">←
        Back</a>
    </div>
  </div>

  <!-- Supplier Information -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">Supplier Information</h3>
      <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
        <div>
          <dt class="text-sm font-medium text-gray-500">Name</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->name }}</dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Status</dt>
          <dd class="mt-1">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $supplier->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
              {{ $supplier->is_active ? 'Active' : 'Inactive' }}
            </span>
          </dd>
        </div>

        @if($supplier->email)
        <div>
          <dt class="text-sm font-medium text-gray-500">Email</dt>
          <dd class="mt-1 text-sm text-gray-900">
            <a href="mailto:{{ $supplier->email }}"
               class="text-primary-600 hover:text-primary-500">{{ $supplier->email }}</a>
          </dd>
        </div>
        @endif

        @if($supplier->phone)
        <div>
          <dt class="text-sm font-medium text-gray-500">Phone</dt>
          <dd class="mt-1 text-sm text-gray-900">
            <a href="tel:{{ $supplier->phone }}"
               class="text-primary-600 hover:text-primary-500">{{ $supplier->phone }}</a>
          </dd>
        </div>
        @endif

        @if($supplier->contact_person)
        <div>
          <dt class="text-sm font-medium text-gray-500">Contact Person</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->contact_person }}</dd>
        </div>
        @endif

        @if($supplier->city)
        <div>
          <dt class="text-sm font-medium text-gray-500">City</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->city }}</dd>
        </div>
        @endif

        @if($supplier->country)
        <div>
          <dt class="text-sm font-medium text-gray-500">Country</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->country }}</dd>
        </div>
        @endif

        @if($supplier->address)
        <div class="sm:col-span-2">
          <dt class="text-sm font-medium text-gray-500">Address</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->address }}</dd>
        </div>
        @endif

        <div>
          <dt class="text-sm font-medium text-gray-500">Created</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->created_at->format('M j, Y') }}</dd>
        </div>

        <div>
          <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ $supplier->updated_at->format('M j, Y') }}</dd>
        </div>
      </div>
    </div>
  </div>

  <!-- Products from this Supplier (if any) -->
  @if(isset($supplier->products) && $supplier->products->count() > 0)
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">Products from this Supplier</h3>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
              <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
              <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">SKU</th>
              <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Stock</th>
              <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach($supplier->products as $product)
            <tr>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                <a href="{{ route('products.show', $product) }}"
                   class="text-primary-600 hover:text-primary-500">{{ $product->name }}</a>
              </td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->sku }}</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->stock_quantity }}</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">₱{{ number_format($product->price, 2) }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endif

  <!-- Actions -->
  <div class="flex justify-end gap-3">
    <form method="POST"
          action="{{ route('suppliers.toggle-status', $supplier) }}"
          class="inline">
      @csrf @method('PATCH')
      <button type="submit"
              class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500">
        {{ $supplier->is_active ? 'Deactivate' : 'Activate' }} Supplier
      </button>
    </form>
    <form method="POST"
          action="{{ route('suppliers.destroy', $supplier) }}"
          class="inline"
          onsubmit="return confirm('Are you sure you want to delete this supplier? This action cannot be undone.')">
      @csrf @method('DELETE')
      <button type="submit"
              class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">Delete
        Supplier</button>
    </form>
  </div>
</div>
@endsection
