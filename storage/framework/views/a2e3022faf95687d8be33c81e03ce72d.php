
<style>
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
    margin-bottom: 1rem;
  }

  .form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
  }

  .form-label.required::after {
    content: ' *';
    color: #dc2626;
  }

  .form-input,
  .form-select,
  .form-textarea {
    padding: 0.625rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-family: inherit;
    transition: all 0.2s;
  }

  .form-input:focus,
  .form-select:focus,
  .form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .form-textarea {
    resize: vertical;
    min-height: 6rem;
  }

  .form-help {
    font-size: 0.8125rem;
    color: #6b7280;
    margin-top: 0.25rem;
  }

  .form-error {
    font-size: 0.8125rem;
    color: #dc2626;
    margin-top: 0.25rem;
  }

  .form-input.error,
  .form-select.error,
  .form-textarea.error {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
  }
</style>

<div class="form-group">
  <?php if($label ?? false): ?>
  <label for="<?php echo e($name); ?>"
         class="form-label <?php echo e($required ?? false ? 'required' : ''); ?>">
    <?php echo e($label); ?>

  </label>
  <?php endif; ?>

  <?php if($type === 'select'): ?>
  <select name="<?php echo e($name); ?>"
          id="<?php echo e($name); ?>"
          class="form-input <?php echo e($error ?? false ? 'error' : ''); ?>"
          <?php if($required
          ??
          false): ?>
          required
          <?php endif; ?>
          <?php if($disabled
          ??
          false): ?>
          disabled
          <?php endif; ?>>
    <?php $__currentLoopData = $options ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($value); ?>"
            <?php if($value===($selected
            ??
            null)): ?>
            selected
            <?php endif; ?>>
      <?php echo e($text); ?>

    </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <?php elseif($type === 'textarea'): ?>
  <textarea name="<?php echo e($name); ?>"
            id="<?php echo e($name); ?>"
            class="form-input <?php echo e($error ?? false ? 'error' : ''); ?>"
            <?php if($required
            ??
            false): ?>
            required
            <?php endif; ?>
            <?php if($disabled
            ??
            false): ?>
            disabled
            <?php endif; ?>
            placeholder="<?php echo e($placeholder ?? ''); ?>"><?php echo e($value ?? ''); ?></textarea>
  <?php else: ?>
  <input type="<?php echo e($type ?? 'text'); ?>"
         name="<?php echo e($name); ?>"
         id="<?php echo e($name); ?>"
         class="form-input <?php echo e($error ?? false ? 'error' : ''); ?>"
         value="<?php echo e($value ?? ''); ?>"
         placeholder="<?php echo e($placeholder ?? ''); ?>"
         <?php if($required
         ??
         false): ?>
         required
         <?php endif; ?>
         <?php if($disabled
         ??
         false): ?>
         disabled
         <?php endif; ?>>
  <?php endif; ?>

  <?php if($help ?? false): ?>
  <span class="form-help"><?php echo e($help); ?></span>
  <?php endif; ?>

  <?php if($error ?? false): ?>
  <span class="form-error"><?php echo e($error); ?></span>
  <?php endif; ?>
</div>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/components/form-group.blade.php ENDPATH**/ ?>