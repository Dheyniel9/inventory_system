@extends('layouts.app')

@section('title', 'Sales Report')

@section('css')
<style>
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .report-title-section h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.5rem 0;
    }

    .report-title-section p {
        color: #6b7280;
        margin: 0;
        font-size: 0.875rem;
    }

    .report-action-btn {
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

    .report-action-btn:hover {
        background-color: #2563eb;
    }

    .report-filter-form {
        background: white;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .report-filter-controls {
        display: flex;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .report-filter-group {
        display: flex;
        flex-direction: column;
    }

    .report-filter-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .report-filter-select {
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .report-filter-select:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .report-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .report-card {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .report-card-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .report-card-value {
        font-size: 1.875rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .report-card-meta {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .report-card-value.revenue {
        color: #16a34a;
    }

    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .report-section {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .report-section-header {
        padding: 1.5rem 1.5rem 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .report-section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .report-section-body {
        padding: 1.5rem;
    }

    .report-stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .report-stat-item {
        background-color: #f9fafb;
        padding: 1rem;
        border-radius: 0.375rem;
    }

    .report-stat-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .report-stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: #111827;
    }

    .report-stat-value.profit {
        color: #2563eb;
    }

    .report-products-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .report-product-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem;
        background-color: #f9fafb;
        border-radius: 0.375rem;
    }

    .report-product-rank {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        background-color: #dbeafe;
        color: #2563eb;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .report-product-info {
        flex: 1;
        margin-left: 0.75rem;
    }

    .report-product-name {
        font-weight: 500;
        color: #111827;
        margin: 0;
    }

    .report-product-sku {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    .report-product-stats {
        text-align: right;
    }

    .report-product-qty {
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .report-product-revenue {
        font-size: 0.875rem;
        color: #16a34a;
        margin: 0;
    }

    .report-quick-links {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .report-quick-link {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .report-quick-link.primary {
        background-color: #3b82f6;
        color: white;
    }

    .report-quick-link.primary:hover {
        background-color: #2563eb;
    }

    .report-quick-link.secondary {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .report-quick-link.secondary:hover {
        background-color: #e5e7eb;
    }

    .report-quick-link.warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    .report-quick-link.warning:hover {
        background-color: #fcd34d;
    }

    .report-quick-link.warning:hover {
        background-color: #fcd34d;
    }

    .report-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .report-product-flex {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .report-empty-message {
        text-align: center;
        color: #6b7280;
        padding: 2rem 0;
    }

    @media (max-width: 768px) {
        .report-stats-grid {
            grid-template-columns: 1fr;
        }

        .report-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="report-container">
    <div class="report-header">
        <div class="report-title-section">
            <h1>Sales Report</h1>
            <p>Overview of sales performance</p>
        </div>
        <div>
            <a href="{{ route('pos.index') }}"
               class="report-action-btn">
                New Sale
            </a>
        </div>
    </div>

    <!-- Period Filter -->
    <div class="report-filter-form">
        <form method="GET"
              class="report-filter-controls">
            <div class="report-filter-group">
                <label for="period"
                       class="report-filter-label">Period:</label>
                <select name="period"
                        id="period"
                        onchange="this.form.submit()"
                        class="report-filter-select">
                    <option value="today"
                            {{
                            $period==='today'
                            ? 'selected'
                            : ''
                            }}>Today</option>
                    <option value="week"
                            {{
                            $period==='week'
                            ? 'selected'
                            : ''
                            }}>This Week</option>
                    <option value="month"
                            {{
                            $period==='month'
                            ? 'selected'
                            : ''
                            }}>This Month</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Today's Summary Cards -->
    <div class="report-cards">
        <div class="report-card">
            <div class="report-card-label">Today's Sales</div>
            <div class="report-card-value">{{ $todaySummary['total_sales'] }}</div>
            <div class="report-card-meta">{{ $todaySummary['total_items'] }} items sold</div>
        </div>
        <div class="report-card">
            <div class="report-card-label">Today's Revenue</div>
            <div class="report-card-value revenue">${{ number_format($todaySummary['total_revenue'], 2) }}</div>
            <div class="report-card-meta">Avg: ${{ number_format($todaySummary['average_sale'], 2) }}/sale</div>
        </div>
        <div class="report-card">
            <div class="report-card-label">Cash Payments</div>
            <div class="report-card-value">${{ number_format($todaySummary['by_payment_method']['cash'], 2) }}</div>
        </div>
        <div class="report-card">
            <div class="report-card-label">Card/Transfer</div>
            <div class="report-card-value">${{ number_format($todaySummary['by_payment_method']['card'] +
                $todaySummary['by_payment_method']['transfer'], 2) }}</div>
        </div>
    </div>

    <!-- Period Report -->
    <div class="report-grid">
        <!-- Period Stats -->
        <div class="report-section">
            <div class="report-section-header">
                <h3 class="report-section-title">
                    {{ $period === 'today' ? "Today's" : ($period === 'week' ? 'This Week\'s' : 'This Month\'s') }}
                    Summary
                </h3>
            </div>
            <div class="report-section-body">
                <div class="report-stats-grid">
                    <div class="report-stat-item">
                        <div class="report-stat-label">Total Sales</div>
                        <div class="report-stat-value">{{ $report['total_sales'] }}</div>
                    </div>
                    <div class="report-stat-item">
                        <div class="report-stat-label">Revenue</div>
                        <div class="report-stat-value revenue">${{ number_format($report['total_revenue'], 2) }}</div>
                    </div>
                    <div class="report-stat-item">
                        <div class="report-stat-label">Profit</div>
                        <div class="report-stat-value profit">${{ number_format($report['total_profit'], 2) }}</div>
                    </div>
                    <div class="report-stat-item">
                        <div class="report-stat-label">Average Sale</div>
                        <div class="report-stat-value">${{ number_format($report['average_sale'], 2) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="report-section">
            <div class="report-section-header">
                <h3 class="report-section-title">Top Selling Products</h3>
            </div>
            <div class="report-section-body">
                @if($report['top_products']->count() > 0)
                <div class="report-products-list">
                    @foreach($report['top_products'] as $index => $product)
                    <div class="report-product-row">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div class="report-product-rank">
                                {{ $index + 1 }}
                            </div>
                            <div class="report-product-info">
                                <p class="report-product-name">{{ $product->product_name }}</p>
                                <p class="report-product-sku">{{ $product->product_sku }}</p>
                            </div>
                        </div>
                        <div class="report-product-stats">
                            <p class="report-product-qty">{{ $product->total_quantity }} sold</p>
                            <p class="report-product-revenue">${{ number_format($product->total_revenue, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="text-align: center; color: #6b7280; padding: 2rem 0;">No sales data for this period</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="report-section">
        <div class="report-section-header">
            <h3 class="report-section-title">Quick Actions</h3>
        </div>
        <div class="report-section-body">
            <div class="report-quick-links">
                <a href="{{ route('pos.index') }}"
                   class="report-quick-link primary">
                    New Sale
                </a>
                <a href="{{ route('pos.sales') }}"
                   class="report-quick-link secondary">
                    View All Sales
                </a>
                <a href="{{ route('pos.sales', ['start_date' => now()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}"
                   class="report-quick-link secondary">
                    Today's Sales
                </a>
                <a href="{{ route('products.low-stock') }}"
                   class="report-quick-link warning">
                    Low Stock Items
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
