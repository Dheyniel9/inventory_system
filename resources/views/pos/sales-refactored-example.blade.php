{{-- Example refactored sales view using reusable components --}}
{{-- This shows how to use the new components to reduce code duplication --}}

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

  .page-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }
</style>
@endsection

@section('content')
<div class="page-container">
  {{-- Header Section --}}
  <div class="sales-header">
    <div class="sales-title-section">
      <h1>Sales History</h1>
      <p>View all sales transactions</p>
    </div>
    <x-button tag="link"
              href="{{ route('pos.index') }}"
              variant="primary"
              icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 4v16m8-8H4' />">
      New Sale
    </x-button>
  </div>

  {{-- Filter Form Using Component --}}
  @php
  $filterFields = [
  [
  'name' => 'search',
  'label' => 'Search',
  'type' => 'text',
  'placeholder' => 'Invoice, Customer...',
  ],
  [
  'name' => 'payment_status',
  'label' => 'Status',
  'type' => 'select',
  'placeholder' => 'All Status',
  'options' => [
  'paid' => 'Paid',
  'pending' => 'Pending',
  'cancelled' => 'Cancelled',
  ],
  ],
  [
  'name' => 'start_date',
  'label' => 'From Date',
  'type' => 'date',
  ],
  [
  'name' => 'end_date',
  'label' => 'To Date',
  'type' => 'date',
  ],
  ];
  @endphp

  <x-filter-form :fields="$filterFields"
                 action="{{ route('pos.sales') }}"
                 resetUrl="{{ route('pos.sales') }}" />

  {{-- Sales Table Using Component --}}
  @php
  $tableHeaders = [
  ['label' => 'Invoice', 'render' => fn($sale) => '<span class="table-highlight">' . $sale->invoice_number . '</span>'],
  ['label' => 'Customer', 'render' => fn($sale) =>
  ($sale->customer_name ?? '-') .
  ($sale->customer_phone ? '<br><span class="table-secondary">' . $sale->customer_phone . '</span>' : '')
  ],
  ['label' => 'Items', 'render' => fn($sale) => $sale->items->sum('quantity') . ' items'],
  ['label' => 'Total', 'render' => fn($sale) => '<span class="table-highlight">₱' . number_format($sale->total, 2) .
    '</span>'],
  ['label' => 'Payment', 'render' => fn($sale) => $sale->payment_method_label],
  ['label' => 'Status', 'render' => fn($sale) =>
  '<x-status-badge type="' . $sale->payment_status . '">' .
    $sale->payment_status_label .
    '</x-status-badge>'
  ],
  ['label' => 'Date', 'render' => fn($sale) => $sale->sale_date->format('M d, Y H:i')],
  ['label' => 'Actions', 'render' => function($sale) {
  return view('pos.partials.sales-actions', ['sale' => $sale]);
  }],
  ];
  @endphp

  <x-table :headers="$tableHeaders"
           :rows="$sales"
           :pagination="$sales->links()"
           emptyMessage="No sales found." />
</div>
@endsection
