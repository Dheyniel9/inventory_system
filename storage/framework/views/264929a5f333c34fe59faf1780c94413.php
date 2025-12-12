

<?php $__env->startSection('title', 'Add Supplier'); ?>

<?php $__env->startSection('css'); ?>
<style>
       .supplier-container {
              display: flex;
              flex-direction: column;
              gap: 1.5rem;
       }

       .supplier-header {
              display: flex;
              justify-content: space-between;
              align-items: center;
              flex-wrap: wrap;
              gap: 1rem;
       }

       .supplier-title h1 {
              font-size: 1.875rem;
              font-weight: 700;
              color: #111827;
              margin: 0;
       }

       .supplier-title p {
              margin-top: 0.25rem;
              font-size: 0.875rem;
              color: #6b7280;
       }

       .supplier-back-link {
              font-size: 0.875rem;
              font-weight: 500;
              color: #2563eb;
              text-decoration: none;
       }

       .supplier-back-link:hover {
              color: #1d4ed8;
       }

       .supplier-form-card {
              border-radius: 0.5rem;
              background: white;
              box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
              padding: 1.5rem;
       }

       .supplier-form {
              display: flex;
              flex-direction: column;
              gap: 1.5rem;
       }

       .supplier-grid {
              display: grid;
              grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
              gap: 1.5rem;
       }

       .supplier-grid-full {
              grid-column: 1 / -1;
       }

       .supplier-form-group {
              display: flex;
              flex-direction: column;
       }

       .supplier-form-label {
              display: block;
              font-size: 0.875rem;
              font-weight: 500;
              color: #374151;
              margin-bottom: 0.25rem;
       }

       .supplier-form-input,
       .supplier-form-textarea {
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

       .supplier-form-input:focus,
       .supplier-form-textarea:focus {
              outline: none;
              border-color: #3b82f6;
              box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
       }

       .supplier-form-textarea {
              resize: vertical;
       }

       .supplier-form-error {
              margin-top: 0.25rem;
              font-size: 0.875rem;
              color: #dc2626;
       }

       .supplier-form-actions {
              display: flex;
              justify-content: flex-end;
              gap: 0.75rem;
              padding-top: 1rem;
              border-top: 1px solid #e5e7eb;
              margin-top: 1rem;
       }

       .supplier-btn {
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

       .supplier-btn-cancel {
              background: white;
              color: #111827;
              border: 1px solid #d1d5db;
       }

       .supplier-btn-cancel:hover {
              background-color: #f9fafb;
       }

       .supplier-btn-submit {
              background-color: #3b82f6;
              color: white;
       }

       .supplier-btn-submit:hover {
              background-color: #2563eb;
       }

       @media (max-width: 768px) {
              .supplier-header {
                     flex-direction: column;
                     align-items: flex-start;
              }

              .supplier-grid {
                     grid-template-columns: 1fr;
              }

              .supplier-form-actions {
                     flex-direction: column-reverse;
              }
       }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="supplier-container">
       <div class="supplier-header">
              <div class="supplier-title">
                     <h1>Add Supplier</h1>
                     <p>Create a new supplier</p>
              </div>
              <div>
                     <a href="<?php echo e(route('suppliers.index')); ?>"
                        class="supplier-back-link">← Back</a>
              </div>
       </div>

       <form action="<?php echo e(route('suppliers.store')); ?>"
             method="POST"
             class="supplier-form-card">
              <?php echo csrf_field(); ?>
              <div class="supplier-form">
                     <div class="supplier-grid">
                            <div class="supplier-grid-full">
                                   <div class="supplier-form-group">
                                          <label for="name"
                                                 class="supplier-form-label">Name *</label>
                                          <input type="text"
                                                 name="name"
                                                 id="name"
                                                 required
                                                 value="<?php echo e(old('name')); ?>"
                                                 class="supplier-form-input">
                                          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div>
                                   <div class="supplier-form-group">
                                          <label for="email"
                                                 class="supplier-form-label">Email</label>
                                          <input type="email"
                                                 name="email"
                                                 id="email"
                                                 value="<?php echo e(old('email')); ?>"
                                                 class="supplier-form-input">
                                          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div>
                                   <div class="supplier-form-group">
                                          <label for="phone"
                                                 class="supplier-form-label">Phone</label>
                                          <input type="text"
                                                 name="phone"
                                                 id="phone"
                                                 value="<?php echo e(old('phone')); ?>"
                                                 class="supplier-form-input">
                                          <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div>
                                   <div class="supplier-form-group">
                                          <label for="contact_person"
                                                 class="supplier-form-label">Contact Person</label>
                                          <input type="text"
                                                 name="contact_person"
                                                 id="contact_person"
                                                 value="<?php echo e(old('contact_person')); ?>"
                                                 class="supplier-form-input">
                                          <?php $__errorArgs = ['contact_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p>
                                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div>
                                   <div class="supplier-form-group">
                                          <label for="city"
                                                 class="supplier-form-label">City</label>
                                          <input type="text"
                                                 name="city"
                                                 id="city"
                                                 value="<?php echo e(old('city')); ?>"
                                                 class="supplier-form-input">
                                          <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div>
                                   <div class="supplier-form-group">
                                          <label for="country"
                                                 class="supplier-form-label">Country</label>
                                          <input type="text"
                                                 name="country"
                                                 id="country"
                                                 value="<?php echo e(old('country')); ?>"
                                                 class="supplier-form-input">
                                          <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div class="supplier-grid-full">
                                   <div class="supplier-form-group">
                                          <label for="address"
                                                 class="supplier-form-label">Address</label>
                                          <textarea name="address"
                                                    id="address"
                                                    rows="3"
                                                    class="supplier-form-textarea"><?php echo e(old('address')); ?></textarea>
                                          <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="supplier-form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                   </div>
                            </div>

                            <div class="supplier-grid-full">
                                   <div style="display: flex; align-items: center;">
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

                                                 style="width: 1rem; height: 1rem;">
                                          <label for="is_active"
                                                 style="margin-left: 0.5rem; font-size: 0.875rem;">Active</label>
                                   </div>
                            </div>
                     </div>

                     <div class="supplier-form-actions">
                            <a href="<?php echo e(route('suppliers.index')); ?>"
                               class="supplier-btn supplier-btn-cancel">Cancel</a>
                            <button type="submit"
                                    class="supplier-btn supplier-btn-submit">Create</button>
                     </div>
       </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/suppliers/create.blade.php ENDPATH**/ ?>