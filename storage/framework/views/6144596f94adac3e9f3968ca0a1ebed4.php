<?php $__env->startSection('title', 'Stock Transactions'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .stock-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stock-title h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .stock-title p {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .stock-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .stock-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .stock-btn-in {
        background-color: #16a34a;
    }

    .stock-btn-in:hover {
        background-color: #15803d;
    }

    .stock-btn-out {
        background-color: #dc2626;
    }

    .stock-btn-out:hover {
        background-color: #b91c1c;
    }

    .stock-btn-adjustment {
        background-color: #f59e0b;
    }

    .stock-btn-adjustment:hover {
        background-color: #d97706;
    }

    .stock-filters {
        background: white;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .stock-filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .stock-filter-group {
        display: flex;
        flex-direction: column;
    }

    .stock-filter-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .stock-filter-input,
    .stock-filter-select {
        display: block;
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        font-size: 0.875rem;
        font-family: inherit;
    }

    .stock-filter-input:focus,
    .stock-filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .stock-filter-buttons {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .stock-filter-btn {
        padding: 0.5rem 0.75rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .stock-filter-btn-submit {
        background-color: #3b82f6;
        color: white;
    }

    .stock-filter-btn-submit:hover {
        background-color: #2563eb;
    }

    .stock-filter-btn-reset {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .stock-filter-btn-reset:hover {
        background-color: #e5e7eb;
    }

    .stock-table-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .stock-table-wrapper {
        overflow-x: auto;
    }

    .stock-table {
        width: 100%;
        border-collapse: collapse;
    }

    .stock-table thead {
        background-color: #f9fafb;
    }

    .stock-table thead tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .stock-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
    }

    .stock-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: background-color 0.2s;
    }

    .stock-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .stock-table td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .stock-table td.nowrap {
        white-space: nowrap;
    }

    .stock-table-link {
        color: #2563eb;
        text-decoration: none;
    }

    .stock-table-link:hover {
        color: #1d4ed8;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .stock-badge-in {
        background-color: #dcfce7;
        color: #166534;
    }

    .stock-badge-out {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .stock-badge-adjustment {
        background-color: #fef3c7;
        color: #92400e;
    }

    .stock-badge-return {
        background-color: #dbeafe;
        color: #0c4a6e;
    }

    .stock-quantity-in {
        color: #16a34a;
        font-weight: 600;
    }

    .stock-quantity-out {
        color: #dc2626;
        font-weight: 600;
    }

    .stock-table-pagination {
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }

    .stock-empty-state {
        padding: 3rem 1.5rem;
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .stock-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .stock-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stock-actions {
            flex-direction: column;
            width: 100%;
        }

        .stock-actions .stock-btn {
            width: 100%;
        }

        .stock-filter-form {
            grid-template-columns: 1fr;
        }

        .stock-filter-buttons {
            flex-direction: column-reverse;
        }

        .stock-filter-btn {
            width: 100%;
        }

        .stock-table {
            font-size: 0.75rem;
        }

        .stock-table th,
        .stock-table td {
            padding: 0.5rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="stock-container">
    <div class="stock-header">
        <div class="stock-title">
            <h1>Stock Transactions</h1>
            <p>View all stock movements</p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage stock')): ?>
        <div class="stock-actions">
            <a href="<?php echo e(route('stock.in')); ?>"
               class="stock-btn stock-btn-in">
                Stock In
            </a>
            <a href="<?php echo e(route('stock.out')); ?>"
               class="stock-btn stock-btn-out">
                Stock Out
            </a>
            <a href="<?php echo e(route('stock.adjustment')); ?>"
               class="stock-btn stock-btn-adjustment">
                Adjustment
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Filters -->
    <div class="stock-filters">
        <form method="GET"
              class="stock-filter-form">
            <div class="stock-filter-group">
                <label for="search"
                       class="stock-filter-label">Search</label>
                <input type="text"
                       name="search"
                       id="search"
                       value="<?php echo e(request('search')); ?>"
                       placeholder="Reference, Product..."
                       class="stock-filter-input">
            </div>
            <div class="stock-filter-group">
                <label for="type"
                       class="stock-filter-label">Type</label>
                <select name="type"
                        id="type"
                        class="stock-filter-select">
                    <option value="">All Types</option>
                    <option value="in"
                            <?php echo e(request('type')==='in'
                            ? 'selected'
                            : ''); ?>>Stock In</option>
                    <option value="out"
                            <?php echo e(request('type')==='out'
                            ? 'selected'
                            : ''); ?>>Stock Out</option>
                    <option value="adjustment"
                            <?php echo e(request('type')==='adjustment'
                            ? 'selected'
                            : ''); ?>>Adjustment</option>
                    <option value="return"
                            <?php echo e(request('type')==='return'
                            ? 'selected'
                            : ''); ?>>Return</option>
                </select>
            </div>
            <div class="stock-filter-group">
                <label for="start_date"
                       class="stock-filter-label">From Date</label>
                <input type="date"
                       name="start_date"
                       id="start_date"
                       value="<?php echo e(request('start_date')); ?>"
                       class="stock-filter-input">
            </div>
            <div class="stock-filter-group">
                <label for="end_date"
                       class="stock-filter-label">To Date</label>
                <input type="date"
                       name="end_date"
                       id="end_date"
                       value="<?php echo e(request('end_date')); ?>"
                       class="stock-filter-input">
            </div>
            <div class="stock-filter-buttons">
                <button type="submit"
                        class="stock-filter-btn stock-filter-btn-submit">
                    Filter
                </button>
                <a href="<?php echo e(route('stock.index')); ?>"
                   class="stock-filter-btn stock-filter-btn-reset">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Transactions table -->
    <div class="stock-table-container">
        <div class="stock-table-wrapper">
            <table class="stock-table">
                <thead>
                    <tr>
                        <th scope="col">Reference</th>
                        <th scope="col">Product</th>
                        <th scope="col">Type</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Before → After</th>
                        <th scope="col">User</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="stock-table td nowrap">
                            <?php echo e($transaction->reference_number); ?>

                        </td>
                        <td class="stock-table td nowrap">
                            <a href="<?php echo e(route('products.show', $transaction->product)); ?>"
                               class="stock-table-link">
                                <?php echo e($transaction->product->name); ?>

                            </a>
                        </td>
                        <td class="stock-table td nowrap">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    <?php echo e($transaction->type === 'in' ? 'bg-green-100 text-green-800' : ''); ?>

                                    <?php echo e($transaction->type === 'out' ? 'bg-red-100 text-red-800' : ''); ?>

                                    <?php echo e($transaction->type === 'adjustment' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                                    <?php echo e($transaction->type === 'return' ? 'bg-blue-100 text-blue-800' : ''); ?>">
                                <?php echo e($transaction->type_label); ?>

                            </span>
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-4 text-sm font-medium <?php echo e($transaction->is_stock_in ? 'text-green-600' : 'text-red-600'); ?>">
                            <?php echo e($transaction->quantity_change); ?>

                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <?php echo e($transaction->quantity_before); ?> → <?php echo e($transaction->quantity_after); ?>

                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <?php echo e($transaction->user->name); ?>

                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <?php echo e($transaction->transaction_date->format('M d, Y H:i')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7"
                            class="px-6 py-12 text-center text-sm text-gray-500">
                            No transactions found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($transactions->hasPages()): ?>
        <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
            <?php echo e($transactions->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/stock/index.blade.php ENDPATH**/ ?>