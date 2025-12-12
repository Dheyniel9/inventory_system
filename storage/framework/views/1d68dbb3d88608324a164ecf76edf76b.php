<?php $__env->startSection('title', 'Stock Out'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .stock-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
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

    .stock-back-link {
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
    }

    .stock-back-link:hover {
        color: #1d4ed8;
    }

    .stock-form-card {
        border-radius: 0.5rem;
        background: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }

    .stock-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .stock-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .stock-grid-full {
        grid-column: 1 / -1;
    }

    .stock-form-group {
        display: flex;
        flex-direction: column;
    }

    .stock-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .stock-form-input,
    .stock-form-select,
    .stock-form-textarea {
        margin-top: 0.25rem;
        display: block;
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        font-size: 0.875rem;
        font-family: inherit;
    }

    .stock-form-input:focus,
    .stock-form-select:focus,
    .stock-form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .stock-form-textarea {
        resize: vertical;
    }

    .stock-form-error {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc2626;
    }

    .stock-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        margin-top: 1rem;
    }

    .stock-btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: background-color 0.2s;
    }

    .stock-btn-cancel {
        background: white;
        color: #111827;
        border: 1px solid #d1d5db;
    }

    .stock-btn-cancel:hover {
        background-color: #f9fafb;
    }

    .stock-btn-submit {
        background-color: #dc2626;
        color: white;
    }

    .stock-btn-submit:hover {
        background-color: #b91c1c;
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

        .stock-grid {
            grid-template-columns: 1fr;
        }

        .stock-form-actions {
            flex-direction: column-reverse;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="stock-container">
    <div class="stock-header">
        <div class="stock-title">
            <h1>Stock Out</h1>
            <p>Record outgoing inventory</p>
        </div>
        <div>
            <a href="<?php echo e(route('stock.index')); ?>"
               class="stock-back-link">
                ← Back to Transactions
            </a>
        </div>
    </div>

    <div class="stock-form-card">
        <form action="<?php echo e(route('stock.out.process')); ?>"
              method="POST"
              class="stock-form">
            <?php echo csrf_field(); ?>
            <div class="stock-grid">
                <div class="stock-form-group stock-grid-full">
                    <label for="product_id"
                           class="stock-form-label">Product *</label>
                    <select name="product_id"
                            id="product_id"
                            required
                            class="stock-form-select">
                        <option value="">Select Product</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>"
                                <?php echo e((old('product_id')
                                ??
                                request('product_id'))==$product->id ? 'selected' : ''); ?>>
                            <?php echo e($product->name); ?> (<?php echo e($product->sku); ?>) - Available: <?php echo e($product->quantity); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="stock-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="stock-form-group">
                    <label for="quantity"
                           class="stock-form-label">Quantity *</label>
                    <input type="number"
                           name="quantity"
                           id="quantity"
                           required
                           min="1"
                           value="<?php echo e(old('quantity', 1)); ?>"
                           class="stock-form-input">
                    <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="stock-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="stock-form-group">
                    <label for="transaction_date"
                           class="stock-form-label">Transaction Date</label>
                    <input type="datetime-local"
                           name="transaction_date"
                           id="transaction_date"
                           value="<?php echo e(old('transaction_date', now()->format('Y-m-d\TH:i'))); ?>"
                           class="stock-form-input">
                    <?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="stock-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="stock-form-group stock-grid-full">
                    <label for="reason"
                           class="stock-form-label">Reason</label>
                    <input type="text"
                           name="reason"
                           id="reason"
                           value="<?php echo e(old('reason')); ?>"
                           placeholder="e.g., Sale, Transfer, Damaged"
                           class="stock-form-input">
                    <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="stock-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="stock-form-group stock-grid-full">
                    <label for="notes"
                           class="stock-form-label">Notes</label>
                    <textarea name="notes"
                              id="notes"
                              rows="3"
                              class="stock-form-textarea"><?php echo e(old('notes')); ?></textarea>
                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="stock-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="stock-form-actions">
                <a href="<?php echo e(route('stock.index')); ?>"
                   class="stock-btn stock-btn-cancel">
                    Cancel
                </a>
                <button type="submit"
                        class="stock-btn stock-btn-submit">
                    Record Stock Out
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/stock/stock-out.blade.php ENDPATH**/ ?>