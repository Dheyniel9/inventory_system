<?php $__env->startSection('title', 'Add Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-responsive">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Add Product</h1>
            <p class="page-description">Create a new product in your inventory</p>
        </div>
        <div class="header-actions">
            <a href="<?php echo e(route('products.index')); ?>"
               class="btn-back">
                <svg class="icon-small"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span class="btn-text">Back</span>
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="<?php echo e(route('products.store')); ?>"
          method="POST"
          enctype="multipart/form-data"
          class="form-container">
        <?php echo csrf_field(); ?>

        <!-- Basic Information Section -->
        <div class="form-section">
            <h2 class="section-title">Basic Information</h2>

            <div class="form-grid">
                <!-- Product Name -->
                <div class="form-group form-group-full">
                    <label for="name"
                           class="form-label">
                        Product Name <span class="required">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           required
                           value="<?php echo e(old('name')); ?>"
                           placeholder="Enter product name"
                           class="form-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- SKU -->
                <div class="form-group">
                    <label for="sku"
                           class="form-label">SKU</label>
                    <input type="text"
                           name="sku"
                           id="sku"
                           value="<?php echo e(old('sku')); ?>"
                           placeholder="Auto-generated if empty"
                           class="form-input <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Barcode -->
                <div class="form-group">
                    <label for="barcode"
                           class="form-label">Barcode</label>
                    <input type="text"
                           name="barcode"
                           id="barcode"
                           value="<?php echo e(old('barcode')); ?>"
                           placeholder="Enter barcode"
                           class="form-input <?php $__errorArgs = ['barcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['barcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Description -->
                <div class="form-group form-group-full">
                    <label for="description"
                           class="form-label">Description</label>
                    <textarea name="description"
                              id="description"
                              rows="3"
                              placeholder="Enter product description"
                              class="form-textarea <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label for="category_id"
                           class="form-label">Category</label>
                    <select name="category_id"
                            id="category_id"
                            class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">Select Category</option>
                        <?php if(isset($categories)): ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category['id']); ?>"
                                <?php echo e(old('category_id')==$category['id']
                                ? 'selected'
                                : ''); ?>>
                            <?php echo e($category['name']); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Supplier -->
                <div class="form-group">
                    <label for="supplier_id"
                           class="form-label">Supplier</label>
                    <select name="supplier_id"
                            id="supplier_id"
                            class="form-select <?php $__errorArgs = ['supplier_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">Select Supplier</option>
                        <?php if(isset($suppliers)): ?>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($supplier->id); ?>"
                                <?php echo e(old('supplier_id')==$supplier->id ? 'selected' : ''); ?>>
                            <?php echo e($supplier->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <?php $__errorArgs = ['supplier_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Pricing & Stock Section -->
        <div class="form-section">
            <h2 class="section-title">Pricing & Stock</h2>

            <div class="form-grid form-grid-3">
                <!-- Cost Price -->
                <div class="form-group">
                    <label for="cost_price"
                           class="form-label">
                        Cost Price <span class="required">*</span>
                    </label>
                    <div class="input-with-prefix">
                        <span class="input-prefix">₱</span>
                        <input type="number"
                               name="cost_price"
                               id="cost_price"
                               required
                               step="0.01"
                               min="0"
                               value="<?php echo e(old('cost_price', '0.00')); ?>"
                               class="form-input input-with-prefix-field <?php $__errorArgs = ['cost_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['cost_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Selling Price -->
                <div class="form-group">
                    <label for="selling_price"
                           class="form-label">
                        Selling Price <span class="required">*</span>
                    </label>
                    <div class="input-with-prefix">
                        <span class="input-prefix">₱</span>
                        <input type="number"
                               name="selling_price"
                               id="selling_price"
                               required
                               step="0.01"
                               min="0"
                               value="<?php echo e(old('selling_price', '0.00')); ?>"
                               class="form-input input-with-prefix-field <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Initial Quantity -->
                <div class="form-group">
                    <label for="quantity"
                           class="form-label">
                        Initial Quantity <span class="required">*</span>
                    </label>
                    <input type="number"
                           name="quantity"
                           id="quantity"
                           required
                           min="0"
                           value="<?php echo e(old('quantity', '0')); ?>"
                           class="form-input <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Min Stock Level -->
                <div class="form-group">
                    <label for="min_stock_level"
                           class="form-label">
                        Min Stock Level <span class="required">*</span>
                    </label>
                    <input type="number"
                           name="min_stock_level"
                           id="min_stock_level"
                           required
                           min="0"
                           value="<?php echo e(old('min_stock_level', '0')); ?>"
                           class="form-input <?php $__errorArgs = ['min_stock_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['min_stock_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Max Stock Level -->
                <div class="form-group">
                    <label for="max_stock_level"
                           class="form-label">Max Stock Level</label>
                    <input type="number"
                           name="max_stock_level"
                           id="max_stock_level"
                           min="0"
                           value="<?php echo e(old('max_stock_level')); ?>"
                           class="form-input <?php $__errorArgs = ['max_stock_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['max_stock_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Unit -->
                <div class="form-group">
                    <label for="unit"
                           class="form-label">
                        Unit <span class="required">*</span>
                    </label>
                    <select name="unit"
                            id="unit"
                            required
                            class="form-select <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="pcs"
                                <?php echo e(old('unit', 'pcs'
                                )==='pcs'
                                ? 'selected'
                                : ''); ?>>Pieces (pcs)</option>
                        <option value="box"
                                <?php echo e(old('unit')==='box'
                                ? 'selected'
                                : ''); ?>>Box</option>
                        <option value="kg"
                                <?php echo e(old('unit')==='kg'
                                ? 'selected'
                                : ''); ?>>Kilogram (kg)</option>
                        <option value="ltr"
                                <?php echo e(old('unit')==='ltr'
                                ? 'selected'
                                : ''); ?>>Liter (ltr)</option>
                        <option value="m"
                                <?php echo e(old('unit')==='m'
                                ? 'selected'
                                : ''); ?>>Meter (m)</option>
                        <option value="ream"
                                <?php echo e(old('unit')==='ream'
                                ? 'selected'
                                : ''); ?>>Ream</option>
                    </select>
                    <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="form-section">
            <h2 class="section-title">Additional Information</h2>

            <div class="form-grid">
                <!-- Storage Location -->
                <div class="form-group">
                    <label for="location"
                           class="form-label">Storage Location</label>
                    <input type="text"
                           name="location"
                           id="location"
                           value="<?php echo e(old('location')); ?>"
                           placeholder="e.g., Warehouse A - Shelf 1"
                           class="form-input <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Product Image -->
                <div class="form-group">
                    <label for="image"
                           class="form-label">Product Image</label>
                    <input type="file"
                           name="image"
                           id="image"
                           accept="image/*"
                           class="form-file <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Active Status -->
                <div class="form-group form-group-full">
                    <div class="checkbox-container">
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

                               class="form-checkbox">
                        <label for="is_active"
                               class="checkbox-label">
                            Active product
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="<?php echo e(route('products.index')); ?>"
               class="btn-secondary">
                Cancel
            </a>
            <button type="submit"
                    class="btn-primary">
                <svg class="icon-small"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Product
            </button>
        </div>
    </form>
</div>

<style>
    /* Container */
    .container-responsive {
        width: 100%;
        max-width: 80rem;
        margin: 0 auto;
        padding: 1rem;
    }

    @media (min-width: 640px) {
        .container-responsive {
            padding: 1.5rem;
        }
    }

    /* Page Header */
    .page-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 640px) {
        .page-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
    }

    .header-content {
        flex: 1;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    @media (min-width: 640px) {
        .page-title {
            font-size: 1.875rem;
        }
    }

    .page-description {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .header-actions {
        display: flex;
        justify-content: flex-start;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
        transition: color 0.2s;
    }

    .btn-back:hover {
        color: #1d4ed8;
    }

    .btn-text {
        display: none;
    }

    @media (min-width: 640px) {
        .btn-text {
            display: inline;
        }
    }

    /* Form Container */
    .form-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    /* Form Section */
    .form-section {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.25rem;
    }

    @media (min-width: 640px) {
        .form-section {
            padding: 1.5rem;
        }
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0 0 1.25rem 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }

    @media (min-width: 640px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    .form-grid-3 {
        grid-template-columns: 1fr;
    }

    @media (min-width: 768px) {
        .form-grid-3 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .form-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Form Group */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .required {
        color: #dc2626;
    }

    /* Form Inputs */
    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.625rem 0.875rem;
        font-size: 0.875rem;
        color: #111827;
        background-color: white;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 5rem;
    }

    .input-error {
        border-color: #dc2626;
    }

    .input-error:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Input with Prefix */
    .input-with-prefix {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-prefix {
        position: absolute;
        left: 0.875rem;
        font-size: 0.875rem;
        color: #6b7280;
        pointer-events: none;
    }

    .input-with-prefix-field {
        padding-left: 2rem;
    }

    /* File Input */
    .form-file {
        width: 100%;
        font-size: 0.875rem;
        color: #6b7280;
        cursor: pointer;
    }

    .form-file::file-selector-button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e40af;
        background-color: #eff6ff;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .form-file::file-selector-button:hover {
        background-color: #dbeafe;
    }

    /* Checkbox */
    .checkbox-container {
        display: flex;
        align-items: center;
    }

    .form-checkbox {
        width: 1rem;
        height: 1rem;
        color: #2563eb;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .form-checkbox:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .checkbox-label {
        margin-left: 0.5rem;
        font-size: 0.875rem;
        color: #111827;
        cursor: pointer;
    }

    /* Error Message */
    .error-message {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #dc2626;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    @media (min-width: 640px) {
        .form-actions {
            flex-direction: row;
            justify-content: flex-end;
        }
    }

    /* Buttons */
    .btn-primary,
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-primary {
        color: white;
        background-color: #2563eb;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-secondary {
        color: #111827;
        background-color: white;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-secondary:hover {
        background-color: #f9fafb;
    }

    @media (min-width: 640px) {

        .btn-primary,
        .btn-secondary {
            width: auto;
        }
    }

    /* Icons */
    .icon-small {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/products/create.blade.php ENDPATH**/ ?>