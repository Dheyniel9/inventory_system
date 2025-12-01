@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('products.index') }}"
               class="text-sm font-medium text-primary-600 hover:text-primary-500">
                ← Back to Products
            </a>
            <h1 class="mt-2 text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
        </div>
        <div class="mt-4 flex gap-3 sm:mt-0">
            @can('manage stock')
            <a href="{{ route('stock.in') }}?product_id={{ $product->id }}"
               class="inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                Stock In
            </a>
            <a href="{{ route('stock.out') }}?product_id={{ $product->id }}"
               class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                Stock Out
            </a>
            @endcan
            @can('manage products')
            <a href="{{ route('products.edit', $product) }}"
               class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                Edit Product
            </a>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Main info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Information</h3>
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">SKU</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->sku }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Barcode</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->barcode ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->category?->name ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Supplier</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->supplier?->name ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Location</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->location ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span
                                      class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->description ?? 'No description' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Recent transactions -->
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Recent Transactions</h3>
                        <a href="{{ route('stock.history', $product) }}"
                           class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                    </div>
                    @if($product->stockTransactions && $product->stockTransactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th class="py-3 pl-0 pr-3 text-left text-sm font-semibold text-gray-900">Reference
                                    </th>
                                    <th class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Type</th>
                                    <th class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Qty</th>
                                    <th class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($product->stockTransactions as $transaction)
                                <tr>
                                    <td class="whitespace-nowrap py-3 pl-0 pr-3 text-sm font-medium text-gray-900">
                                        {{ $transaction->reference_number }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3 text-sm">
                                        <span
                                              class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                                    {{ $transaction->type === 'in' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $transaction->type === 'out' ? 'bg-red-100 text-red-800' : '' }}
                                                    {{ $transaction->type === 'adjustment' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $transaction->type === 'return' ? 'bg-blue-100 text-blue-800' : '' }}">
                                            {{ $transaction->type_label }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">
                                        {{ $transaction->quantity_change }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">
                                        {{ $transaction->created_at->format('M d, Y H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-sm text-gray-500">No transactions yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Image -->
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="p-4">
                    @if($product->image_url)
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="w-full rounded-lg object-cover">
                    @else
                    <div class="flex h-48 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-16 w-16 text-gray-300"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Stock info -->
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Stock Information</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Current Stock</dt>
                            <dd
                                class="text-sm font-medium {{ $product->quantity <= 0 ? 'text-red-600' : ($product->is_low_stock ? 'text-yellow-600' : 'text-gray-900') }}">
                                {{ number_format($product->quantity) }} {{ $product->unit }}
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Min Level</dt>
                            <dd class="text-sm text-gray-900">{{ number_format($product->min_stock_level) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Max Level</dt>
                            <dd class="text-sm text-gray-900">{{ $product->max_stock_level ?
                                number_format($product->max_stock_level) : '-' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Status</dt>
                            <dd>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $product->stock_status === 'in_stock' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $product->stock_status === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $product->stock_status === 'out_of_stock' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $product->stock_status_label }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Pricing -->
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pricing</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Cost Price</dt>
                            <dd class="text-sm text-gray-900">₱{{ number_format($product->cost_price, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Selling Price</dt>
                            <dd class="text-sm font-medium text-gray-900">₱{{ number_format($product->selling_price, 2)
                                }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Profit Margin</dt>
                            <dd class="text-sm text-green-600">{{ number_format($product->profit_margin, 1) }}%</dd>
                        </div>
                        <div class="border-t pt-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Stock Value</dt>
                            <dd class="text-sm font-bold text-gray-900">₱{{ number_format($product->stock_value, 2) }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
