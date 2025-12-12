

<?php $__env->startSection('title', 'Stock Adjustment'); ?>

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

  .stock-info-box {
    border-radius: 0.375rem;
    background-color: #dbeafe;
    padding: 1rem;
    display: flex;
    gap: 0.75rem;
  }

  .stock-info-icon {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    color: #0369a1;
  }

  .stock-info-text {
    font-size: 0.875rem;
    color: #0c4a6e;
  }

  .stock-info-text strong {
    font-weight: 600;
  }

  .stock-adjustment-preview {
    margin-top: 0.5rem;
    font-size: 0.875rem;
  }

  .stock-adjustment-preview.increase {
    color: #16a34a;
  }

  .stock-adjustment-preview.decrease {
    color: #dc2626;
  }

  .stock-adjustment-preview.neutral {
    color: #6b7280;
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
    background-color: #f59e0b;
    color: white;
  }

  .stock-btn-submit:hover {
    background-color: #d97706;
  }

  .stock-btn-green {
    background-color: #16a34a;
    color: white;
  }

  .stock-btn-green:hover {
    background-color: #15803d;
  }

  .stock-btn-red {
    background-color: #dc2626;
    color: white;
  }

  .stock-btn-red:hover {
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
      <h1>Stock Adjustment</h1>
      <p>Adjust inventory quantities to match physical counts</p>
    </div>
    <div>
      <a href="<?php echo e(route('stock.index')); ?>"
         class="stock-back-link">
        ← Back to Transactions
      </a>
    </div>
  </div>

  <div class="stock-form-card">
    <form action="<?php echo e(route('stock.adjustment.process')); ?>"
          method="POST"
          class="stock-form"
          x-data="stockAdjustment()">
      <?php echo csrf_field(); ?>
      <div class="stock-grid">
        <div class="stock-grid-full">
          <label for="product_id"
                 class="stock-form-label">Product *</label>
          <select name="product_id"
                  id="product_id"
                  required
                  x-model="selectedProduct"
                  @change="updateCurrentStock()"
                  class="stock-form-select">
            <option value="">Select Product</option>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($product->id); ?>"
                    data-current-stock="<?php echo e($product->quantity); ?>"
                    data-product-name="<?php echo e($product->name); ?>"
                    <?php echo e((old('product_id')
                    ??
                    request('product_id'))==$product->id ? 'selected' : ''); ?>>
              <?php echo e($product->name); ?> (<?php echo e($product->sku); ?>) - Current: <?php echo e($product->quantity); ?>

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

        <!-- Current Stock Display -->
        <div x-show="currentStock !== null"
             class="stock-grid-full">
          <div class="stock-info-box">
            <div class="stock-info-icon">
              <svg viewBox="0 0 20 20"
                   fill="currentColor">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                      clip-rule="evenodd" />
              </svg>
            </div>
            <div>
              <p class="stock-info-text">
                <span class="font-medium"
                      x-text="productName"></span> currently has <strong x-text="currentStock"></strong> units in
                stock.
              </p>
            </div>
          </div>
        </div>

        <div>
          <label for="new_quantity"
                 class="stock-form-label">New Quantity *</label>
          <input type="number"
                 name="new_quantity"
                 id="new_quantity"
                 required
                 min="0"
                 value="<?php echo e(old('new_quantity', 0)); ?>"
                 x-model="newQuantity"
                 class="stock-form-input">
          <?php $__errorArgs = ['new_quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="stock-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

          <!-- Adjustment Preview -->
          <div x-show="currentStock !== null && newQuantity !== ''"
               class="stock-adjustment-preview"
               :class="adjustmentDifference > 0 ? 'increase' : adjustmentDifference < 0 ? 'decrease' : 'neutral'">
            <span x-show="adjustmentDifference > 0">
              Increase by <span x-text="Math.abs(adjustmentDifference)"></span> units
            </span>
            <span x-show="adjustmentDifference < 0">
              Decrease by <span x-text="Math.abs(adjustmentDifference)"></span> units
            </span>
            <span x-show="adjustmentDifference === 0">
              No change in quantity
            </span>
          </div>
        </div>

        <div>
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

        <div class="stock-grid-full">
          <label for="reason"
                 class="stock-form-label">Reason *</label>
          <input type="text"
                 name="reason"
                 id="reason"
                 required
                 value="<?php echo e(old('reason')); ?>"
                 placeholder="e.g., Physical count adjustment, Damaged goods, Inventory correction"
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

        <div class="stock-grid-full">
          <label for="notes"
                 class="stock-form-label">Notes</label>
          <textarea name="notes"
                    id="notes"
                    rows="3"
                    placeholder="Additional details about the adjustment..."
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
          Record Stock Adjustment
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function stockAdjustment() {
    return {
        selectedProduct: '<?php echo e(old('product_id') ?? request('product_id')); ?>',
        currentStock: null,
        newQuantity: '<?php echo e(old('new_quantity', '')); ?>',
        productName: '',

        get adjustmentDifference() {
            if (this.currentStock === null || this.newQuantity === '') return 0;
            return parseInt(this.newQuantity) - parseInt(this.currentStock);
        },

        updateCurrentStock() {
            const select = document.getElementById('product_id');
            const option = select.options[select.selectedIndex];

            if (option && option.value) {
                this.currentStock = parseInt(option.dataset.currentStock);
                this.productName = option.dataset.productName;
            } else {
                this.currentStock = null;
                this.productName = '';
            }
        },

        init() {
            // Set initial values if product is pre-selected
            if (this.selectedProduct) {
                this.updateCurrentStock();
            }
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/stock/adjustment.blade.php ENDPATH**/ ?>