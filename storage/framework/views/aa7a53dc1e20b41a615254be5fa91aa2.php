<?php $__env->startSection('title', 'Add Category'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .category-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .category-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .category-header-content {
        flex: 1;
    }

    .category-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #111827;
    }

    .category-subtitle {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .back-link {
        margin-top: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
    }

    .back-link:hover {
        color: #1d4ed8;
    }

    .category-form {
        border-radius: 0.5rem;
        background-color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .form-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .form-input {
        margin-top: 0.25rem;
        display: block;
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 0.5rem;
    }

    .form-input:focus {
        border-color: #3b82f6;
        outline: none;
    }

    .error-message {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc2626;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
    }

    .checkbox-input {
        height: 1rem;
        width: 1rem;
        border-radius: 0.25rem;
        border: 1px solid #d1d5db;
    }

    .checkbox-label {
        margin-left: 0.5rem;
        display: block;
        font-size: 0.875rem;
        color: #111827;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        border-top: 1px solid #e5e7eb;
        padding: 1rem 1.5rem;
    }

    .btn-cancel {
        border-radius: 0.375rem;
        background-color: #ffffff;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: 1px solid #d1d5db;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background-color: #f9fafb;
    }

    .btn-submit {
        border-radius: 0.375rem;
        background-color: #2563eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: none;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #1d4ed8;
    }
</style>

<div class="category-container">
    <div class="category-header">
        <div class="category-header-content">
            <h1 class="category-title">Add Category</h1>
            <p class="category-subtitle">Create a new category</p>
        </div>
        <div>
            <a href="<?php echo e(route('categories.index')); ?>"
               class="back-link">← Back</a>
        </div>
    </div>

    <form action="<?php echo e(route('categories.store')); ?>"
          method="POST"
          class="category-form">
        <?php echo csrf_field(); ?>
        <div class="form-content">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text"
                       name="name"
                       id="name"
                       required
                       value="<?php echo e(old('name')); ?>"
                       class="form-input">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-message"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Category</label>
                <select name="parent_id"
                        id="parent_id"
                        class="form-input">
                    <option value="">None (Top Level)</option>
                    <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($parent->id); ?>"
                            <?php echo e(old('parent_id')==$parent->id ? 'selected' : ''); ?>><?php echo e($parent->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-message"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                          id="description"
                          rows="3"
                          class="form-input"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-message"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="checkbox-group">
                <input type="hidden"
                       name="is_active"
                       value="0">
                <input type="checkbox"
                       name="is_active"
                       id="is_active"
                       value="1"
                       <?php echo e(old('is_active',
                       true)
                       ? 'checked'
                       : ''); ?>

                       class="checkbox-input">
                <label for="is_active"
                       class="checkbox-label">Active</label>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?php echo e(route('categories.index')); ?>"
               class="btn-cancel">Cancel</a>
            <button type="submit"
                    class="btn-submit">Create</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/categories/create.blade.php ENDPATH**/ ?>