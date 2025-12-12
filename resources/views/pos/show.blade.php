@extends('layouts.app')

@section('title', 'Sale Details')

@section('css')
<style>
    .sale-details-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sale-back-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .sale-back-link:hover {
        color: #1d4ed8;
    }

    .sale-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .sale-title-section h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .sale-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .sale-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .sale-action-btn.secondary {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .sale-action-btn.secondary:hover {
        background-color: #e5e7eb;
    }

    .sale-action-btn.danger {
        background-color: #dc2626;
        color: white;
    }

    .sale-action-btn.danger:hover {
        background-color: #b91c1c;
    }

    .sale-content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .sale-grid-span2 {
        grid-column: 1 / -1;
    }

    @media (min-width: 1024px) {
        .sale-content-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .sale-grid-span2 {
            grid-column: 1 / 3;
        }
    }

    .sale-info-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .sale-info-header {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .sale-info-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .sale-info-body {
        padding: 1.5rem;
    }

    .sale-items-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .sale-items-table thead {
        border-bottom: 2px solid #111827;
    }

    .sale-items-table th {
        padding: 0.75rem;
        text-align: left;
        font-weight: 600;
        color: #111827;
    }

    .sale-items-table td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .sale-items-table td.text-right {
        text-align: right;
    }

    .sale-items-table tbody tr:last-child td {
        border-bottom: none;
    }

    .sale-item-name {
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .sale-item-sku {
        font-size: 0.75rem;
        color: #6b7280;
        margin: 0;
    }

    .sale-tfoot-row {
        border-top: 1px solid #111827;
    }

    .sale-tfoot-label {
        color: #4b5563;
    }

    .sale-tfoot-value {
        color: #111827;
    }

    .sale-tfoot-value.highlight {
        font-weight: 600;
    }

    .sale-tfoot-value.discount {
        color: #dc2626;
    }

    .sale-tfoot-value.primary {
        color: #2563eb;
        font-weight: 700;
        font-size: 1.125rem;
    }

    .sale-info-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .sale-info-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .sale-info-label {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .sale-info-value {
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
    }

    .sale-info-value.highlight {
        color: #16a34a;
        font-weight: 600;
    }

    .sale-status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .sale-status-badge.paid {
        background-color: #dcfce7;
        color: #166534;
    }

    .sale-status-badge.pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .sale-status-badge.cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .sale-notes {
        white-space: pre-line;
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.6;
    }

    /* Utility Classes */
    .text-right {
        text-align: right;
    }

    .sale-tfoot-row .text-right {
        font-weight: 600;
        color: #111827;
    }

    @media (max-width: 768px) {
        .sale-content-grid {
            grid-template-columns: 1fr;
        }

        .sale-grid-span2 {
            grid-column: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="sale-details-container">
    <div class="sale-header">
        <div class="sale-title-section">
            <a href="{{ route('pos.sales') }}"
               class="sale-back-link">← Back to Sales</a>
            <h1>Invoice {{ $sale->invoice_number }}</h1>
        </div>
        <div class="sale-actions">
            <a href="{{ route('pos.receipt', $sale) }}"
               target="_blank"
               class="sale-action-btn secondary">
                <svg fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     style="width: 1.25rem; height: 1.25rem;">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Receipt
            </a>
            @if(!$sale->is_cancelled)
            @can('cancel sales')
            <form method="POST"
                  action="{{ route('pos.cancel', $sale) }}"
                  onsubmit="return confirm('Cancel this sale? Stock will be restored.');"
                  style="display: inline;">
                @csrf
                <button type="submit"
                        class="sale-action-btn danger">
                    Cancel Sale
                </button>
            </form>
            @endcan
            @endif
        </div>
    </div>

    <div class="sale-content-grid">
        <!-- Sale Items -->
        <div class="sale-grid-span2">
            <div class="sale-info-card">
                <div class="sale-info-header">
                    <h3 class="sale-info-title">Items</h3>
                </div>
                <div class="sale-info-body">
                    <table class="sale-items-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $item)
                            <tr>
                                <td>
                                    <p class="sale-item-name">{{ $item->product_name }}</p>
                                    <p class="sale-item-sku">{{ $item->product_sku }}</p>
                                </td>
                                <td class="text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-right">{{ $item->quantity }}</td>
                                <td class="text-right sale-tfoot-value highlight">₱{{ number_format($item->total, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="sale-tfoot-row">
                                <td colspan="3"
                                    class="text-right sale-tfoot-label">Subtotal</td>
                                <td class="text-right sale-tfoot-value">₱{{ number_format($sale->subtotal, 2) }}</td>
                            </tr>
                            @if($sale->discount_amount > 0)
                            <tr>
                                <td colspan="3"
                                    class="text-right sale-tfoot-label">
                                    Discount
                                    @if($sale->discount_type === 'percentage')
                                    ({{ $sale->discount_value }}%)
                                    @endif
                                </td>
                                <td class="text-right sale-tfoot-value discount">-₱{{
                                    number_format($sale->discount_amount, 2) }}</td>
                            </tr>
                            @endif
                            @if($sale->tax_amount > 0)
                            <tr>
                                <td colspan="3"
                                    class="text-right sale-tfoot-label">Tax ({{ $sale->tax_rate }}%)</td>
                                <td class="text-right sale-tfoot-value">₱{{ number_format($sale->tax_amount, 2) }}</td>
                            </tr>
                            @endif
                            <tr class="sale-tfoot-row">
                                <td colspan="3"
                                    class="text-right">Total</td>
                                <td class="text-right sale-tfoot-value primary">₱{{ number_format($sale->total, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sale Info -->
        <div>
            <div class="sale-info-card">
                <div class="sale-info-header">
                    <h3 class="sale-info-title">Sale Information</h3>
                </div>
                <div class="sale-info-body">
                    <div class="sale-info-list">
                        <div class="sale-info-row">
                            <span class="sale-info-label">Status</span>
                            <span class="sale-status-badge {{ $sale->payment_status }}">
                                {{ $sale->payment_status_label }}
                            </span>
                        </div>
                        <div class="sale-info-row">
                            <span class="sale-info-label">Payment Method</span>
                            <span class="sale-info-value">{{ $sale->payment_method_label }}</span>
                        </div>
                        <div class="sale-info-row">
                            <span class="sale-info-label">Amount Paid</span>
                            <span class="sale-info-value">₱{{ number_format($sale->amount_paid, 2) }}</span>
                        </div>
                        @if($sale->change_amount > 0)
                        <div class="sale-info-row">
                            <span class="sale-info-label">Change</span>
                            <span class="sale-info-value highlight">₱{{ number_format($sale->change_amount, 2) }}</span>
                        </div>
                        @endif
                        <div class="sale-info-row">
                            <span class="sale-info-label">Date</span>
                            <span class="sale-info-value">{{ $sale->sale_date->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="sale-info-row">
                            <span class="sale-info-label">Cashier</span>
                            <span class="sale-info-value">{{ $sale->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($sale->customer_name || $sale->customer_phone || $sale->customer_email)
        <div>
            <div class="sale-info-card">
                <div class="sale-info-header">
                    <h3 class="sale-info-title">Customer</h3>
                </div>
                <div class="sale-info-body">
                    <div class="sale-info-list">
                        @if($sale->customer_name)
                        <div>
                            <div class="sale-info-label">Name</div>
                            <div class="sale-info-value">{{ $sale->customer_name }}</div>
                        </div>
                        @endif
                        @if($sale->customer_phone)
                        <div>
                            <div class="sale-info-label">Phone</div>
                            <div class="sale-info-value">{{ $sale->customer_phone }}</div>
                        </div>
                        @endif
                        @if($sale->customer_email)
                        <div>
                            <div class="sale-info-label">Email</div>
                            <div class="sale-info-value">{{ $sale->customer_email }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($sale->notes)
        <div>
            <div class="sale-info-card">
                <div class="sale-info-header">
                    <h3 class="sale-info-title">Notes</h3>
                </div>
                <div class="sale-info-body">
                    <p class="sale-notes">{{ $sale->notes }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
