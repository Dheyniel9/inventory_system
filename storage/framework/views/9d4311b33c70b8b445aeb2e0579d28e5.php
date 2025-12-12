

<?php $__env->startSection('title', 'Point of Sale'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* POS Terminal Layout */
    .pos-container {
        height: calc(100vh - 10rem);
        display: flex;
        gap: 1.5rem;
    }

    .pos-products {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .pos-cart {
        width: 24rem;
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Search & Categories */
    .pos-search-section {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .pos-search-wrapper {
        display: flex;
        gap: 1rem;
    }

    .pos-search-input-container {
        flex: 1;
        position: relative;
    }

    .pos-search-input {
        width: 100%;
        padding: 0.5rem 0.5rem 0.5rem 2.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .pos-search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .pos-search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1.25rem;
        height: 1.25rem;
        color: #9ca3af;
    }

    .pos-category-select {
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .pos-category-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Products Grid */
    .pos-products-container {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    .pos-products-grid {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(2, 1fr);
    }

    @media (min-width: 640px) {
        .pos-products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .pos-products-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 1280px) {
        .pos-products-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .pos-product-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .pos-product-button:hover {
        border-color: #3b82f6;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .pos-product-image {
        width: 4rem;
        height: 4rem;
        margin-bottom: 0.5rem;
        border-radius: 0.5rem;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .pos-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pos-product-image svg {
        width: 2rem;
        height: 2rem;
        color: #d1d5db;
    }

    .pos-product-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
        line-height: 1.2;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pos-product-sku {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .pos-product-price {
        font-size: 0.875rem;
        font-weight: 700;
        color: #059669;
        margin-top: 0.25rem;
    }

    .pos-product-stock {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .pos-product-stock.low {
        color: #ca8a04;
    }

    /* Cart Header */
    .pos-cart-header {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        background-color: #3b82f6;
        color: white;
    }

    .pos-cart-header h2 {
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0;
    }

    .pos-cart-header p {
        font-size: 0.875rem;
        color: #dbeafe;
        margin: 0;
    }

    /* Cart Items */
    .pos-cart-items {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .pos-cart-empty {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #6b7280;
    }

    .pos-cart-empty-icon {
        width: 3rem;
        height: 3rem;
        color: #d1d5db;
        margin-bottom: 0.5rem;
    }

    .pos-cart-item {
        display: flex;
        gap: 0.75rem;
        padding: 0.75rem;
        background-color: #f9fafb;
        border-radius: 0.5rem;
        align-items: flex-start;
    }

    .pos-cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .pos-cart-item-name {
        font-weight: 500;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
    }

    .pos-cart-item-price {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    .pos-cart-item-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pos-qty-button {
        width: 1.75rem;
        height: 1.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        background-color: #e5e7eb;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
        color: #4b5563;
    }

    .pos-qty-button:hover {
        background-color: #d1d5db;
    }

    .pos-qty-input {
        width: 3rem;
        text-align: center;
        font-size: 0.875rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.25rem;
    }

    .pos-qty-input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .pos-cart-item-total {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.25rem;
    }

    .pos-cart-item-amount {
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .pos-remove-btn {
        font-size: 0.75rem;
        color: #dc2626;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .pos-remove-btn:hover {
        color: #991b1b;
    }

    /* Cart Summary */
    .pos-cart-summary {
        border-top: 1px solid #e5e7eb;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        background-color: #f9fafb;
    }

    .pos-discount-section {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pos-discount-select {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
    }

    .pos-discount-input {
        flex: 1;
        font-size: 0.875rem;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
    }

    .pos-discount-input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .pos-tax-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.875rem;
    }

    .pos-tax-label {
        color: #4b5563;
    }

    .pos-tax-input {
        width: 5rem;
        text-align: right;
        font-size: 0.875rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.25rem 0.5rem;
    }

    .pos-tax-input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .pos-totals {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        padding-top: 0.75rem;
        border-top: 1px solid #d1d5db;
    }

    .pos-total-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
    }

    .pos-total-label {
        color: #4b5563;
    }

    .pos-total-value {
        color: #111827;
    }

    .pos-total-row.discount .pos-total-value {
        color: #dc2626;
    }

    .pos-grand-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.125rem;
        font-weight: 700;
        padding-top: 0.5rem;
        border-top: 1px solid #d1d5db;
        margin-top: 0.5rem;
    }

    .pos-grand-total-value {
        color: #3b82f6;
    }

    /* Payment Section */
    .pos-payment-section {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        padding-top: 0.75rem;
    }

    .pos-payment-select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
    }

    .pos-payment-select:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .pos-payment-input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
    }

    .pos-payment-input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .pos-change-display {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .pos-change-amount {
        font-weight: 600;
        color: #16a34a;
    }

    /* Customer Info */
    .pos-customer-section {
        border-bottom: 1px solid #d1d5db;
        padding-bottom: 0.75rem;
    }

    .pos-customer-toggle {
        font-size: 0.875rem;
        color: #3b82f6;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .pos-customer-toggle:hover {
        color: #2563eb;
    }

    .pos-customer-inputs {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .pos-customer-input {
        width: 100%;
        font-size: 0.875rem;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
    }

    .pos-customer-input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    /* Action Buttons */
    .pos-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
    }

    .pos-btn-clear {
        flex: 1;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        background: white;
        color: #4b5563;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .pos-btn-clear:hover {
        background-color: #f3f4f6;
    }

    .pos-btn-checkout {
        flex: 1;
        padding: 0.5rem 1rem;
        border: none;
        background-color: #16a34a;
        color: white;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .pos-btn-checkout:hover {
        background-color: #15803d;
    }

    .pos-btn-checkout:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Success Modal */
    .pos-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 50;
        overflow-y: auto;
    }

    .pos-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pos-modal-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(107, 114, 128, 0.75);
        transition: background-color 0.2s;
    }

    .pos-modal-content {
        position: relative;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
        max-width: 28rem;
        width: 100%;
        padding: 1.5rem;
        text-align: center;
    }

    .pos-modal-icon {
        width: 4rem;
        height: 4rem;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        background-color: #dcfce7;
    }

    .pos-modal-icon svg {
        width: 2.5rem;
        height: 2.5rem;
        color: #16a34a;
    }

    .pos-modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
    }

    .pos-modal-invoice {
        color: #4b5563;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .pos-modal-invoice-number {
        font-family: monospace;
        font-weight: 600;
    }

    .pos-modal-amount {
        font-size: 1.875rem;
        font-weight: 700;
        color: #3b82f6;
        margin-bottom: 0.25rem;
    }

    .pos-modal-change {
        color: #4b5563;
        font-size: 0.875rem;
    }

    .pos-modal-change-amount {
        font-weight: 600;
        color: #16a34a;
    }

    .pos-modal-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .pos-modal-btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        cursor: pointer;
        border: none;
        transition: background-color 0.2s;
    }

    .pos-modal-btn-secondary {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .pos-modal-btn-secondary:hover {
        background-color: #e5e7eb;
    }

    .pos-modal-btn-primary {
        background-color: #3b82f6;
        color: white;
    }

    .pos-modal-btn-primary:hover {
        background-color: #2563eb;
    }

    @media (max-width: 768px) {
        .pos-container {
            flex-direction: column;
            height: auto;
        }

        .pos-cart {
            width: 100%;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div x-data="posTerminal()"
     class="pos-container">
    <div class="pos-products">
        <!-- Search and Categories -->
        <div class="pos-search-section">
            <div class="pos-search-wrapper">
                <div class="pos-search-input-container">
                    <input type="text"
                           x-model="searchQuery"
                           @input.debounce.300ms="filterProducts()"
                           placeholder="Search products or scan barcode..."
                           @keydown.enter.prevent="handleBarcodeSearch()"
                           class="pos-search-input">
                    <svg class="pos-search-icon"
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
                        class="pos-category-select">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="pos-products-container">
            <div class="pos-products-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button"
                        @click="addToCart(<?php echo e(json_encode([
                        'id' => $product->id,
                        'name' => $product->name,
                        'sku' => $product->sku,
                        'price' => $product->selling_price,
                        'quantity' => $product->quantity,
                        'image' => $product->image_url,
                        'category_id' => $product->category_id,
                    ])); ?>)"
                        x-show="shouldShowProduct(<?php echo e($product->category_id ?? 'null'); ?>, '<?php echo e(strtolower($product->name)); ?>', '<?php echo e(strtolower($product->sku)); ?>')"
                        class="pos-product-button">
                    <div class="pos-product-image">
                        <?php if($product->image_url): ?>
                        <img src="<?php echo e($product->image_url); ?>"
                             alt="">
                        <?php else: ?>
                        <svg fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <?php endif; ?>
                    </div>
                    <span class="pos-product-name"><?php echo e($product->name); ?></span>
                    <span class="pos-product-sku"><?php echo e($product->sku); ?></span>
                    <span class="pos-product-price">$<?php echo e(number_format($product->selling_price, 2)); ?></span>
                    <span class="pos-product-stock <?php echo e($product->quantity <= $product->min_stock_level ? 'low' : ''); ?>">
                        Stock: <?php echo e($product->quantity); ?>

                    </span>
                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Cart Section -->
    <div class="pos-cart">
        <!-- Cart Header -->
        <div class="pos-cart-header">
            <h2>Current Sale</h2>
            <p x-text="cart.length + ' item(s)'"></p>
        </div>

        <!-- Cart Items -->
        <div class="pos-cart-items">
            <template x-for="(item, index) in cart"
                      :key="item.id">
                <div class="pos-cart-item">
                    <div class="pos-cart-item-info">
                        <p class="pos-cart-item-name"
                           x-text="item.name"></p>
                        <p class="pos-cart-item-price"
                           x-text="'$' + item.price.toFixed(2) + ' × ' + item.qty"></p>
                    </div>
                    <div class="pos-cart-item-controls">
                        <button @click="decrementQty(index)"
                                class="pos-qty-button">
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
                               class="pos-qty-input">
                        <button @click="incrementQty(index)"
                                class="pos-qty-button">
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
                    <div class="pos-cart-item-total">
                        <p class="pos-cart-item-amount"
                           x-text="'$' + (item.price * item.qty).toFixed(2)"></p>
                        <button @click="removeFromCart(index)"
                                class="pos-remove-btn">Remove</button>
                    </div>
                </div>
            </template>

            <div x-show="cart.length === 0"
                 class="pos-cart-empty">
                <svg class="pos-cart-empty-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p>Cart is empty</p>
                <p style="font-size: 0.875rem;">Add products to start a sale</p>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="pos-cart-summary">
            <!-- Discount -->
            <div class="pos-discount-section">
                <select x-model="discountType"
                        class="pos-discount-select">
                    <option value="">No Discount</option>
                    <option value="percentage">%</option>
                    <option value="fixed">$</option>
                </select>
                <input type="number"
                       x-model.number="discountValue"
                       x-show="discountType"
                       min="0"
                       step="0.01"
                       placeholder="0"
                       class="pos-discount-input">
            </div>

            <!-- Tax -->
            <div class="pos-tax-row">
                <span class="pos-tax-label">Tax Rate (%)</span>
                <input type="number"
                       x-model.number="taxRate"
                       min="0"
                       max="100"
                       step="0.01"
                       class="pos-tax-input">
            </div>

            <!-- Totals -->
            <div class="pos-totals">
                <div class="pos-total-row">
                    <span class="pos-total-label">Subtotal</span>
                    <span class="pos-total-value"
                          x-text="'$' + subtotal.toFixed(2)"></span>
                </div>
                <div class="pos-total-row discount"
                     x-show="discountAmount > 0">
                    <span class="pos-total-label">Discount</span>
                    <span class="pos-total-value"
                          x-text="'-$' + discountAmount.toFixed(2)"></span>
                </div>
                <div class="pos-total-row"
                     x-show="taxAmount > 0">
                    <span class="pos-total-label">Tax (<span x-text="taxRate"></span>%)</span>
                    <span class="pos-total-value"
                          x-text="'$' + taxAmount.toFixed(2)"></span>
                </div>
                <div class="pos-grand-total">
                    <span>Total</span>
                    <span class="pos-grand-total-value"
                          x-text="'$' + total.toFixed(2)"></span>
                </div>
            </div>

            <!-- Payment -->
            <div class="pos-payment-section">
                <select x-model="paymentMethod"
                        class="pos-payment-select">
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="transfer">Bank Transfer</option>
                </select>

                <div x-show="paymentMethod === 'cash'">
                    <label style="font-size: 0.875rem; color: #4b5563;">Amount Received</label>
                    <input type="number"
                           x-model.number="amountPaid"
                           min="0"
                           step="0.01"
                           class="pos-payment-input">
                    <p class="pos-change-display"
                       x-show="change >= 0">
                        Change: <span class="pos-change-amount"
                              x-text="'$' + change.toFixed(2)"></span>
                    </p>
                </div>

                <!-- Customer Info (optional) -->
                <div x-data="{ showCustomer: false }">
                    <button @click="showCustomer = !showCustomer"
                            type="button"
                            class="pos-customer-toggle">
                        <span x-text="showCustomer ? '− Hide' : '+ Add'"></span> Customer Info
                    </button>
                    <div x-show="showCustomer"
                         class="pos-customer-inputs">
                        <input type="text"
                               x-model="customerName"
                               placeholder="Customer Name"
                               class="pos-customer-input">
                        <input type="text"
                               x-model="customerPhone"
                               placeholder="Phone"
                               class="pos-customer-input">
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pos-actions">
                <button @click="clearCart()"
                        type="button"
                        class="pos-btn-clear">
                    Clear
                </button>
                <button @click="checkout()"
                        type="button"
                        :disabled="cart.length === 0 || processing"
                        class="pos-btn-checkout">
                    <span x-show="!processing">Complete Sale</span>
                    <span x-show="processing">Processing...</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="pos-modal"
         :class="{ 'show': showSuccessModal }">
        <div style="position: fixed; inset: 0;"
             class="pos-modal-overlay"
             @click="closeSuccessModal()"></div>
        <div class="pos-modal-content">
            <div class="pos-modal-icon">
                <svg fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="pos-modal-title">Sale Completed!</h3>
            <p class="pos-modal-invoice">Invoice: <span class="pos-modal-invoice-number"
                      x-text="lastSale?.invoice_number"></span></p>
            <p class="pos-modal-amount"
               x-text="'$' + (lastSale?.total || 0).toFixed(2)"></p>
            <p class="pos-modal-change"
               x-show="lastSale?.change_amount > 0">Change: <span class="pos-modal-change-amount"
                      x-text="'$' + (lastSale?.change_amount || 0).toFixed(2)"></span></p>
            <div class="pos-modal-actions">
                <a :href="'/pos/sales/' + lastSale?.id + '/receipt'"
                   target="_blank"
                   class="pos-modal-btn pos-modal-btn-secondary">
                    Print Receipt
                </a>
                <button @click="closeSuccessModal()"
                        class="pos-modal-btn pos-modal-btn-primary">
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
            return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        },

        get discountAmount() {
            if (!this.discountType || !this.discountValue) return 0;
            if (this.discountType === 'percentage') {
                return this.subtotal * (this.discountValue / 100);
            }
            return Math.min(this.discountValue, this.subtotal);
        },

        get taxableAmount() {
            return this.subtotal - this.discountAmount;
        },

        get taxAmount() {
            return this.taxableAmount * (this.taxRate / 100);
        },

        get total() {
            return this.taxableAmount + this.taxAmount;
        },

        get change() {
            return this.amountPaid - this.total;
        },

        shouldShowProduct(categoryId, name, sku) {
            if (this.selectedCategory && categoryId != this.selectedCategory) return false;
            if (this.searchQuery) {
                const search = this.searchQuery.toLowerCase();
                return name.includes(search) || sku.includes(search);
            }
            return true;
        },

        filterProducts() {
            // Handled by x-show
        },

        handleBarcodeSearch() {
            if (!this.searchQuery) return;
            fetch(`<?php echo e(route('pos.search-product')); ?>?barcode=${encodeURIComponent(this.searchQuery)}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                },
            })
            .then(r => r.json())
            .then(data => {
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
            });
        },

        addToCart(product) {
            const existing = this.cart.find(item => item.id === product.id);
            if (existing) {
                if (existing.qty < product.quantity) {
                    existing.qty++;
                }
            } else {
                this.cart.push({
                    id: product.id,
                    name: product.name,
                    sku: product.sku,
                    price: parseFloat(product.price),
                    qty: 1,
                    maxQty: product.quantity,
                });
            }
            this.updateAmountPaid();
        },

        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.updateAmountPaid();
        },

        incrementQty(index) {
            if (this.cart[index].qty < this.cart[index].maxQty) {
                this.cart[index].qty++;
                this.updateAmountPaid();
            }
        },

        decrementQty(index) {
            if (this.cart[index].qty > 1) {
                this.cart[index].qty--;
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
            if (this.cart.length && confirm('Clear all items from cart?')) {
                this.cart = [];
                this.discountType = '';
                this.discountValue = 0;
                this.customerName = '';
                this.customerPhone = '';
            }
        },

        async checkout() {
            if (this.cart.length === 0) return;
            if (this.paymentMethod === 'cash' && this.amountPaid < this.total) {
                alert('Amount paid is less than total');
                return;
            }

            this.processing = true;

            try {
                const response = await fetch('<?php echo e(route('pos.checkout')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    },
                    body: JSON.stringify({
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
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    this.lastSale = data.sale;
                    this.showSuccessModal = true;
                } else {
                    alert(data.message || 'Error processing sale');
                }
            } catch (error) {
                alert('Error processing sale');
            } finally {
                this.processing = false;
            }
        },

        closeSuccessModal() {
            this.showSuccessModal = false;
            this.cart = [];
            this.discountType = '';
            this.discountValue = 0;
            this.amountPaid = 0;
            this.customerName = '';
            this.customerPhone = '';
        }
    };
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/pos/index.blade.php ENDPATH**/ ?>