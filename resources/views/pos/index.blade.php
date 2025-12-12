@extends('layouts.app')

@section('title', 'Point of Sale')

@section('css')
<style>
    /* Base Layout */
    .pos-layout {
        display: flex;
        flex-direction: column;
        min-height: calc(100vh - 10rem);
        gap: 1rem;
    }

    @media (min-width: 1024px) {
        .pos-layout {
            flex-direction: row;
            gap: 1.5rem;
        }
    }

    /* Products Panel */
    .products-panel {
        display: flex;
        flex-direction: column;
        flex: 1;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        min-height: 0;
    }

    /* Cart Panel */
    .cart-panel {
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        min-height: 0;
    }

    @media (min-width: 1024px) {
        .cart-panel {
            width: 24rem;
            max-height: calc(100vh - 10rem);
        }
    }

    /* Search Section */
    .search-section {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        flex-shrink: 0;
    }

    .search-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    @media (min-width: 640px) {
        .search-container {
            flex-direction: row;
            gap: 1rem;
        }
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
    }

    .search-input {
        width: 100%;
        padding: 0.625rem 0.75rem 0.625rem 2.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1.25rem;
        height: 1.25rem;
        color: #9ca3af;
        pointer-events: none;
    }

    .category-select {
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        min-width: 10rem;
        background: white;
        transition: all 0.2s;
    }

    .category-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Products Grid Container */
    .products-container {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        min-height: 0;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
    }

    @media (min-width: 640px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        }
    }

    @media (min-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }
    }

    /* Product Card */
    .product-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .product-card:hover {
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    .product-card:active {
        transform: translateY(0);
    }

    .product-image-container {
        width: 5rem;
        height: 5rem;
        margin-bottom: 0.75rem;
        border-radius: 0.5rem;
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-image-placeholder {
        width: 2.5rem;
        height: 2.5rem;
        color: #d1d5db;
    }

    .product-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        line-height: 1.3;
        margin-bottom: 0.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }

    .product-sku {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .product-price {
        font-size: 1rem;
        font-weight: 700;
        color: #059669;
        margin-bottom: 0.25rem;
    }

    .product-stock {
        font-size: 0.75rem;
        color: #6b7280;
        padding: 0.125rem 0.5rem;
        background: #f3f4f6;
        border-radius: 0.25rem;
    }

    .product-stock.low-stock {
        color: #d97706;
        background: #fef3c7;
    }

    /* Cart Header */
    .cart-header {
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        flex-shrink: 0;
    }

    .cart-title {
        font-size: 1.125rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
    }

    .cart-item-count {
        font-size: 0.875rem;
        color: #dbeafe;
        margin: 0;
    }

    /* Cart Items Container */
    .cart-items-container {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        min-height: 200px;
        max-height: 400px;
    }

    @media (min-width: 1024px) {
        .cart-items-container {
            max-height: none;
        }
    }

    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    /* Empty Cart State */
    .empty-cart-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 200px;
        text-align: center;
        color: #9ca3af;
    }

    .empty-cart-icon {
        width: 4rem;
        height: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-cart-title {
        font-size: 1rem;
        font-weight: 500;
        color: #6b7280;
        margin: 0 0 0.25rem 0;
    }

    .empty-cart-subtitle {
        font-size: 0.875rem;
        color: #9ca3af;
        margin: 0;
    }

    /* Cart Item */
    .cart-item {
        display: flex;
        gap: 0.75rem;
        padding: 0.875rem;
        background: #f9fafb;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
    }

    .cart-item-details {
        flex: 1;
        min-width: 0;
    }

    .cart-item-name {
        font-weight: 600;
        font-size: 0.875rem;
        color: #111827;
        margin: 0 0 0.25rem 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cart-item-price {
        font-size: 0.8125rem;
        color: #6b7280;
        margin: 0;
    }

    /* Quantity Controls */
    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quantity-button {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        background: white;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quantity-button:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
    }

    .quantity-button:active {
        transform: scale(0.95);
    }

    .quantity-button svg {
        width: 1rem;
        height: 1rem;
    }

    .quantity-input {
        width: 3.5rem;
        text-align: center;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.375rem;
    }

    .quantity-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Cart Item Actions */
    .cart-item-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .cart-item-total {
        font-weight: 700;
        font-size: 0.9375rem;
        color: #111827;
    }

    .remove-item-button {
        font-size: 0.75rem;
        color: #dc2626;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        transition: color 0.2s;
    }

    .remove-item-button:hover {
        color: #991b1b;
    }

    /* Cart Summary */
    .cart-summary {
        padding: 1rem 1.25rem;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        flex-shrink: 0;
    }

    .summary-section {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    /* Discount Section */
    .discount-container {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .discount-type-select {
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background: white;
    }

    .discount-value-input {
        flex: 1;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .discount-value-input:focus,
    .discount-type-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Tax Section */
    .tax-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tax-label {
        font-size: 0.875rem;
        color: #4b5563;
        font-weight: 500;
    }

    .tax-input {
        width: 5rem;
        text-align: right;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .tax-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Totals Display */
    .totals-container {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #d1d5db;
        margin-top: 0.5rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
    }

    .total-label {
        color: #6b7280;
    }

    .total-value {
        font-weight: 500;
        color: #111827;
    }

    .discount-row .total-value {
        color: #dc2626;
    }

    .grand-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.75rem;
        margin-top: 0.5rem;
        border-top: 2px solid #d1d5db;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .grand-total-label {
        color: #111827;
    }

    .grand-total-value {
        color: #3b82f6;
    }

    /* Payment Section */
    .payment-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        padding-top: 0.75rem;
        margin-top: 0.75rem;
        border-top: 1px solid #d1d5db;
    }

    .payment-method-select {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background: white;
    }

    .payment-method-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .cash-payment-section {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .input-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #4b5563;
    }

    .amount-input {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .amount-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .change-display {
        font-size: 0.875rem;
        color: #4b5563;
        padding: 0.5rem;
        background: #f0fdf4;
        border-radius: 0.375rem;
        text-align: center;
    }

    .change-amount {
        font-weight: 700;
        color: #16a34a;
        font-size: 1rem;
    }

    /* Customer Info Section */
    .customer-section {
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #d1d5db;
    }

    .customer-toggle-button {
        font-size: 0.875rem;
        color: #3b82f6;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        font-weight: 500;
        transition: color 0.2s;
    }

    .customer-toggle-button:hover {
        color: #2563eb;
    }

    .customer-inputs {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }

    .customer-input {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .customer-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        padding-top: 0.75rem;
    }

    .button {
        flex: 1;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .button-secondary {
        background: white;
        color: #4b5563;
        border: 2px solid #d1d5db;
    }

    .button-secondary:hover {
        background: #f9fafb;
        border-color: #9ca3af;
    }

    .button-primary {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        color: white;
    }

    .button-primary:hover {
        background: linear-gradient(135deg, #15803d 0%, #166534 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
    }

    .button-primary:active {
        transform: translateY(0);
    }

    .button-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Success Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 50;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        max-width: 28rem;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
    }

    .modal-icon {
        width: 5rem;
        height: 5rem;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    }

    .modal-icon svg {
        width: 3rem;
        height: 3rem;
        color: #16a34a;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.5rem 0;
    }

    .modal-invoice {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0 0 1rem 0;
    }

    .invoice-number {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: #111827;
    }

    .modal-amount {
        font-size: 2.5rem;
        font-weight: 700;
        color: #3b82f6;
        margin: 0 0 0.5rem 0;
    }

    .modal-change {
        font-size: 0.9375rem;
        color: #6b7280;
        margin: 0 0 2rem 0;
    }

    .change-value {
        font-weight: 700;
        color: #16a34a;
    }

    .modal-actions {
        display: flex;
        gap: 0.75rem;
    }

    .modal-button {
        flex: 1;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
        border: none;
    }

    .modal-button-secondary {
        background: #f3f4f6;
        color: #4b5563;
    }

    .modal-button-secondary:hover {
        background: #e5e7eb;
    }

    .modal-button-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .modal-button-primary:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }

    /* Scrollbar Styling */
    .products-container::-webkit-scrollbar,
    .cart-items-container::-webkit-scrollbar {
        width: 0.5rem;
    }

    .products-container::-webkit-scrollbar-track,
    .cart-items-container::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 0.25rem;
    }

    .products-container::-webkit-scrollbar-thumb,
    .cart-items-container::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 0.25rem;
    }

    .products-container::-webkit-scrollbar-thumb:hover,
    .cart-items-container::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>
@endsection

@section('content')
<div class="pos-layout"
     x-data="posTerminal()">
    <!-- Products Panel -->
    <div class="products-panel">
        <!-- Search Section -->
        <div class="search-section">
            <div class="search-container">
                <div class="search-input-wrapper">
                    <input type="text"
                           x-model="searchQuery"
                           @input.debounce.300ms="filterProducts()"
                           @keydown.enter.prevent="handleBarcodeSearch()"
                           placeholder="Search products or scan barcode..."
                           class="search-input">
                    <svg class="search-icon"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <select x-model="selectedCategory"
                        @change="filterProducts()"
                        class="category-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-container">
            <div class="products-grid">
                @foreach($products as $product)
                <button type="button"
                        @click="addToCart({{ json_encode([
                        'id' => $product->id,
                        'name' => $product->name,
                        'sku' => $product->sku,
                        'price' => $product->selling_price,
                        'quantity' => $product->quantity,
                        'image' => $product->image_url,
                        'category_id' => $product->category_id,
                    ]) }})"
                        x-show="shouldShowProduct({{ $product->category_id ?? 'null' }}, '{{ strtolower($product->name) }}', '{{ strtolower($product->sku) }}')"
                        class="product-card">
                    <div class="product-image-container">
                        @if($product->image_url)
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}">
                        @else
                        <svg class="product-image-placeholder"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        @endif
                    </div>
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-sku">{{ $product->sku }}</div>
                    <div class="product-price">${{ number_format($product->selling_price, 2) }}</div>
                    <div class="product-stock {{ $product->quantity <= $product->min_stock_level ? 'low-stock' : '' }}">
                        Stock: {{ $product->quantity }}
                    </div>
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Cart Panel -->
    <div class="cart-panel">
        <!-- Cart Header -->
        <div class="cart-header">
            <h2 class="cart-title">Current Sale</h2>
            <p class="cart-item-count"
               x-text="cart.length + ' item(s)'"></p>
        </div>

        <!-- Cart Items -->
        <div class="cart-items-container">
            <div x-show="cart.length === 0"
                 class="empty-cart-state">
                <svg class="empty-cart-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="empty-cart-title">Cart is empty</p>
                <p class="empty-cart-subtitle">Add products to start a sale</p>
            </div>

            <div x-show="cart.length > 0"
                 class="cart-items-list">
                <template x-for="(item, index) in cart"
                          :key="item.id">
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <p class="cart-item-name"
                               x-text="item.name"></p>
                            <p class="cart-item-price"
                               x-text="'$' + item.price.toFixed(2) + ' × ' + item.qty"></p>
                        </div>
                        <div class="quantity-controls">
                            <button @click="decrementQty(index)"
                                    class="quantity-button"
                                    type="button">
                                <svg fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number"
                                   x-model.number="item.qty"
                                   @change="validateQty(index)"
                                   min="1"
                                   :max="item.maxQty"
                                   class="quantity-input">
                            <button @click="incrementQty(index)"
                                    class="quantity-button"
                                    type="button">
                                <svg fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        <div class="cart-item-actions">
                            <p class="cart-item-total"
                               x-text="'$' + (item.price * item.qty).toFixed(2)"></p>
                            <button @click="removeFromCart(index)"
                                    class="remove-item-button"
                                    type="button">
                                Remove
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary">
            <div class="summary-section">
                <!-- Discount -->
                <div class="discount-container">
                    <select x-model="discountType"
                            class="discount-type-select">
                        <option value="">No Discount</option>
                        <option value="percentage">%</option>
                        <option value="fixed">$</option>
                    </select>
                    <input type="number"
                           x-model.number="discountValue"
                           x-show="discountType"
                           min="0"
                           step="0.01"
                           placeholder="Discount amount"
                           class="discount-value-input">
                </div>

                <!-- Tax -->
                <div class="tax-container">
                    <span class="tax-label">Tax Rate (%)</span>
                    <input type="number"
                           x-model.number="taxRate"
                           min="0"
                           max="100"
                           step="0.01"
                           class="tax-input">
                </div>

                <!-- Totals -->
                <div class="totals-container">
                    <div class="total-row">
                        <span class="total-label">Subtotal</span>
                        <span class="total-value"
                              x-text="'$' + subtotal.toFixed(2)"></span>
                    </div>
                    <div class="total-row discount-row"
                         x-show="discountAmount > 0">
                        <span class="total-label">Discount</span>
                        <span class="total-value"
                              x-text="'-$' + discountAmount.toFixed(2)"></span>
                    </div>
                    <div class="total-row"
                         x-show="taxAmount > 0">
                        <span class="total-label">Tax (<span x-text="taxRate"></span>%)</span>
                        <span class="total-value"
                              x-text="'$' + taxAmount.toFixed(2)"></span>
                    </div>
                    <div class="grand-total-row">
                        <span class="grand-total-label">Total</span>
                        <span class="grand-total-value"
                              x-text="'$' + total.toFixed(2)"></span>
                    </div>
                </div>

                <!-- Payment -->
                <div class="payment-container">
                    <select x-model="paymentMethod"
                            class="payment-method-select">
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="transfer">Bank Transfer</option>
                    </select>

                    <div x-show="paymentMethod === 'cash'"
                         class="cash-payment-section">
                        <label class="input-label">Amount Received</label>
                        <input type="number"
                               x-model.number="amountPaid"
                               min="0"
                               step="0.01"
                               placeholder="0.00"
                               class="amount-input">
                        <div x-show="change >= 0"
                             class="change-display">
                            Change: <span class="change-amount"
                                  x-text="'$' + change.toFixed(2)"></span>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="customer-section"
                         x-data="{ showCustomer: false }">
                        <button @click="showCustomer = !showCustomer"
                                type="button"
                                class="customer-toggle-button">
                            <span x-text="showCustomer ? '− Hide' : '+ Add'"></span> Customer Info
                        </button>
                        <div x-show="showCustomer"
                             class="customer-inputs">
                            <input type="text"
                                   x-model="customerName"
                                   placeholder="Customer Name"
                                   class="customer-input">
                            <input type="text"
                                   x-model="customerPhone"
                                   placeholder="Phone Number"
                                   class="customer-input">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button @click="clearCart()"
                            type="button"
                            class="button button-secondary">
                        Clear Cart
                    </button>
                    <button @click="checkout()"
                            type="button"
                            :disabled="cart.length === 0 || processing"
                            class="button button-primary">
                        <span x-show="!processing">Complete Sale</span>
                        <span x-show="processing">Processing...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal-overlay"
         :class="{ 'active': showSuccessModal }">
        <div class="modal-content">
            <div class="modal-icon">
                <svg fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="modal-title">Sale Completed!</h3>
            <p class="modal-invoice">
                Invoice: <span class="invoice-number"
                      x-text="lastSale?.invoice_number"></span>
            </p>
            <p class="modal-amount"
               x-text="'$' + (lastSale?.total || 0).toFixed(2)"></p>
            <p class="modal-change"
               x-show="lastSale?.change_amount > 0">
                Change: <span class="change-value"
                      x-text="'$' + (lastSale?.change_amount || 0).toFixed(2)"></span>
            </p>
            <div class="modal-actions">
                <a :href="'/pos/sales/' + lastSale?.id + '/receipt'"
                   target="_blank"
                   class="modal-button modal-button-secondary">
                    Print Receipt
                </a>
                <button @click="closeSuccessModal()"
                        type="button"
                        class="modal-button modal-button-primary">
                    New Sale
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function posTerminal() {
    return {
        cart: [],
        searchQuery: '',
        selectedCategory: '',
        discountType: '',
        discountValue: 0,
        taxRate: 0,
        paymentMethod: 'cash',
        amountPaid: 0,
        customerName: '',
        customerPhone: '',
        processing: false,
        showSuccessModal: false,
        lastSale: null,

        get subtotal() {
            return this.calculateSubtotal();
        },

        get discountAmount() {
            return this.calculateDiscount();
        },

        get taxableAmount() {
            return this.subtotal - this.discountAmount;
        },

        get taxAmount() {
            return this.calculateTax();
        },

        get total() {
            return this.calculateTotal();
        },

        get change() {
            return this.calculateChange();
        },

        calculateSubtotal() {
            return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        },

        calculateDiscount() {
            if (!this.discountType || !this.discountValue) return 0;

            if (this.discountType === 'percentage') {
                return this.subtotal * (this.discountValue / 100);
            }

            return Math.min(this.discountValue, this.subtotal);
        },

        calculateTax() {
            return this.taxableAmount * (this.taxRate / 100);
        },

        calculateTotal() {
            return this.taxableAmount + this.taxAmount;
        },

        calculateChange() {
            return this.amountPaid - this.total;
        },

        shouldShowProduct(categoryId, name, sku) {
            if (this.selectedCategory && categoryId != this.selectedCategory) {
                return false;
            }

            if (this.searchQuery) {
                const search = this.searchQuery.toLowerCase();
                return name.includes(search) || sku.includes(search);
            }

            return true;
        },

        filterProducts() {
            // Handled by x-show directive
        },

        handleBarcodeSearch() {
            if (!this.searchQuery) return;

            this.searchProductByBarcode(this.searchQuery);
        },

        async searchProductByBarcode(barcode) {
            try {
                const response = await fetch(`{{ route('pos.search-product') }}?barcode=${encodeURIComponent(barcode)}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                });

                const data = await response.json();

                if (data.success && data.product) {
                    this.addToCart({
                        id: data.product.id,
                        name: data.product.name,
                        sku: data.product.sku,
                        price: parseFloat(data.product.price),
                        quantity: data.product.quantity,
                    });
                    this.searchQuery = '';
                }
            } catch (error) {
                console.error('Barcode search failed:', error);
            }
        },

        addToCart(product) {
            const existingItem = this.findCartItem(product.id);

            if (existingItem) {
                this.incrementExistingItem(existingItem, product.quantity);
            } else {
                this.addNewItemToCart(product);
            }

            this.updateAmountPaid();
        },

        findCartItem(productId) {
            return this.cart.find(item => item.id === productId);
        },

        incrementExistingItem(item, maxQuantity) {
            if (item.qty < maxQuantity) {
                item.qty++;
            }
        },

        addNewItemToCart(product) {
            this.cart.push({
                id: product.id,
                name: product.name,
                sku: product.sku,
                price: parseFloat(product.price),
                qty: 1,
                maxQty: product.quantity,
            });
        },

        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.updateAmountPaid();
        },

        incrementQty(index) {
            const item = this.cart[index];

            if (item.qty < item.maxQty) {
                item.qty++;
                this.updateAmountPaid();
            }
        },

        decrementQty(index) {
            const item = this.cart[index];

            if (item.qty > 1) {
                item.qty--;
                this.updateAmountPaid();
            }
        },

        validateQty(index) {
            const item = this.cart[index];
            item.qty = Math.max(1, Math.min(item.qty, item.maxQty));
            this.updateAmountPaid();
        },

        updateAmountPaid() {
            if (this.paymentMethod !== 'cash') {
                this.amountPaid = this.total;
            }
        },

        clearCart() {
            if (this.cart.length === 0) return;

            if (confirm('Clear all items from cart?')) {
                this.resetCart();
            }
        },

        resetCart() {
            this.cart = [];
            this.discountType = '';
            this.discountValue = 0;
            this.amountPaid = 0;
            this.customerName = '';
            this.customerPhone = '';
        },

        async checkout() {
            if (!this.canCheckout()) return;

            this.processing = true;

            try {
                const response = await this.submitSale();
                const data = await response.json();

                if (data.success) {
                    this.handleSuccessfulSale(data.sale);
                } else {
                    alert(data.message || 'Error processing sale');
                }
            } catch (error) {
                alert('Error processing sale');
                console.error('Checkout error:', error);
            } finally {
                this.processing = false;
            }
        },

        canCheckout() {
            if (this.cart.length === 0) return false;

            if (this.paymentMethod === 'cash' && this.amountPaid < this.total) {
                alert('Amount paid is less than total');
                return false;
            }

            return true;
        },

        async submitSale() {
            return await fetch('{{ route('pos.checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify(this.prepareSaleData()),
            });
        },

        prepareSaleData() {
            return {
                items: this.cart.map(item => ({
                    product_id: item.id,
                    quantity: item.qty,
                    unit_price: item.price,
                })),
                discount_type: this.discountType || null,
                discount_value: this.discountValue,
                tax_rate: this.taxRate,
                payment_method: this.paymentMethod,
                amount_paid: this.paymentMethod === 'cash' ? this.amountPaid : this.total,
                customer_name: this.customerName || null,
                customer_phone: this.customerPhone || null,
            };
        },

        handleSuccessfulSale(sale) {
            this.lastSale = sale;
            this.showSuccessModal = true;
        },

        closeSuccessModal() {
            this.showSuccessModal = false;
            this.resetCart();
        }
    };
}
</script>
@endsection
