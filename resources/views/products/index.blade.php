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
            <a href="{{ route('products.create') }}"
               class="btn-primary">
                <svg class="icon-small"
                     fill="currentColor"
                     viewBox="0 0 20 20">
                    <path
                          d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                <span>Add Product</span>
            </a>
        </div>
        @endcan
    </div>

    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET"
              class="filters-form">
            <div class="filters-grid">
                <!-- Search -->
                <div class="filter-group">
                    <label for="search"
                           class="filter-label">Search</label>
                    <input type="text"
                           name="search"
                           id="search"
                           value="{{ request('search') }}"
                           placeholder="Name, SKU, Barcode..."
                           class="filter-input">
                </div>

                <!-- Category -->
                <div class="filter-group">
                    <label for="category_id"
                           class="filter-label">Category</label>
                    <select name="category_id"
                            id="category_id"
                            class="filter-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}"
                                {{
                                request('category_id')==$category['id']
                                ? 'selected'
                                : ''
                                }}>
                            {{ $category['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div class="filter-group">
                    <label for="supplier_id"
                           class="filter-label">Supplier</label>
                    <select name="supplier_id"
                            id="supplier_id"
                            class="filter-select">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                                {{
                                request('supplier_id')==$supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stock Status -->
                <div class="filter-group">
                    <label for="stock_status"
                           class="filter-label">Stock Status</label>
                    <select name="stock_status"
                            id="stock_status"
                            class="filter-select">
                        <option value="">All Status</option>
                        <option value="in_stock"
                                {{
                                request('stock_status')==='in_stock'
                                ? 'selected'
                                : ''
                                }}>In Stock</option>
                        <option value="low_stock"
                                {{
                                request('stock_status')==='low_stock'
                                ? 'selected'
                                : ''
                                }}>Low Stock</option>
                        <option value="out_of_stock"
                                {{
                                request('stock_status')==='out_of_stock'
                                ? 'selected'
                                : ''
                                }}>Out of Stock</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="filter-actions">
                    <button type="submit"
                            class="btn-filter">
                        <svg class="icon-small"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="btn-reset">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Desktop Table View -->
    <div class="table-container desktop-only">
        <div class="table-wrapper">
            <table class="data-table">
                <thead class="table-header">
                    <tr>
                        <th class="table-header-cell">Product</th>
                        <th class="table-header-cell">SKU</th>
                        <th class="table-header-cell">Category</th>
                        <th class="table-header-cell">Price</th>
                        <th class="table-header-cell">Quantity</th>
                        <th class="table-header-cell">Status</th>
                        <th class="table-header-cell table-header-actions">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($products as $product)
                    <tr class="table-row">
                        <td class="table-cell">
                            <div class="product-info">
                                <div class="product-image-wrapper">
                                    @if($product->image_url)
                                    <img class="product-image"
                                         src="{{ $product->image_url }}"
                                         alt="{{ $product->name }}">
                                    @else
                                    <div class="product-image-placeholder">
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
                                <div class="product-details">
                                    <div class="product-name">{{ $product->name }}</div>
                                    @if($product->barcode)
                                    <div class="product-barcode">{{ $product->barcode }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="table-cell">
                            <span class="text-secondary">{{ $product->sku }}</span>
                        </td>
                        <td class="table-cell">
                            <span class="text-secondary">{{ $product->category?->name ?? '-' }}</span>
                        </td>
                        <td class="table-cell">
                            <div class="price-info">
                                <div class="selling-price">₱{{ number_format($product->selling_price, 2) }}</div>
                                <div class="cost-price">Cost: ₱{{ number_format($product->cost_price, 2) }}</div>
                            </div>
                        </td>
                        <td class="table-cell">
                            <span
                                  class="quantity {{ $product->quantity <= 0 ? 'quantity-out' : ($product->is_low_stock ? 'quantity-low' : 'quantity-normal') }}">
                                {{ number_format($product->quantity) }} {{ $product->unit }}
                            </span>
                        </td>
                        <td class="table-cell">
                            <span class="badge badge-{{ $product->stock_status }}">
                                {{ $product->stock_status_label }}
                            </span>
                        </td>
                        <td class="table-cell table-actions">
                            <div class="action-buttons">
                                <a href="{{ route('products.show', $product) }}"
                                   class="action-btn action-btn-view"
                                   title="View">
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
                                </a>
                                @can('manage products')
                                <a href="{{ route('products.edit', $product) }}"
                                   class="action-btn action-btn-edit"
                                   title="Edit">
                                    <svg class="icon-small"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7"
                            class="empty-state">
                            <div class="empty-state-content">
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
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
        @endif
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
        max-width: 90rem;
        margin: 0 auto;
        padding: 1rem;
    }

    @media (min-width: 640px) {
        .container-responsive {
            padding: 1.5rem;
        }
    }

    /* Page Header */
    .page-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
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
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    @media (min-width: 640px) {
        .page-title {
            font-size: 1.875rem;
        }
    }

    .page-description {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .header-actions {
        display: flex;
    }

    /* Filters Section */
    .filters-section {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 640px) {
        .filters-section {
            padding: 1.25rem;
        }
    }

    .filters-form {
        width: 100%;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
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
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: #111827;
        background-color: white;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }

    .filter-input:focus,
    .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 0.5rem;
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
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        white-space: nowrap;
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

    /* Responsive Display */
    .desktop-only {
        display: none;
    }

    .mobile-only {
        display: block;
    }

    @media (min-width: 768px) {
        .desktop-only {
            display: block;
        }

        .mobile-only {
            display: none;
        }
    }

    /* Desktop Table */
    .table-container {
        background-color: white;
        border-radius: 0.5rem;
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
        padding: 0.875rem 0.75rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
    }

    .table-header-cell:first-child {
        padding-left: 1.5rem;
    }

    .table-header-cell:last-child {
        padding-right: 1.5rem;
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
        padding: 1rem 0.75rem;
        font-size: 0.875rem;
        color: #111827;
        white-space: nowrap;
    }

    .table-cell:first-child {
        padding-left: 1.5rem;
    }

    .table-cell:last-child {
        padding-right: 1.5rem;
    }

    .table-actions {
        text-align: right;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .product-image-wrapper {
        flex-shrink: 0;
    }

    .product-image,
    .product-image-placeholder {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
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
        width: 1.5rem;
        height: 1.5rem;
        color: #9ca3af;
    }

    .product-details {
        min-width: 0;
    }

    .product-name {
        font-weight: 500;
        color: #111827;
    }

    .product-barcode {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .text-secondary {
        color: #6b7280;
    }

    .price-info {
        display: flex;
        flex-direction: column;
        gap: 0.125rem;
    }

    .selling-price {
        color: #111827;
    }

    .cost-price {
        font-size: 0.75rem;
        color: #9ca3af;
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
        gap: 0.5rem;
    }

    .action-btn {
        display: inline-flex;
        padding: 0.375rem;
        border-radius: 0.375rem;
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
        gap: 1rem;
    }

    .product-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-product-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        min-width: 0;
    }

    .card-image-wrapper {
        flex-shrink: 0;
    }

    .card-image,
    .card-image-placeholder {
        width: 3rem;
        height: 3rem;
        border-radius: 0.5rem;
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
        font-size: 0.9375rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .card-sku {
        margin-top: 0.125rem;
        font-size: 0.75rem;
        color: #6b7280;
    }

    .card-body {
        padding: 1rem;
    }

    .card-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .card-info-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .card-label {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .card-value {
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
    }

    .card-footer {
        display: flex;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    .card-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s;
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
        padding: 0.25rem 0.625rem;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 9999px;
        white-space: nowrap;
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
        padding: 3rem 1.5rem;
        text-align: center;
    }

    .empty-state-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
    }

    .empty-state-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 3rem 1.5rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .empty-state-icon {
        width: 3rem;
        height: 3rem;
        color: #9ca3af;
    }

    .empty-state-text {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 0.75rem 1rem;
        border-top: 1px solid #e5e7eb;
    }

    /* Icons */
    .icon-small {
        width: 1.25rem;
        height: 1.25rem;
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
