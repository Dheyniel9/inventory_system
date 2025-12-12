@extends('layouts.app')

@section('title', 'Stock Transactions')

@section('css')
<style>
    .stock-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
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

    .stock-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .stock-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .stock-btn-in {
        background-color: #16a34a;
    }

    .stock-btn-in:hover {
        background-color: #15803d;
    }

    .stock-btn-out {
        background-color: #dc2626;
    }

    .stock-btn-out:hover {
        background-color: #b91c1c;
    }

    .stock-btn-adjustment {
        background-color: #f59e0b;
    }

    .stock-btn-adjustment:hover {
        background-color: #d97706;
    }

    .stock-filters {
        background: white;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .stock-filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .stock-filter-group {
        display: flex;
        flex-direction: column;
    }

    .stock-filter-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .stock-filter-input,
    .stock-filter-select {
        display: block;
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        font-size: 0.875rem;
        font-family: inherit;
    }

    .stock-filter-input:focus,
    .stock-filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .stock-filter-buttons {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .stock-filter-btn {
        padding: 0.5rem 0.75rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .stock-filter-btn-submit {
        background-color: #3b82f6;
        color: white;
    }

    .stock-filter-btn-submit:hover {
        background-color: #2563eb;
    }

    .stock-filter-btn-reset {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .stock-filter-btn-reset:hover {
        background-color: #e5e7eb;
    }

    .stock-table-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .stock-table-wrapper {
        overflow-x: auto;
    }

    .stock-table {
        width: 100%;
        border-collapse: collapse;
    }

    .stock-table thead {
        background-color: #f9fafb;
    }

    .stock-table thead tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .stock-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
    }

    .stock-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: background-color 0.2s;
    }

    .stock-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .stock-table td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .stock-table td.nowrap {
        white-space: nowrap;
    }

    .stock-table-link {
        color: #2563eb;
        text-decoration: none;
    }

    .stock-table-link:hover {
        color: #1d4ed8;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .stock-badge-in {
        background-color: #dcfce7;
        color: #166534;
    }

    .stock-badge-out {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .stock-badge-adjustment {
        background-color: #fef3c7;
        color: #92400e;
    }

    .stock-badge-return {
        background-color: #dbeafe;
        color: #0c4a6e;
    }

    .stock-quantity-in {
        color: #16a34a;
        font-weight: 600;
    }

    .stock-quantity-out {
        color: #dc2626;
        font-weight: 600;
    }

    .stock-table-pagination {
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }

    .stock-empty-state {
        padding: 3rem 1.5rem;
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
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

        .stock-actions {
            flex-direction: column;
            width: 100%;
        }

        .stock-actions .stock-btn {
            width: 100%;
        }

        .stock-filter-form {
            grid-template-columns: 1fr;
        }

        .stock-filter-buttons {
            flex-direction: column-reverse;
        }

        .stock-filter-btn {
            width: 100%;
        }

        .stock-table {
            font-size: 0.75rem;
        }

        .stock-table th,
        .stock-table td {
            padding: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="stock-container">
    <div class="stock-header">
        <div class="stock-title">
            <h1>Stock Transactions</h1>
            <p>View all stock movements</p>
        </div>
        @can('manage stock')
        <div class="stock-actions">
            <x-button tag="link"
                      href="{{ route('stock.in') }}"
                      variant="primary"
                      icon="<path stroke-linecap='round' stroke-linejoin='round' d='M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75' />">
                Stock In
            </x-button>
            <x-button tag="link"
                      href="{{ route('stock.out') }}"
                      variant="danger"
                      icon="<path stroke-linecap='round' stroke-linejoin='round' d='M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75' />">
                Stock Out
            </x-button>
            <x-button tag="link"
                      href="{{ route('stock.adjustment') }}"
                      variant="secondary"
                      icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z' />">
                Adjustment
            </x-button>
        </div>
        @endcan
    </div>

    <x-filter-form method="GET"
                   :fields="[
            ['name' => 'search', 'label' => 'Search', 'type' => 'text', 'placeholder' => 'Reference, Product...'],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['in' => 'Stock In', 'out' => 'Stock Out', 'adjustment' => 'Adjustment', 'return' => 'Return']],
            ['name' => 'start_date', 'label' => 'From Date', 'type' => 'date'],
            ['name' => 'end_date', 'label' => 'To Date', 'type' => 'date']
        ]"
                   resetUrl="{{ route('stock.index') }}" />

    @php
    $tableHeaders = [
    ['label' => 'Reference', 'render' => fn($t) => $t['reference']],
    ['label' => 'Product', 'render' => fn($t) => '<a
       href="' . route('products.show', ['product' => $t['product_id']]) . '"
       class="table-link">' . $t['product_name'] . '</a>'],
    ['label' => 'Type', 'render' => fn($t) => '<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ' .
            ($t['type'] === 'in' ? 'bg-green-100 text-green-800' : '') .
            ($t['type'] === 'out' ? 'bg-red-100 text-red-800' : '') .
            ($t['type'] === 'adjustment' ? 'bg-yellow-100 text-yellow-800' : '') .
            ($t['type'] === 'return' ? 'bg-blue-100 text-blue-800' : '') . '">' . $t['type_label'] . '</span>'],
    ['label' => 'Quantity', 'render' => fn($t) => '<span
          class="' . ($t['is_stock_in'] ? 'text-green-600' : 'text-red-600') . ' font-medium">' . $t['quantity'] .
        '</span>'],
    ['label' => 'Before → After', 'render' => fn($t) => $t['before_after']],
    ['label' => 'User', 'render' => fn($t) => $t['user_name']],
    ['label' => 'Date', 'render' => fn($t) => $t['date']],
    ];
    $tableRows = $transactions->map(fn($transaction) => [
    'reference' => $transaction->reference_number,
    'product_id' => $transaction->product_id,
    'product_name' => $transaction->product->name,
    'type' => $transaction->type,
    'type_label' => $transaction->type_label,
    'quantity' => $transaction->quantity_change,
    'is_stock_in' => $transaction->is_stock_in,
    'before_after' => $transaction->quantity_before . ' → ' . $transaction->quantity_after,
    'user_name' => $transaction->user->name,
    'date' => $transaction->transaction_date->format('M d, Y H:i')
    ])->toArray();
    @endphp

    <x-table :headers="$tableHeaders"
             :rows="$tableRows"
             :pagination="$transactions->hasPages() ? $transactions->links() : null"
             emptyMessage="No transactions found." />
</div>
@endsection
