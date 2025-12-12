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
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['tag' => 'link','href' => ''.e(route('stock.in')).'','variant' => 'primary','icon' => '<path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75\' />']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'link','href' => ''.e(route('stock.in')).'','variant' => 'primary','icon' => '<path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75\' />']); ?>
                Stock In
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['tag' => 'link','href' => ''.e(route('stock.out')).'','variant' => 'danger','icon' => '<path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75\' />']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'link','href' => ''.e(route('stock.out')).'','variant' => 'danger','icon' => '<path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75\' />']); ?>
                Stock Out
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['tag' => 'link','href' => ''.e(route('stock.adjustment')).'','variant' => 'secondary','icon' => '<path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z\' />']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'link','href' => ''.e(route('stock.adjustment')).'','variant' => 'secondary','icon' => '<path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z\' />']); ?>
                Adjustment
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php if (isset($component)) { $__componentOriginal934f921620666b609fa7806109faa21b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal934f921620666b609fa7806109faa21b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.filter-form','data' => ['method' => 'GET','fields' => [
            ['name' => 'search', 'label' => 'Search', 'type' => 'text', 'placeholder' => 'Reference, Product...'],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['in' => 'Stock In', 'out' => 'Stock Out', 'adjustment' => 'Adjustment', 'return' => 'Return']],
            ['name' => 'start_date', 'label' => 'From Date', 'type' => 'date'],
            ['name' => 'end_date', 'label' => 'To Date', 'type' => 'date']
        ],'resetUrl' => ''.e(route('stock.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filter-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['method' => 'GET','fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['name' => 'search', 'label' => 'Search', 'type' => 'text', 'placeholder' => 'Reference, Product...'],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['in' => 'Stock In', 'out' => 'Stock Out', 'adjustment' => 'Adjustment', 'return' => 'Return']],
            ['name' => 'start_date', 'label' => 'From Date', 'type' => 'date'],
            ['name' => 'end_date', 'label' => 'To Date', 'type' => 'date']
        ]),'resetUrl' => ''.e(route('stock.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal934f921620666b609fa7806109faa21b)): ?>
<?php $attributes = $__attributesOriginal934f921620666b609fa7806109faa21b; ?>
<?php unset($__attributesOriginal934f921620666b609fa7806109faa21b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal934f921620666b609fa7806109faa21b)): ?>
<?php $component = $__componentOriginal934f921620666b609fa7806109faa21b; ?>
<?php unset($__componentOriginal934f921620666b609fa7806109faa21b); ?>
<?php endif; ?>

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