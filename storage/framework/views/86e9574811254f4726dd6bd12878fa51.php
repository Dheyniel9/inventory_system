<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container-responsive">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <a href="<?php echo e(route('products.index')); ?>"
               class="back-link">
                <svg class="icon-small"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Products
            </a>
            <h1 class="page-title"><?php echo e($product->name); ?></h1>
        </div>
        <div class="header-actions">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage stock')): ?>
            <a href="<?php echo e(route('stock.in')); ?>?product_id=<?php echo e($product->id); ?>"
               class="btn-stock-in">
                <svg class="icon-small"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75" />
                </svg>
                <span class="btn-text">Stock In</span>
            </a>
            <a href="<?php echo e(route('stock.out')); ?>?product_id=<?php echo e($product->id); ?>"
               class="btn-stock-out">
                <svg class="icon-small"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" />
                </svg>
                <span class="btn-text">Stock Out</span>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage products')): ?>
            <a href="<?php echo e(route('products.edit', $product)); ?>"
               class="btn-primary">
                <svg class="icon-small"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                <span class="btn-text">Edit</span>
            </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Product Image (Mobile) -->
            <div class="image-card mobile-only">
                <?php if($product->image_url): ?>
                <img src="<?php echo e($product->image_url); ?>"
                     alt="<?php echo e($product->name); ?>"
                     class="product-image">
                <?php else: ?>
                <div class="image-placeholder">
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
                <?php endif; ?>
            </div>

            <!-- Product Information Card -->
            <div class="info-card">
                <h2 class="card-title">Product Information</h2>
                <dl class="info-grid">
                    <div class="info-item">
                        <dt class="info-label">SKU</dt>
                        <dd class="info-value"><?php echo e($product->sku); ?></dd>
                    </div>
                    <div class="info-item">
                        <dt class="info-label">Barcode</dt>
                        <dd class="info-value"><?php echo e($product->barcode ?? '-'); ?></dd>
                    </div>
                    <div class="info-item">
                        <dt class="info-label">Category</dt>
                        <dd class="info-value"><?php echo e($product->category?->name ?? '-'); ?></dd>
                    </div>
                    <div class="info-item">
                        <dt class="info-label">Supplier</dt>
                        <dd class="info-value"><?php echo e($product->supplier?->name ?? '-'); ?></dd>
                    </div>
                    <div class="info-item">
                        <dt class="info-label">Location</dt>
                        <dd class="info-value"><?php echo e($product->location ?? '-'); ?></dd>
                    </div>
                    <div class="info-item">
                        <dt class="info-label">Status</dt>
                        <dd class="info-value">
                            <span class="badge <?php echo e($product->is_active ? 'badge-active' : 'badge-inactive'); ?>">
                                <?php echo e($product->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </dd>
                    </div>
                    <div class="info-item info-item-full">
                        <dt class="info-label">Description</dt>
                        <dd class="info-value"><?php echo e($product->description ?? 'No description'); ?></dd>
                    </div>
                </dl>
            </div>

            <!-- Recent Transactions Card -->
            <div class="info-card">
                <div class="card-header">
                    <h2 class="card-title">Recent Transactions</h2>
                    <a href="<?php echo e(route('stock.history', $product)); ?>"
                       class="view-all-link">
                        View all
                    </a>
                </div>

                <?php if($product->stockTransactions && $product->stockTransactions->count() > 0): ?>
                <!-- Desktop Table View -->
                <div class="table-wrapper desktop-only">
                    <table class="transactions-table">
                        <thead>
                            <tr>
                                <th class="table-header-cell">Reference</th>
                                <th class="table-header-cell">Type</th>
                                <th class="table-header-cell">Quantity</th>
                                <th class="table-header-cell">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $product->stockTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="table-row">
                                <td class="table-cell">
                                    <span class="transaction-ref"><?php echo e($transaction->reference_number); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="badge badge-<?php echo e($transaction->type); ?>">
                                        <?php echo e($transaction->type_label); ?>

                                    </span>
                                </td>
                                <td class="table-cell">
                                    <span class="transaction-qty"><?php echo e($transaction->quantity_change); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="transaction-date"><?php echo e($transaction->created_at->format('M d, Y H:i')); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="transactions-list mobile-only">
                    <?php $__currentLoopData = $product->stockTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="transaction-card">
                        <div class="transaction-header">
                            <span class="transaction-ref"><?php echo e($transaction->reference_number); ?></span>
                            <span class="badge badge-<?php echo e($transaction->type); ?>">
                                <?php echo e($transaction->type_label); ?>

                            </span>
                        </div>
                        <div class="transaction-details">
                            <div class="transaction-detail">
                                <span class="detail-label">Quantity:</span>
                                <span class="detail-value"><?php echo e($transaction->quantity_change); ?></span>
                            </div>
                            <div class="transaction-detail">
                                <span class="detail-label">Date:</span>
                                <span class="detail-value"><?php echo e($transaction->created_at->format('M d, Y H:i')); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <p class="empty-state-text">No transactions yet</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar-content">
            <!-- Product Image (Desktop) -->
            <div class="image-card desktop-only">
                <?php if($product->image_url): ?>
                <img src="<?php echo e($product->image_url); ?>"
                     alt="<?php echo e($product->name); ?>"
                     class="product-image">
                <?php else: ?>
                <div class="image-placeholder">
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
                <?php endif; ?>
            </div>

            <!-- Stock Information Card -->
            <div class="info-card">
                <h2 class="card-title">Stock Information</h2>
                <dl class="details-list">
                    <div class="detail-row">
                        <dt class="detail-label">Current Stock</dt>
                        <dd
                            class="detail-value detail-value-stock <?php echo e($product->quantity <= 0 ? 'text-danger' : ($product->is_low_stock ? 'text-warning' : '')); ?>">
                            <?php echo e(number_format($product->quantity)); ?> <?php echo e($product->unit); ?>

                        </dd>
                    </div>
                    <div class="detail-row">
                        <dt class="detail-label">Min Level</dt>
                        <dd class="detail-value"><?php echo e(number_format($product->min_stock_level)); ?></dd>
                    </div>
                    <div class="detail-row">
                        <dt class="detail-label">Max Level</dt>
                        <dd class="detail-value"><?php echo e($product->max_stock_level ? number_format($product->max_stock_level)
                            : '-'); ?></dd>
                    </div>
                    <div class="detail-row">
                        <dt class="detail-label">Status</dt>
                        <dd class="detail-value">
                            <span class="badge badge-stock-<?php echo e($product->stock_status); ?>">
                                <?php echo e($product->stock_status_label); ?>

                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Pricing Card -->
            <div class="info-card">
                <h2 class="card-title">Pricing</h2>
                <dl class="details-list">
                    <div class="detail-row">
                        <dt class="detail-label">Cost Price</dt>
                        <dd class="detail-value">₱<?php echo e(number_format($product->cost_price, 2)); ?></dd>
                    </div>
                    <div class="detail-row">
                        <dt class="detail-label">Selling Price</dt>
                        <dd class="detail-value detail-value-emphasis">₱<?php echo e(number_format($product->selling_price, 2)); ?>

                        </dd>
                    </div>
                    <div class="detail-row">
                        <dt class="detail-label">Profit Margin</dt>
                        <dd class="detail-value text-success"><?php echo e(number_format($product->profit_margin, 1)); ?>%</dd>
                    </div>
                    <div class="detail-row detail-row-total">
                        <dt class="detail-label detail-label-emphasis">Stock Value</dt>
                        <dd class="detail-value detail-value-total">₱<?php echo e(number_format($product->stock_value, 2)); ?></dd>
                    </div>
                </dl>
            </div>
        </div>
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
        margin-bottom: 12px;
    }

    .header-content {
        margin-bottom: 10px;
    }

    @media (min-width: 640px) {
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .header-content {
            margin-bottom: 0;
            flex: 1;
        }
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
        transition: color 0.2s;
        line-height: 1.2;
    }

    .back-link:hover {
        color: #1d4ed8;
    }

    .page-title {
        margin: 4px 0 0 0;
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        line-height: 1.2;
    }

    @media (min-width: 640px) {
        .page-title {
            font-size: 24px;
        }
    }

    .header-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* Buttons */
    .btn-primary,
    .btn-stock-in,
    .btn-stock-out {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        line-height: 1.2;
    }

    .btn-primary {
        color: white;
        background-color: #2563eb;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-stock-in {
        color: white;
        background-color: #16a34a;
    }

    .btn-stock-in:hover {
        background-color: #15803d;
    }

    .btn-stock-out {
        color: white;
        background-color: #dc2626;
    }

    .btn-stock-out:hover {
        background-color: #b91c1c;
    }

    .btn-text {
        display: none;
    }

    @media (min-width: 640px) {
        .btn-text {
            display: inline;
        }
    }

    /* Responsive Display */
    .desktop-only {
        display: none;
    }

    .mobile-only {
        display: block;
    }

    @media (min-width: 1024px) {
        .desktop-only {
            display: block;
        }

        .mobile-only {
            display: none;
        }
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    @media (min-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr 280px;
            gap: 12px;
        }
    }

    .main-content,
    .sidebar-content {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Cards */
    .info-card,
    .image-card {
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .info-card {
        padding: 14px;
    }

    @media (min-width: 640px) {
        .info-card {
            padding: 16px;
        }
    }

    .image-card {
        padding: 10px;
    }

    .card-title {
        font-size: 15px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 10px 0;
        line-height: 1.2;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .view-all-link {
        font-size: 13px;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
        transition: color 0.2s;
        line-height: 1.2;
    }

    .view-all-link:hover {
        color: #1d4ed8;
    }

    /* Product Image */
    .product-image {
        width: 100%;
        border-radius: 6px;
        object-fit: cover;
    }

    .image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 160px;
        background-color: #f3f4f6;
        border-radius: 6px;
    }

    @media (min-width: 1024px) {
        .image-placeholder {
            height: 180px;
        }
    }

    .placeholder-icon {
        width: 48px;
        height: 48px;
        color: #d1d5db;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    @media (min-width: 640px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .info-item-full {
        grid-column: 1 / -1;
    }

    .info-label {
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
        line-height: 1.2;
    }

    .info-value {
        font-size: 14px;
        color: #111827;
        line-height: 1.3;
    }

    /* Details List */
    .details-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        line-height: 1.2;
    }

    .detail-row-total {
        padding-top: 8px;
        border-top: 1px solid #e5e7eb;
        margin-top: 2px;
    }

    .detail-label {
        font-size: 13px;
        color: #6b7280;
    }

    .detail-label-emphasis {
        font-weight: 500;
        color: #374151;
    }

    .detail-value {
        font-size: 14px;
        color: #111827;
    }

    .detail-value-emphasis {
        font-weight: 500;
    }

    .detail-value-stock {
        font-weight: 500;
    }

    .detail-value-total {
        font-size: 15px;
        font-weight: 700;
    }

    .text-success {
        color: #16a34a;
    }

    .text-warning {
        color: #d97706;
    }

    .text-danger {
        color: #dc2626;
    }

    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        font-size: 11px;
        font-weight: 500;
        border-radius: 9999px;
        line-height: 1.3;
    }

    .badge-active {
        color: #065f46;
        background-color: #d1fae5;
    }

    .badge-inactive {
        color: #374151;
        background-color: #f3f4f6;
    }

    .badge-in {
        color: #065f46;
        background-color: #d1fae5;
    }

    .badge-out {
        color: #991b1b;
        background-color: #fee2e2;
    }

    .badge-adjustment {
        color: #92400e;
        background-color: #fef3c7;
    }

    .badge-return {
        color: #1e40af;
        background-color: #dbeafe;
    }

    .badge-stock-in_stock {
        color: #065f46;
        background-color: #d1fae5;
    }

    .badge-stock-low_stock {
        color: #92400e;
        background-color: #fef3c7;
    }

    .badge-stock-out_of_stock {
        color: #991b1b;
        background-color: #fee2e2;
    }

    /* Transactions Table (Desktop) */
    .table-wrapper {
        overflow-x: auto;
    }

    .transactions-table {
        width: 100%;
        border-collapse: collapse;
    }

    .transactions-table thead {
        border-bottom: 1px solid #e5e7eb;
    }

    .table-header-cell {
        padding: 8px 0;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        line-height: 1.2;
    }

    .table-header-cell:first-child {
        padding-left: 0;
    }

    .transactions-table tbody {
        border-top: 1px solid #e5e7eb;
    }

    .table-row {
        border-bottom: 1px solid #e5e7eb;
    }

    .table-cell {
        padding: 8px 0;
        font-size: 13px;
        line-height: 1.3;
    }

    .table-cell:first-child {
        padding-left: 0;
    }

    .transaction-ref {
        font-weight: 500;
        color: #111827;
    }

    .transaction-qty {
        color: #6b7280;
    }

    .transaction-date {
        color: #6b7280;
    }

    /* Transactions List (Mobile) */
    .transactions-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .transaction-card {
        padding: 10px;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
    }

    .transaction-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
    }

    .transaction-details {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .transaction-detail {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        line-height: 1.3;
    }

    /* Empty State */
    .empty-state {
        padding: 24px 0;
        text-align: center;
    }

    .empty-state-text {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
        line-height: 1.3;
    }

    /* Icons */
    .icon-small {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/products/show.blade.php ENDPATH**/ ?>