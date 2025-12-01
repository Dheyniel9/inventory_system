<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Page header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500">Welcome back, <?php echo e(auth()->user()->name); ?>!</p>
    </div>

    <!-- Stats cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Products -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-primary-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Total Products</dt>
                        <dd class="text-lg font-semibold text-gray-900"><?php echo e(number_format($stats['total_products'])); ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-green-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Categories</dt>
                        <dd class="text-lg font-semibold text-gray-900"><?php echo e(number_format($stats['total_categories'])); ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-yellow-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Low Stock Items</dt>
                        <dd class="text-lg font-semibold text-yellow-600"><?php echo e(number_format($stats['low_stock_count'])); ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Total Stock Value -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-purple-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Total Stock Value</dt>
                        <dd class="text-lg font-semibold text-gray-900">$<?php echo e(number_format($stats['total_stock_value'], 2)); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Low Stock Products -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Low Stock Alert</h3>
                    <a href="<?php echo e(route('products.low-stock')); ?>" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                </div>
                <div class="mt-4 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <?php if($lowStockProducts->count() > 0): ?>
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Product</th>
                                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">SKU</th>
                                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Qty</th>
                                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Min</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    <?php echo e($product->name); ?>

                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo e($product->sku); ?></td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <span class="<?php echo e($product->quantity <= 0 ? 'text-red-600' : 'text-yellow-600'); ?> font-medium">
                                                        <?php echo e($product->quantity); ?>

                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo e($product->min_stock_level); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-center text-sm text-gray-500 py-4">No low stock items</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Recent Transactions</h3>
                    <a href="<?php echo e(route('stock.index')); ?>" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                </div>
                <div class="mt-4 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <?php if($recentTransactions->count() > 0): ?>
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Reference</th>
                                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Qty</th>
                                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    <?php echo e($transaction->reference_number); ?>

                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                                        <?php echo e($transaction->type === 'in' ? 'bg-green-100 text-green-800' : ''); ?>

                                                        <?php echo e($transaction->type === 'out' ? 'bg-red-100 text-red-800' : ''); ?>

                                                        <?php echo e($transaction->type === 'adjustment' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                                                        <?php echo e($transaction->type === 'return' ? 'bg-blue-100 text-blue-800' : ''); ?>">
                                                        <?php echo e($transaction->type_label); ?>

                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo e($transaction->quantity_change); ?></td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo e($transaction->created_at->diffForHumans()); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-center text-sm text-gray-500 py-4">No recent transactions</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Summary -->
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900">Today's Summary</h3>
            <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-4">
                <div class="rounded-lg bg-green-50 p-4">
                    <p class="text-sm font-medium text-green-600">Stock In</p>
                    <p class="mt-1 text-2xl font-semibold text-green-900"><?php echo e($stockSummary['today']['stock_in']['count']); ?></p>
                    <p class="text-sm text-green-600"><?php echo e(number_format($stockSummary['today']['stock_in']['quantity'])); ?> units</p>
                </div>
                <div class="rounded-lg bg-red-50 p-4">
                    <p class="text-sm font-medium text-red-600">Stock Out</p>
                    <p class="mt-1 text-2xl font-semibold text-red-900"><?php echo e($stockSummary['today']['stock_out']['count']); ?></p>
                    <p class="text-sm text-red-600"><?php echo e(number_format($stockSummary['today']['stock_out']['quantity'])); ?> units</p>
                </div>
                <div class="rounded-lg bg-yellow-50 p-4">
                    <p class="text-sm font-medium text-yellow-600">Adjustments</p>
                    <p class="mt-1 text-2xl font-semibold text-yellow-900"><?php echo e($stockSummary['today']['adjustments']['count']); ?></p>
                    <p class="text-sm text-yellow-600"><?php echo e(number_format($stockSummary['today']['adjustments']['quantity'])); ?> units</p>
                </div>
                <div class="rounded-lg bg-blue-50 p-4">
                    <p class="text-sm font-medium text-blue-600">Returns</p>
                    <p class="mt-1 text-2xl font-semibold text-blue-900"><?php echo e($stockSummary['today']['returns']['count']); ?></p>
                    <p class="text-sm text-blue-600"><?php echo e(number_format($stockSummary['today']['returns']['quantity'])); ?> units</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/dashboard.blade.php ENDPATH**/ ?>