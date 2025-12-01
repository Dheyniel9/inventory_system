@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Sales Report</h1>
            <p class="mt-1 text-sm text-gray-500">Overview of sales performance</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('pos.index') }}" class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                New Sale
            </a>
        </div>
    </div>

    <!-- Period Filter -->
    <div class="rounded-lg bg-white p-4 shadow">
        <form method="GET" class="flex items-center gap-4">
            <label for="period" class="text-sm font-medium text-gray-700">Period:</label>
            <select name="period" id="period" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                <option value="today" {{ $period === 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ $period === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ $period === 'month' ? 'selected' : '' }}>This Month</option>
            </select>
        </form>
    </div>

    <!-- Today's Summary Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Today's Sales</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $todaySummary['total_sales'] }}</dd>
            <dd class="mt-1 text-sm text-gray-500">{{ $todaySummary['total_items'] }} items sold</dd>
        </div>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Today's Revenue</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-600">${{ number_format($todaySummary['total_revenue'], 2) }}</dd>
            <dd class="mt-1 text-sm text-gray-500">Avg: ${{ number_format($todaySummary['average_sale'], 2) }}/sale</dd>
        </div>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Cash Payments</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">${{ number_format($todaySummary['by_payment_method']['cash'], 2) }}</dd>
        </div>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Card/Transfer</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">${{ number_format($todaySummary['by_payment_method']['card'] + $todaySummary['by_payment_method']['transfer'], 2) }}</dd>
        </div>
    </div>

    <!-- Period Report -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Period Stats -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    {{ $period === 'today' ? "Today's" : ($period === 'week' ? 'This Week\'s' : 'This Month\'s') }} Summary
                </h3>
                <dl class="grid grid-cols-2 gap-4">
                    <div class="rounded-lg bg-gray-50 p-4">
                        <dt class="text-sm font-medium text-gray-500">Total Sales</dt>
                        <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ $report['total_sales'] }}</dd>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-4">
                        <dt class="text-sm font-medium text-gray-500">Revenue</dt>
                        <dd class="mt-1 text-2xl font-semibold text-green-600">${{ number_format($report['total_revenue'], 2) }}</dd>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-4">
                        <dt class="text-sm font-medium text-gray-500">Profit</dt>
                        <dd class="mt-1 text-2xl font-semibold text-blue-600">${{ number_format($report['total_profit'], 2) }}</dd>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-4">
                        <dt class="text-sm font-medium text-gray-500">Average Sale</dt>
                        <dd class="mt-1 text-2xl font-semibold text-gray-900">${{ number_format($report['average_sale'], 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Top Products -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Top Selling Products</h3>
                @if($report['top_products']->count() > 0)
                    <div class="space-y-3">
                        @foreach($report['top_products'] as $index => $product)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-100 text-primary-600 text-sm font-semibold">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $product->product_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->product_sku }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">{{ $product->total_quantity }} sold</p>
                                    <p class="text-sm text-green-600">${{ number_format($product->total_revenue, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No sales data for this period</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('pos.index') }}" class="inline-flex items-center rounded-md bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-500">
                    New Sale
                </a>
                <a href="{{ route('pos.sales') }}" class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">
                    View All Sales
                </a>
                <a href="{{ route('pos.sales', ['start_date' => now()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}" class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">
                    Today's Sales
                </a>
                <a href="{{ route('products.low-stock') }}" class="inline-flex items-center rounded-md bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-800 hover:bg-yellow-200">
                    Low Stock Items
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
