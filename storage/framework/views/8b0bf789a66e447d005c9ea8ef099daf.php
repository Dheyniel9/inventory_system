
<style>
  .filter-container {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
  }

  .filter-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    align-items: flex-end;
  }

  .filter-group {
    display: flex;
    flex-direction: column;
  }

  .filter-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.25rem;
  }

  .filter-input,
  .filter-select {
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    background: white;
  }

  .filter-input:focus,
  .filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .filter-buttons {
    display: flex;
    align-items: flex-end;
    gap: 0.5rem;
  }

  .filter-button {
    padding: 0.5rem 0.75rem;
    border: none;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .filter-button.primary {
    background-color: #3b82f6;
    color: white;
  }

  .filter-button.primary:hover {
    background-color: #2563eb;
  }

  .filter-button.secondary {
    background-color: #f3f4f6;
    color: #4b5563;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .filter-button.secondary:hover {
    background-color: #e5e7eb;
  }

  @media (max-width: 768px) {
    .filter-form {
      grid-template-columns: 1fr;
    }

    .filter-buttons {
      grid-column: 1 / -1;
    }
  }
</style>

<div class="filter-container">
  <form method="GET"
        class="filter-form"
        action="<?php echo e($action ?? '#'); ?>">
    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="filter-group">
      <label for="<?php echo e($field['name']); ?>"
             class="filter-label">
        <?php echo e($field['label'] ?? ucfirst($field['name'])); ?>

      </label>

      <?php if($field['type'] === 'select'): ?>
      <select name="<?php echo e($field['name']); ?>"
              id="<?php echo e($field['name']); ?>"
              class="filter-select">
        <option value=""><?php echo e($field['placeholder'] ?? 'Select...'); ?></option>
        <?php $__currentLoopData = $field['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($value); ?>"
                <?php if(request($field['name'])==$value): ?>
                selected
                <?php endif; ?>>
          <?php echo e($label); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php elseif($field['type'] === 'date'): ?>
      <input type="date"
             name="<?php echo e($field['name']); ?>"
             id="<?php echo e($field['name']); ?>"
             value="<?php echo e(request($field['name'])); ?>"
             class="filter-input">
      <?php elseif($field['type'] === 'number'): ?>
      <input type="number"
             name="<?php echo e($field['name']); ?>"
             id="<?php echo e($field['name']); ?>"
             value="<?php echo e(request($field['name'])); ?>"
             placeholder="<?php echo e($field['placeholder'] ?? ''); ?>"
             class="filter-input">
      <?php else: ?>
      <input type="text"
             name="<?php echo e($field['name']); ?>"
             id="<?php echo e($field['name']); ?>"
             value="<?php echo e(request($field['name'])); ?>"
             placeholder="<?php echo e($field['placeholder'] ?? ''); ?>"
             class="filter-input">
      <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="filter-buttons">
      <button type="submit"
              class="filter-button primary">
        <?php echo e($submitLabel ?? 'Filter'); ?>

      </button>
      <?php if($resetUrl ?? false): ?>
      <a href="<?php echo e($resetUrl); ?>"
         class="filter-button secondary">
        <?php echo e($resetLabel ?? 'Reset'); ?>

      </a>
      <?php endif; ?>
    </div>
  </form>
</div>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/components/filter-form.blade.php ENDPATH**/ ?>