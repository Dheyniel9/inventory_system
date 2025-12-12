@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-responsive">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Products</h1>
            <p class="page-description">Manage your inventory products</p>
        </div>
        @can('manage products')
        <div class="header-actions">
            <x-button tag="link"
                      href="{{ route('products.create') }}"
                      variant="primary"
                      icon="<path d='M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z' />">
                Add Product
            </x-button>
        </div>
        @endcan
    </div>

    <!-- Filters Section -->
    @php
    $filterFields = [
    [
    'name' => 'search',
    'label' => 'Search',
    'type' => 'text',
    'placeholder' => 'Name, SKU, Barcode...',
    ],
    [
    'name' => 'category_id',
    'label' => 'Category',
    'type' => 'select',
    'placeholder' => 'All Categories',
    'options' => collect($categories)->pluck('name', 'id')->toArray(),
    ],
    [
    'name' => 'supplier_id',
    'label' => 'Supplier',
    'type' => 'select',
    'placeholder' => 'All Suppliers',
    'options' => $suppliers->pluck('name', 'id')->toArray(),
    ],
    [
    'name' => 'stock_status',
    'label' => 'Stock Status',
    'type' => 'select',
    'placeholder' => 'All Status',
    'options' => [
    'in_stock' => 'In Stock',
    'low_stock' => 'Low Stock',
    'out_of_stock' => 'Out of Stock',
    ],
    ],
    ];
    @endphp

    <x-filter-form :fields="$filterFields"
                   action="{{ route('products.index') }}"
                   resetUrl="{{ route('products.index') }}" />

    <!-- Desktop Table View -->
    <div class="desktop-only">
        @php
        $tableHeaders = [
        ['label' => 'Product', 'render' => function($product) {
        return '<div class="product-info">' .
            '<div class="product-image-wrapper">' .
                ($product->image_url ? '<img class="product-image"
                     src="' . $product->image_url . '"
                     alt="' . $product->name . '">' :
                '<div class="product-image-placeholder"><svg class="placeholder-icon"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg></div>') .
                '</div>' .
            '<div class="product-details">' .
                '<div class="product-name">' . $product->name . '</div>' .
                ($product->barcode ? '<div class="product-barcode">' . $product->barcode . '</div>' : '') .
                '</div>
        </div>';
        }],
        ['label' => 'SKU', 'render' => fn($p) => '<span class="table-secondary">' . $p->sku . '</span>'],
        ['label' => 'Category', 'render' => fn($p) => '<span class="table-secondary">' . ($p->category?->name ?? '-') .
            '</span>'],
        ['label' => 'Price', 'render' => fn($p) => '<div class="price-info">
            <div class="selling-price">₱' . number_format($p->selling_price, 2) . '</div>
            <div class="cost-price">Cost: ₱' . number_format($p->cost_price, 2) . '</div>
        </div>'],
        ['label' => 'Quantity', 'render' => fn($p) => '<span
              class="quantity ' . ($p->quantity <= 0 ? 'quantity-out' : ($p->is_low_stock ? 'quantity-low' : 'quantity-normal')) . '">'
            . number_format($p->quantity) . ' ' . $p->unit . '</span>'],
        ['label' => 'Status', 'render' => fn($p) => '<x-status-badge type="' . $p->stock_status . '">' .
            $p->stock_status_label . '</x-status-badge>'],
        ['label' => 'Actions', 'render' => function($product) {
        return '<div class="action-buttons">' .
            '<x-button tag="link"
                      href="' . route('products.show', $product) . '"
                      variant="link"
                      size="sm"
                      title="View">View</x-button>' .
            auth()->user()->can('manage products') ? '<x-button tag="link"
                      href="' . route('products.edit', $product) . '"
                      variant="link"
                      size="sm"
                      title="Edit">Edit</x-button>' : '' .
            '</div>';
        }],
        ];
        @endphp

        <x-table :headers="$tableHeaders"
                 :rows="$products"
                 :pagination="$products->hasPages() ? $products->links() : null"
                 emptyMessage="No products found." />
    </div>

    <!-- Mobile Card View -->
    <div class="cards-container mobile-only">
        @forelse($products as $product)
        <div class="product-card">
            <div class="card-header">
                <div class="card-product-info">
                    <div class="card-image-wrapper">
                        @if($product->image_url)
                        <img class="card-image"
                             src="{{ $product->image_url }}"
                             alt="{{ $product->name }}">
                        @else
                        <div class="card-image-placeholder">
                            <svg class="placeholder-icon"
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
                    <div class="card-details">
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <p class="card-sku">SKU: {{ $product->sku }}</p>
                    </div>
                </div>
                <span class="badge badge-{{ $product->stock_status }}">
                    {{ $product->stock_status_label }}
                </span>
            </div>

            <div class="card-body">
                <div class="card-info-grid">
                    <div class="card-info-item">
                        <span class="card-label">Category</span>
                        <span class="card-value">{{ $product->category?->name ?? '-' }}</span>
                    </div>
                    <div class="card-info-item">
                        <span class="card-label">Quantity</span>
                        <span
                              class="card-value quantity {{ $product->quantity <= 0 ? 'quantity-out' : ($product->is_low_stock ? 'quantity-low' : 'quantity-normal') }}">
                            {{ number_format($product->quantity) }} {{ $product->unit }}
                        </span>
                    </div>
                    <div class="card-info-item">
                        <span class="card-label">Price</span>
                        <span class="card-value">₱{{ number_format($product->selling_price, 2) }}</span>
                    </div>
                    <div class="card-info-item">
                        <span class="card-label">Cost</span>
                        <span class="card-value">₱{{ number_format($product->cost_price, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('products.show', $product) }}"
                   class="card-btn card-btn-view">
                    <svg class="icon-small"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View
                </a>
                @can('manage products')
                <a href="{{ route('products.edit', $product) }}"
                   class="card-btn card-btn-edit">
                    <svg class="icon-small"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                @endcan
            </div>
        </div>
        @empty
        <div class="empty-state-card">
            <svg class="empty-state-icon"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="empty-state-text">No products found</p>
        </div>
        @endforelse

        @if($products->hasPages())
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    /* Container */
    .container-responsive {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 12px;
    }

    @media (min-width: 640px) {
        .container-responsive {
            padding: 16px;
        }
    }

    /* Page Header */
    .page-header {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 16px;
    }

    @media (min-width: 640px) {
        .page-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .header-content {
        flex: 1;
    }

    .page-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin: 0;
        line-height: 1.2;
    }

    @media (min-width: 640px) {
        .page-title {
            font-size: 24px;
        }
    }

    .page-description {
        margin: 2px 0 0 0;
        font-size: 13px;
        color: #6b7280;
        line-height: 1.3;
    }

    .header-actions {
        display: flex;
    }

    /* Filters Section */
    .filters-section {
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 14px;
        margin-bottom: 16px;
    }

    @media (min-width: 640px) {
        .filters-section {
            padding: 16px;
        }
    }

    .filters-form {
        width: 100%;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    @media (min-width: 640px) {
        .filters-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .filters-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        display: block;
        margin-bottom: 6px;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        line-height: 1.2;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        color: #111827;
        background-color: white;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        transition: all 0.2s;
        line-height: 1.4;
    }

    .filter-input:focus,
    .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 8px;
    }

    @media (min-width: 1024px) {
        .filter-actions {
            align-items: flex-end;
        }
    }

    /* Buttons */
    .btn-primary,
    .btn-filter,
    .btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 14px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        white-space: nowrap;
        line-height: 1.3;
    }

    .btn-primary {
        color: white;
        background-color: #2563eb;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-filter {
        flex: 1;
        color: white;
        background-color: #2563eb;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-filter:hover {
        background-color: #1d4ed8;
    }

    .btn-reset {
        flex: 1;
        color: #374151;
        background-color: #f3f4f6;
    }

    .btn-reset:hover {
        background-color: #e5e7eb;
    }

    @media (min-width: 1024px) {

        .btn-filter,
        .btn-reset {
            flex: 0;
        }
    }

    /* Responsive Display - FIXED */
    .desktop-only {
        display: none !important;
    }

    .mobile-only {
        display: block !important;
    }

    @media (min-width: 768px) {
        .desktop-only {
            display: block !important;
        }

        .mobile-only {
            display: none !important;
        }
    }

    /* Desktop Table */
    .table-container {
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-header {
        background-color: #f9fafb;
    }

    .table-header-cell {
        padding: 12px 12px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        line-height: 1.2;
    }

    .table-header-cell:first-child {
        padding-left: 20px;
    }

    .table-header-cell:last-child {
        padding-right: 20px;
    }

    .table-header-actions {
        text-align: right;
    }

    .table-body {
        background-color: white;
    }

    .table-row {
        border-top: 1px solid #e5e7eb;
    }

    .table-cell {
        padding: 12px 12px;
        font-size: 14px;
        color: #111827;
        white-space: nowrap;
        line-height: 1.4;
    }

    .table-cell:first-child {
        padding-left: 20px;
    }

    .table-cell:last-child {
        padding-right: 20px;
    }

    .table-actions {
        text-align: right;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .product-image-wrapper {
        flex-shrink: 0;
    }

    .product-image,
    .product-image-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 6px;
    }

    .product-image {
        object-fit: cover;
    }

    .product-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e5e7eb;
    }

    .placeholder-icon {
        width: 20px;
        height: 20px;
        color: #9ca3af;
    }

    .product-details {
        min-width: 0;
    }

    .product-name {
        font-weight: 500;
        color: #111827;
        line-height: 1.3;
    }

    .product-barcode {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
        line-height: 1.3;
    }

    .text-secondary {
        color: #6b7280;
    }

    .price-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .selling-price {
        color: #111827;
        font-size: 14px;
        line-height: 1.3;
    }

    .cost-price {
        font-size: 12px;
        color: #9ca3af;
        line-height: 1.3;
    }

    .quantity {
        font-weight: 500;
    }

    .quantity-normal {
        color: #111827;
    }

    .quantity-low {
        color: #d97706;
    }

    .quantity-out {
        color: #dc2626;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 6px;
    }

    .action-btn {
        display: inline-flex;
        padding: 6px;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .action-btn-view {
        color: #6b7280;
    }

    .action-btn-view:hover {
        color: #374151;
        background-color: #f3f4f6;
    }

    .action-btn-edit {
        color: #2563eb;
    }

    .action-btn-edit:hover {
        color: #1d4ed8;
        background-color: #eff6ff;
    }

    /* Mobile Cards */
    .cards-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .product-card {
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-product-info {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
        min-width: 0;
    }

    .card-image-wrapper {
        flex-shrink: 0;
    }

    .card-image,
    .card-image-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 6px;
    }

    .card-image {
        object-fit: cover;
    }

    .card-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e5e7eb;
    }

    .card-details {
        flex: 1;
        min-width: 0;
    }

    .card-title {
        font-size: 15px;
        font-weight: 600;
        color: #111827;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.3;
    }

    .card-sku {
        margin: 2px 0 0 0;
        font-size: 12px;
        color: #6b7280;
        line-height: 1.3;
    }

    .card-body {
        padding: 12px;
    }

    .card-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .card-info-item {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .card-label {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.2;
    }

    .card-value {
        font-size: 14px;
        font-weight: 500;
        color: #111827;
        line-height: 1.3;
    }

    .card-footer {
        display: flex;
        gap: 8px;
        padding: 10px 12px;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    .card-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.2s;
        line-height: 1.3;
    }

    .card-btn-view {
        color: #374151;
        background-color: white;
        border: 1px solid #d1d5db;
    }

    .card-btn-view:hover {
        background-color: #f9fafb;
    }

    .card-btn-edit {
        color: white;
        background-color: #2563eb;
    }

    .card-btn-edit:hover {
        background-color: #1d4ed8;
    }

    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        font-size: 11px;
        font-weight: 500;
        border-radius: 9999px;
        white-space: nowrap;
        line-height: 1.3;
    }

    .badge-in_stock {
        color: #065f46;
        background-color: #d1fae5;
    }

    .badge-low_stock {
        color: #92400e;
        background-color: #fef3c7;
    }

    .badge-out_of_stock {
        color: #991b1b;
        background-color: #fee2e2;
    }

    /* Empty State */
    .empty-state {
        padding: 48px 24px;
        text-align: center;
    }

    .empty-state-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .empty-state-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 48px 24px;
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .empty-state-icon {
        width: 48px;
        height: 48px;
        color: #9ca3af;
    }

    .empty-state-text {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
        line-height: 1.4;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 12px 16px;
        border-top: 1px solid #e5e7eb;
    }

    /* Icons */
    .icon-small {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
</style>
@endsection
