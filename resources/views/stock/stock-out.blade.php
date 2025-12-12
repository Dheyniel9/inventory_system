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
<div class="stock-container">
    <div class="stock-header">
        <div class="stock-title">
            <h1>Stock Out</h1>
            <p>Record outgoing inventory</p>
        </div>
        <x-button tag="link"
                  href="{{ route('stock.index') }}"
                  variant="link"
                  icon="<path stroke-linecap='round' stroke-linejoin='round' d='M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18' />">
            Back to Transactions
        </x-button>
    </div>

    <div class="stock-form-card">
        <form action="{{ route('stock.out.process') }}"
              method="POST"
              class="stock-form">
            @csrf
            <div class="stock-grid">
                <x-form-group name="product_id"
                              label="Product *"
                              type="select"
                              required
                              :options="$products->mapWithKeys(fn($p) => [$p->id => $p->name . ' (' . $p->sku . ') - Available: ' . $p->quantity])->toArray()"
                              :value="old('product_id') ?? request('product_id')"
                              class="stock-grid-full" />

                <x-form-group name="quantity"
                              label="Quantity *"
                              type="number"
                              required
                              min="1"
                              :value="old('quantity', 1)" />

                <x-form-group name="transaction_date"
                              label="Transaction Date"
                              type="date"
                              :value="old('transaction_date', now()->format('Y-m-d'))" />

                <x-form-group name="reason"
                              label="Reason"
                              type="text"
                              placeholder="e.g., Sale, Transfer, Damaged"
                              :value="old('reason')"
                              class="stock-grid-full" />

                <x-form-group name="notes"
                              label="Notes"
                              type="textarea"
                              rows="3"
                              :value="old('notes')"
                              class="stock-grid-full" />
            </div>

            <div class="stock-form-actions">
                <x-button tag="link"
                          href="{{ route('stock.index') }}"
                          variant="secondary">
                    Cancel
                </x-button>
                <x-button type="submit"
                          variant="danger">
                    Record Stock Out
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection
