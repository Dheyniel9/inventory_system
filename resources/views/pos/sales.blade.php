@extends('layouts.app')

@section('title', 'Sales History')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Sales History</h1>
            <p class="mt-1 text-sm text-gray-500">View all sales transactions</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('pos.index') }}"
               class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
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
    <div class="rounded-lg bg-white p-4 shadow">
        <form method="GET"
              class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
            <div>
                <label for="search"
                       class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text"
                       name="search"
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Invoice, Customer..."
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div>
                <label for="payment_status"
                       class="block text-sm font-medium text-gray-700">Status</label>
                <select name="payment_status"
                        id="payment_status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
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
            <div>
                <label for="start_date"
                       class="block text-sm font-medium text-gray-700">From Date</label>
                <input type="date"
                       name="start_date"
                       id="start_date"
                       value="{{ request('start_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div>
                <label for="end_date"
                       class="block text-sm font-medium text-gray-700">To Date</label>
                <input type="date"
                       name="end_date"
                       id="end_date"
                       value="{{ request('end_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit"
                        class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                    Filter
                </button>
                <a href="{{ route('pos.sales') }}"
                   class="inline-flex items-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Sales Table -->
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Invoice</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Customer</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Items</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Payment</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                        <th scope="col"
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($sales as $sale)
                    <tr class="{{ $sale->is_cancelled ? 'bg-red-50' : '' }}">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                            {{ $sale->invoice_number }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ $sale->customer_name ?? '-' }}
                            @if($sale->customer_phone)
                            <br><span class="text-xs">{{ $sale->customer_phone }}</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ $sale->items->sum('quantity') }} items
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">
                            ₱{{ number_format($sale->total, 2) }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ $sale->payment_method_label }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $sale->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $sale->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $sale->payment_status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $sale->payment_status_label }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ $sale->sale_date->format('M d, Y H:i') }}
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('pos.show', $sale) }}"
                                   class="text-primary-600 hover:text-primary-900">View</a>
                                <a href="{{ route('pos.receipt', $sale) }}"
                                   target="_blank"
                                   class="text-gray-600 hover:text-gray-900">Receipt</a>
                                @if(!$sale->is_cancelled)
                                @can('cancel sales')
                                <form method="POST"
                                      action="{{ route('pos.cancel', $sale) }}"
                                      onsubmit="return confirm('Cancel this sale? Stock will be restored.')">
                                    @csrf
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900">Cancel</button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"
                            class="px-6 py-12 text-center text-sm text-gray-500">
                            No sales found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sales->hasPages())
        <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
            {{ $sales->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
