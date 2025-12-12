@extends('layouts.app')

@section('title', 'Stock In')

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

    .stock-input-prefix {
        position: relative;
        display: flex;
        align-items: center;
    }

    .stock-input-prefix-text {
        position: absolute;
        left: 0.75rem;
        color: #6b7280;
        font-size: 0.875rem;
        pointer-events: none;
    }

    .stock-input-prefix .stock-form-input {
        padding-left: 1.75rem;
        margin-top: 0;
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
        background-color: #16a34a;
        color: white;
    }

    .stock-btn-submit:hover {
        background-color: #15803d;
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
<div class="stock-container">
    <div class="stock-header">
        <div class="stock-title">
            <h1>Stock In</h1>
            <p>Record incoming inventory</p>
        </div>
        <div>
            <a href="{{ route('stock.index') }}"
               class="stock-back-link">
                ← Back to Transactions
            </a>
        </div>
    </div>

    <div class="stock-form-card">
        <form action="{{ route('stock.in.process') }}"
              method="POST"
              class="stock-form">
            @csrf
            <div class="stock-grid">
                <div class="stock-form-group stock-grid-full">
                    <label for="product_id"
                           class="stock-form-label">Product *</label>
                    <select name="product_id"
                            id="product_id"
                            required
                            class="stock-form-select">
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
                    @error('product_id') <p class="stock-form-error">{{ $message }}</p> @enderror
                </div>

                <div class="stock-form-group">
                    <label for="quantity"
                           class="stock-form-label">Quantity *</label>
                    <input type="number"
                           name="quantity"
                           id="quantity"
                           required
                           min="1"
                           value="{{ old('quantity', 1) }}"
                           class="stock-form-input">
                    @error('quantity') <p class="stock-form-error">{{ $message }}</p> @enderror
                </div>

                <div class="stock-form-group">
                    <label for="unit_cost"
                           class="stock-form-label">Unit Cost</label>
                    <div class="stock-input-prefix">
                        <span class="stock-input-prefix-text">₱</span>
                        <input type="number"
                               name="unit_cost"
                               id="unit_cost"
                               step="0.01"
                               min="0"
                               value="{{ old('unit_cost') }}"
                               placeholder="Uses product cost if empty"
                               class="stock-form-input">
                    </div>
                    @error('unit_cost') <p class="stock-form-error">{{ $message }}</p> @enderror
                </div>

                <div class="stock-form-group">
                    <label for="transaction_date"
                           class="stock-form-label">Transaction Date</label>
                    <input type="datetime-local"
                           name="transaction_date"
                           id="transaction_date"
                           value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}"
                           class="stock-form-input">
                    @error('transaction_date') <p class="stock-form-error">{{ $message }}</p> @enderror
                </div>

                <div class="stock-form-group">
                    <label for="reason"
                           class="stock-form-label">Reason</label>
                    <input type="text"
                           name="reason"
                           id="reason"
                           value="{{ old('reason') }}"
                           placeholder="e.g., Purchase order #123"
                           class="stock-form-input">
                    @error('reason') <p class="stock-form-error">{{ $message }}</p> @enderror
                </div>

                <div class="stock-form-group stock-grid-full">
                    <label for="notes"
                           class="stock-form-label">Notes</label>
                    <textarea name="notes"
                              id="notes"
                              rows="3"
                              class="stock-form-textarea">{{ old('notes') }}</textarea>
                    @error('notes') <p class="stock-form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="stock-form-actions">
                <a href="{{ route('stock.index') }}"
                   class="stock-btn stock-btn-cancel">
                    Cancel
                </a>
                <button type="submit"
                        class="stock-btn stock-btn-submit">
                    Record Stock In
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
