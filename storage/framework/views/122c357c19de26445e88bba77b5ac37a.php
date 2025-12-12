

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .page-header {
        margin-bottom: 0.5rem;
    }

    .page-header h1 {
        font-size: 1.875rem;
        font-weight: bold;
        color: #111827;
    }

    .page-header p {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.25rem;
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        overflow: hidden;
        border-radius: 0.5rem;
        background: white;
        padding: 1.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .stat-card-content {
        display: flex;
        align-items: center;
    }

    .stat-icon {
        flex-shrink: 0;
        border-radius: 0.375rem;
        padding: 0.75rem;
        color: white;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    .stat-icon.primary {
        background-color: #3b82f6;
    }

    .stat-icon.green {
        background-color: #10b981;
    }

    .stat-icon.yellow {
        background-color: #eab308;
    }

    .stat-icon.purple {
        background-color: #a855f7;
    }

    .stat-content {
        margin-left: 1.25rem;
        flex: 1;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
    }

    .stat-value {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-top: 0.25rem;
    }

    .stat-value.yellow-text {
        color: #dc2626;
    }

    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    .card {
        overflow: hidden;
        border-radius: 0.5rem;
        background: white;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-header h3 {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
    }

    .card-header a {
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
    }

    .card-header a:hover {
        color: #1d4ed8;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        border-bottom: 1px solid #d1d5db;
        background-color: #f9fafb;
    }

    th {
        padding: 0.875rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
    }

    td {
        padding: 0.875rem;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.875rem;
        color: #111827;
    }

    tbody tr:hover {
        background-color: #f9fafb;
    }

    .empty-state {
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        padding: 1rem;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        border-radius: 9999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-green {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-red {
        background-color: #fee2e2;
        color: #7f1d1d;
    }

    .badge-yellow {
        background-color: #fef08a;
        color: #713f12;
    }

    .badge-blue {
        background-color: #dbeafe;
        color: #0c2340;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-top: 1rem;
    }

    .summary-box {
        border-radius: 0.5rem;
        padding: 1rem;
    }

    .summary-box.green {
        background-color: #f0fdf4;
    }

    .summary-box.red {
        background-color: #fef2f2;
    }

    .summary-box.yellow {
        background-color: #fefce8;
    }

    .summary-box.blue {
        background-color: #eff6ff;
    }

    .summary-label {
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .summary-box.green .summary-label {
        color: #16a34a;
    }

    .summary-box.red .summary-label {
        color: #dc2626;
    }

    .summary-box.yellow .summary-label {
        color: #ca8a04;
    }

    .summary-box.blue .summary-label {
        color: #2563eb;
    }

    .summary-count {
        font-size: 1.875rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .summary-box.green .summary-count {
        color: #166534;
    }

    .summary-box.red .summary-count {
        color: #7f1d1d;
    }

    .summary-box.yellow .summary-count {
        color: #713f12;
    }

    .summary-box.blue .summary-count {
        color: #0c2340;
    }

    .summary-detail {
        font-size: 0.875rem;
    }

    .summary-box.green .summary-detail {
        color: #16a34a;
    }

    .summary-box.red .summary-detail {
        color: #dc2626;
    }

    .summary-box.yellow .summary-detail {
        color: #ca8a04;
    }

    .summary-box.blue .summary-detail {
        color: #2563eb;
    }

    .text-red {
        color: #dc2626;
    }

    .text-yellow {
        color: #ca8a04;
    }
</style>

<div class="dashboard-container">
    <!-- Page header -->
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Welcome back, <?php echo e(auth()->user()->name); ?>!</p>
    </div>

    <!-- Stats cards -->
    <div class="stats-grid">
        <!-- Total Products -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon primary">
                    <svg fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Products</div>
                    <div class="stat-value"><?php echo e(number_format($stats['total_products'])); ?></div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon green">
                    <svg fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Categories</div>
                    <div class="stat-value"><?php echo e(number_format($stats['total_categories'])); ?></div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon yellow">
                    <svg fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Low Stock Items</div>
                    <div class="stat-value yellow-text"><?php echo e(number_format($stats['low_stock_count'])); ?></div>
                </div>
            </div>
        </div>

        <!-- Total Stock Value -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon purple">
                    <svg fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Stock Value</div>
                    <div class="stat-value">$<?php echo e(number_format($stats['total_stock_value'], 2)); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content grid -->
    <div class="content-grid">
        <!-- Low Stock Products -->
        <div class="card">
            <div class="card-header">
                <h3>Low Stock Alert</h3>
                <?php if($lowStockProducts->count() > 0): ?>
                <a href="<?php echo e(route('products.low-stock')); ?>">View all</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <?php if($lowStockProducts->count() > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Min</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->sku); ?></td>
                                <td><span class="<?php echo e($product->quantity <= 0 ? 'text-red' : 'text-yellow'); ?>"><?php echo e($product->quantity); ?></span></td>
                                <td><?php echo e($product->min_stock_level); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="empty-state">No low stock items</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="card">
            <div class="card-header">
                <h3>Recent Transactions</h3>
                <?php if($recentTransactions->count() > 0): ?>
                <a href="<?php echo e(route('stock.index')); ?>">View all</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <?php if($recentTransactions->count() > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transaction->reference_number); ?></td>
                                <td>
                                    <span class="badge
                                                <?php if($transaction->type === 'in'): ?> badge-green
                                                <?php elseif($transaction->type === 'out'): ?> badge-red
                                                <?php elseif($transaction->type === 'adjustment'): ?> badge-yellow
                                                <?php elseif($transaction->type === 'return'): ?> badge-blue
                                                <?php endif; ?>">
                                        <?php echo e($transaction->type_label); ?>

                                    </span>
                                </td>
                                <td><?php echo e($transaction->quantity_change); ?></td>
                                <td><?php echo e($transaction->created_at->diffForHumans()); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="empty-state">No recent transactions</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Summary -->
    <div class="card">
        <div class="card-body">
            <h3>Today's Summary</h3>
            <div class="summary-grid">
                <div class="summary-box green">
                    <div class="summary-label">Stock In</div>
                    <div class="summary-count"><?php echo e($stockSummary['today']['stock_in']['count']); ?></div>
                    <div class="summary-detail"><?php echo e(number_format($stockSummary['today']['stock_in']['quantity'])); ?>

                        units</div>
                </div>
                <div class="summary-box red">
                    <div class="summary-label">Stock Out</div>
                    <div class="summary-count"><?php echo e($stockSummary['today']['stock_out']['count']); ?></div>
                    <div class="summary-detail"><?php echo e(number_format($stockSummary['today']['stock_out']['quantity'])); ?>

                        units</div>
                </div>
                <div class="summary-box yellow">
                    <div class="summary-label">Adjustments</div>
                    <div class="summary-count"><?php echo e($stockSummary['today']['adjustments']['count']); ?></div>
                    <div class="summary-detail"><?php echo e(number_format($stockSummary['today']['adjustments']['quantity'])); ?>

                        units</div>
                </div>
                <div class="summary-box blue">
                    <div class="summary-label">Returns</div>
                    <div class="summary-count"><?php echo e($stockSummary['today']['returns']['count']); ?></div>
                    <div class="summary-detail"><?php echo e(number_format($stockSummary['today']['returns']['quantity'])); ?> units
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/dashboard.blade.php ENDPATH**/ ?>