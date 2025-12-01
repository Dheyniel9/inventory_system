@extends('layouts.app')

@section('title', 'Stock In')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Stock In</h1>
            <p class="mt-1 text-sm text-gray-500">Record incoming inventory</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('stock.index') }}"
               class="text-sm font-medium text-primary-600 hover:text-primary-500">
                ← Back to Transactions
            </a>
        </div>
    </div>

    <div class="rounded-lg bg-white shadow">
        <form action="{{ route('stock.in.process') }}"
              method="POST"
              class="space-y-6 p-6">
            @csrf
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="product_id"
                           class="block text-sm font-medium text-gray-700">Product *</label>
                    <select name="product_id"
                            id="product_id"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}"
                                {{
                                (old('product_id')
                                ??
                                request('product_id'))==$product->id ? 'selected' : '' }}>
                            {{ $product->name }} ({{ $product->sku }}) - Current: {{ $product->quantity }}
                        </option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="quantity"
                           class="block text-sm font-medium text-gray-700">Quantity *</label>
                    <input type="number"
                           name="quantity"
                           id="quantity"
                           required
                           min="1"
                           value="{{ old('quantity', 1) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @error('quantity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="unit_cost"
                           class="block text-sm font-medium text-gray-700">Unit Cost</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">₱</span>
                        </div>
                        <input type="number"
                               name="unit_cost"
                               id="unit_cost"
                               step="0.01"
                               min="0"
                               value="{{ old('unit_cost') }}"
                               placeholder="Uses product cost if empty"
                               class="block w-full rounded-md border-gray-300 pl-7 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    @error('unit_cost') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="transaction_date"
                           class="block text-sm font-medium text-gray-700">Transaction Date</label>
                    <input type="datetime-local"
                           name="transaction_date"
                           id="transaction_date"
                           value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @error('transaction_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="reason"
                           class="block text-sm font-medium text-gray-700">Reason</label>
                    <input type="text"
                           name="reason"
                           id="reason"
                           value="{{ old('reason') }}"
                           placeholder="e.g., Purchase order #123"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @error('reason') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="notes"
                           class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes"
                              id="notes"
                              rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('notes') }}</textarea>
                    @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('stock.index') }}"
                   class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                    Record Stock In
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
