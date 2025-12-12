@extends('layouts.app')

@section('title', 'Stock Out')

@section('css')
<style>
    .stock-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .stock-title h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .stock-title p {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .stock-back-link {
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
    }

    .stock-back-link:hover {
        color: #1d4ed8;
    }

    .stock-form-card {
        border-radius: 0.5rem;
        background: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }

    .stock-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .stock-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .stock-grid-full {
        grid-column: 1 / -1;
    }

    .stock-form-group {
        display: flex;
        flex-direction: column;
    }

    .stock-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .stock-form-input,
    .stock-form-select,
    .stock-form-textarea {
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

    .stock-form-input:focus,
    .stock-form-select:focus,
    .stock-form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .stock-form-textarea {
        resize: vertical;
    }

    .stock-form-error {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc2626;
    }

    .stock-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        margin-top: 1rem;
    }

    .stock-btn {
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

    .stock-btn-cancel {
        background: white;
        color: #111827;
        border: 1px solid #d1d5db;
    }

    .stock-btn-cancel:hover {
        background-color: #f9fafb;
    }

    .stock-btn-submit {
        background-color: #dc2626;
        color: white;
    }

    .stock-btn-submit:hover {
        background-color: #b91c1c;
    }

    .stock-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .stock-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stock-grid {
            grid-template-columns: 1fr;
        }

        .stock-form-actions {
            flex-direction: column-reverse;
        }
    }
</style>
@endsection

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Stock Out</h1>
            <p class="mt-1 text-sm text-gray-500">Record outgoing inventory</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('stock.index') }}"
               class="text-sm font-medium text-primary-600 hover:text-primary-500">
                ← Back to Transactions
            </a>
        </div>
    </div>

    <div class="rounded-lg bg-white shadow">
        <form action="{{ route('stock.out.process') }}"
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
                            {{ $product->name }} ({{ $product->sku }}) - Available: {{ $product->quantity }}
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
                    <label for="transaction_date"
                           class="block text-sm font-medium text-gray-700">Transaction Date</label>
                    <input type="datetime-local"
                           name="transaction_date"
                           id="transaction_date"
                           value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @error('transaction_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="reason"
                           class="block text-sm font-medium text-gray-700">Reason</label>
                    <input type="text"
                           name="reason"
                           id="reason"
                           value="{{ old('reason') }}"
                           placeholder="e.g., Sale, Transfer, Damaged"
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
                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                    Record Stock Out
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
