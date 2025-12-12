@extends('layouts.app')

@section('title', 'Sales History')

@section('css')
<style>
    .sales-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .sales-title-section h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.5rem 0;
    }

    .sales-title-section p {
        color: #6b7280;
        margin: 0;
        font-size: 0.875rem;
    }

    .sales-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.75rem;
        background-color: #3b82f6;
        color: white;
        border-radius: 0.375rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .sales-action-btn:hover {
        background-color: #2563eb;
    }

    .sales-filters {
        background: white;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .sales-filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .sales-filter-group {
        display: flex;
        flex-direction: column;
    }

    .sales-filter-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .sales-filter-input,
    .sales-filter-select {
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .sales-filter-input:focus,
    .sales-filter-select:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .sales-filter-buttons {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .sales-filter-btn {
        padding: 0.5rem 0.75rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .sales-filter-btn.primary {
        background-color: #3b82f6;
        color: white;
    }

    .sales-filter-btn.primary:hover {
        background-color: #2563eb;
    }

    .sales-filter-btn.secondary {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .sales-filter-btn.secondary:hover {
        background-color: #e5e7eb;
    }

    .sales-table-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .sales-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .sales-table thead {
        background-color: #f9fafb;
    }

    .sales-table thead tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .sales-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #111827;
    }

    .sales-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: background-color 0.2s;
    }

    .sales-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .sales-table tbody tr.cancelled {
        background-color: #fef2f2;
    }

    .sales-table td {
        padding: 1rem;
        color: #4b5563;
    }

    .sales-table td.highlight {
        font-weight: 600;
        color: #111827;
    }

    .sales-table td.secondary {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .sales-status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .sales-status-badge.paid {
        background-color: #dcfce7;
        color: #166534;
    }

    .sales-status-badge.pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .sales-status-badge.cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .sales-table-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .sales-table-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .sales-table-link:hover {
        color: #1d4ed8;
    }

    .sales-table-link.danger {
        color: #dc2626;
    }

    .sales-table-link.danger:hover {
        color: #b91c1c;
    }

    .sales-table-form {
        display: inline;
    }

    .sales-table-submit-btn {
        background: none;
        border: none;
        padding: 0;
        color: #dc2626;
        cursor: pointer;
        font-size: 0.875rem;
    }

    .sales-table-submit-btn:hover {
        color: #b91c1c;
    }

    .sales-pagination {
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .sales-filter-form {
            grid-template-columns: 1fr;
        }

        .sales-table {
            font-size: 0.75rem;
        }

        .sales-table th,
        .sales-table td {
            padding: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<div style="display: flex; flex-direction: column; gap: 1.5rem;">
    <div class="sales-header">
        <div class="sales-title-section">
            <h1>Sales History</h1>
            <p>View all sales transactions</p>
        </div>
        <div>
            <a href="{{ route('pos.index') }}"
               class="sales-action-btn">
                <svg fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     style="width: 1.25rem; height: 1.25rem; margin-right: 0.375rem;">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
                New Sale
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="sales-filters">
        <form method="GET"
              class="sales-filter-form">
            <div class="sales-filter-group">
                <label for="search"
                       class="sales-filter-label">Search</label>
                <input type="text"
                       name="search"
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Invoice, Customer..."
                       class="sales-filter-input">
            </div>
            <div class="sales-filter-group">
                <label for="payment_status"
                       class="sales-filter-label">Status</label>
                <select name="payment_status"
                        id="payment_status"
                        class="sales-filter-select">
                    <option value="">All Status</option>
                    <option value="paid"
                            {{
                            request('payment_status')==='paid'
                            ? 'selected'
                            : ''
                            }}>Paid</option>
                    <option value="pending"
                            {{
                            request('payment_status')==='pending'
                            ? 'selected'
                            : ''
                            }}>Pending</option>
                    <option value="cancelled"
                            {{
                            request('payment_status')==='cancelled'
                            ? 'selected'
                            : ''
                            }}>Cancelled</option>
                </select>
            </div>
            <div class="sales-filter-group">
                <label for="start_date"
                       class="sales-filter-label">From Date</label>
                <input type="date"
                       name="start_date"
                       id="start_date"
                       value="{{ request('start_date') }}"
                       class="sales-filter-input">
            </div>
            <div class="sales-filter-group">
                <label for="end_date"
                       class="sales-filter-label">To Date</label>
                <input type="date"
                       name="end_date"
                       id="end_date"
                       value="{{ request('end_date') }}"
                       class="sales-filter-input">
            </div>
            <div class="sales-filter-buttons">
                <button type="submit"
                        class="sales-filter-btn primary">
                    Filter
                </button>
                <a href="{{ route('pos.sales') }}"
                   class="sales-filter-btn secondary">
                    Reset
                </a>
            </div>
        </form>
    </div> <!-- Sales Table -->
    <div class="sales-table-container">
        <div style="overflow-x: auto;">
            <table class="sales-table">
                <thead>
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Items</th>
                        <th scope="col">Total</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col"><span style="visibility: hidden;">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr class="{{ $sale->is_cancelled ? 'cancelled' : '' }}">
                        <td class="highlight">
                            {{ $sale->invoice_number }}
                        </td>
                        <td>
                            {{ $sale->customer_name ?? '-' }}
                            @if($sale->customer_phone)
                            <br><span class="secondary">{{ $sale->customer_phone }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $sale->items->sum('quantity') }} items
                        </td>
                        <td class="highlight">
                            ₱{{ number_format($sale->total, 2) }}
                        </td>
                        <td>
                            {{ $sale->payment_method_label }}
                        </td>
                        <td>
                            <span class="sales-status-badge {{ $sale->payment_status }}">
                                {{ $sale->payment_status_label }}
                            </span>
                        </td>
                        <td>
                            {{ $sale->sale_date->format('M d, Y H:i') }}
                        </td>
                        <td style="text-align: right;">
                            <div class="sales-table-actions">
                                <a href="{{ route('pos.show', $sale) }}"
                                   class="sales-table-link">View</a>
                                <a href="{{ route('pos.receipt', $sale) }}"
                                   target="_blank"
                                   class="sales-table-link">Receipt</a>
                                @if(!$sale->is_cancelled)
                                @can('cancel sales')
                                <form method="POST"
                                      action="{{ route('pos.cancel', $sale) }}"
                                      onsubmit="return confirm('Cancel this sale? Stock will be restored.');"
                                      class="sales-table-form">
                                    @csrf
                                    <button type="submit"
                                            class="sales-table-submit-btn">Cancel</button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"
                            style="padding: 3rem 1.5rem; text-align: center; color: #6b7280;">
                            No sales found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sales->hasPages())
        <div class="sales-pagination">
            {{ $sales->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
