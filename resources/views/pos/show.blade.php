@extends('layouts.app')

@section('title', 'Sale Details')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('pos.sales') }}"
               class="text-sm font-medium text-primary-600 hover:text-primary-500">← Back to Sales</a>
            <h1 class="mt-2 text-2xl font-bold text-gray-900">Invoice {{ $sale->invoice_number }}</h1>
        </div>
        <div class="mt-4 flex gap-3 sm:mt-0">
            <a href="{{ route('pos.receipt', $sale) }}"
               target="_blank"
               class="inline-flex items-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
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
                  onsubmit="return confirm('Cancel this sale? Stock will be restored.')">
                @csrf
                <button type="submit"
                        class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500">
                    Cancel Sale
                </button>
            </form>
            @endcan
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Sale Items -->
        <div class="lg:col-span-2">
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Items</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="py-3 text-left text-sm font-semibold text-gray-900">Product</th>
                                <th class="px-3 py-3 text-right text-sm font-semibold text-gray-900">Price</th>
                                <th class="px-3 py-3 text-right text-sm font-semibold text-gray-900">Qty</th>
                                <th class="px-3 py-3 text-right text-sm font-semibold text-gray-900">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($sale->items as $item)
                            <tr>
                                <td class="py-4">
                                    <div class="font-medium text-gray-900">{{ $item->product_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->product_sku }}</div>
                                </td>
                                <td class="px-3 py-4 text-right text-sm text-gray-500">₱{{
                                    number_format($item->unit_price, 2) }}</td>
                                <td class="px-3 py-4 text-right text-sm text-gray-500">{{ $item->quantity }}</td>
                                <td class="px-3 py-4 text-right text-sm font-medium text-gray-900">₱{{
                                    number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-t-2">
                            <tr>
                                <td colspan="3"
                                    class="py-3 text-right text-sm text-gray-600">Subtotal</td>
                                <td class="px-3 py-3 text-right text-sm text-gray-900">₱{{
                                    number_format($sale->subtotal, 2) }}</td>
                            </tr>
                            @if($sale->discount_amount > 0)
                            <tr>
                                <td colspan="3"
                                    class="py-2 text-right text-sm text-gray-600">
                                    Discount
                                    @if($sale->discount_type === 'percentage')
                                    ({{ $sale->discount_value }}%)
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-right text-sm text-red-600">-₱{{
                                    number_format($sale->discount_amount, 2) }}</td>
                            </tr>
                            @endif
                            @if($sale->tax_amount > 0)
                            <tr>
                                <td colspan="3"
                                    class="py-2 text-right text-sm text-gray-600">Tax ({{ $sale->tax_rate }}%)</td>
                                <td class="px-3 py-2 text-right text-sm text-gray-900">₱{{
                                    number_format($sale->tax_amount, 2) }}</td>
                            </tr>
                            @endif
                            <tr class="border-t">
                                <td colspan="3"
                                    class="py-3 text-right text-lg font-semibold text-gray-900">Total</td>
                                <td class="px-3 py-3 text-right text-lg font-bold text-primary-600">₱{{
                                    number_format($sale->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sale Info -->
        <div class="space-y-6">
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Sale Information</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Status</dt>
                            <dd>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $sale->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $sale->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $sale->payment_status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $sale->payment_status_label }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Payment Method</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $sale->payment_method_label }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Amount Paid</dt>
                            <dd class="text-sm font-medium text-gray-900">₱{{ number_format($sale->amount_paid, 2) }}
                            </dd>
                        </div>
                        @if($sale->change_amount > 0)
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Change</dt>
                            <dd class="text-sm font-medium text-green-600">₱{{ number_format($sale->change_amount, 2) }}
                            </dd>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Date</dt>
                            <dd class="text-sm text-gray-900">{{ $sale->sale_date->format('M d, Y H:i') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Cashier</dt>
                            <dd class="text-sm text-gray-900">{{ $sale->user->name }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            @if($sale->customer_name || $sale->customer_phone || $sale->customer_email)
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Customer</h3>
                    <dl class="space-y-2">
                        @if($sale->customer_name)
                        <div>
                            <dt class="text-sm text-gray-500">Name</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $sale->customer_name }}</dd>
                        </div>
                        @endif
                        @if($sale->customer_phone)
                        <div>
                            <dt class="text-sm text-gray-500">Phone</dt>
                            <dd class="text-sm text-gray-900">{{ $sale->customer_phone }}</dd>
                        </div>
                        @endif
                        @if($sale->customer_email)
                        <div>
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $sale->customer_email }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
            @endif

            @if($sale->notes)
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Notes</h3>
                    <p class="text-sm text-gray-600 whitespace-pre-line">{{ $sale->notes }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
