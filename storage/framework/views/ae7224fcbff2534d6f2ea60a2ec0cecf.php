

<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
      <p class="mt-1 text-sm text-gray-500">Update user information</p>
    </div>
    <div class="mt-4 sm:mt-0">
      <a href="<?php echo e(route('users.index')); ?>"
         class="text-sm font-medium text-primary-600 hover:text-primary-500">← Back</a>
    </div>
  </div>

  <form action="<?php echo e(route('users.update', $user)); ?>"
        method="POST"
        enctype="multipart/form-data"
        class="rounded-lg bg-white shadow">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="space-y-6 p-6">
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="sm:col-span-2">
          <label for="name"
                 class="block text-sm font-medium text-gray-700">Full Name *</label>
          <input type="text"
                 name="name"
                 id="name"
                 required
                 value="<?php echo e(old('name', $user->name)); ?>"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="email"
                 class="block text-sm font-medium text-gray-700">Email *</label>
          <input type="email"
                 name="email"
                 id="email"
                 required
                 value="<?php echo e(old('email', $user->email)); ?>"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="phone"
                 class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text"
                 name="phone"
                 id="phone"
                 value="<?php echo e(old('phone', $user->phone)); ?>"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="password"
                 class="block text-sm font-medium text-gray-700">New Password</label>
          <input type="password"
                 name="password"
                 id="password"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <p class="mt-1 text-xs text-gray-500">Leave blank to keep current password</p>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="password_confirmation"
                 class="block text-sm font-medium text-gray-700">Confirm New Password</label>
          <input type="password"
                 name="password_confirmation"
                 id="password_confirmation"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="role"
                 class="block text-sm font-medium text-gray-700">Role *</label>
          <select name="role"
                  id="role"
                  required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">Select Role</option>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($role->name); ?>"
                    <?php echo e(old('role',
                    $user->roles->first()->name ?? '') == $role->name ? 'selected' : ''); ?>>
              <?php echo e(ucfirst($role->name)); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Current Avatar Display -->
        <?php if($user->avatar): ?>
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Current Avatar</label>
          <div class="mt-1 flex items-center gap-4">
            <img class="h-16 w-16 rounded-full"
                 src="<?php echo e($user->avatar_url); ?>"
                 alt="">
            <div class="flex items-center">
              <input type="checkbox"
                     name="remove_avatar"
                     id="remove_avatar"
                     value="1"
                     <?php echo e(old('remove_avatar')
                     ? 'checked'
                     : ''); ?>

                     class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
              <label for="remove_avatar"
                     class="ml-2 text-sm text-red-600">Remove current avatar</label>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div class="<?php echo e($user->avatar ? '' : 'sm:col-span-2'); ?>">
          <label for="avatar"
                 class="block text-sm font-medium text-gray-700"><?php echo e($user->avatar ? 'New Avatar' : 'Avatar'); ?></label>
          <input type="file"
                 name="avatar"
                 id="avatar"
                 accept="image/*"
                 class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
          <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="sm:col-span-2">
          <div class="flex items-center">
            <input type="hidden"
                   name="is_active"
                   value="0">
            <input type="checkbox"
                   name="is_active"
                   id="is_active"
                   value="1"
                   <?php echo e(old('is_active',
                   $user->is_active) ? 'checked' : ''); ?>

            class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
            <label for="is_active"
                   class="ml-2 block text-sm text-gray-900">Active User</label>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-3 border-t px-6 py-4">
      <a href="<?php echo e(route('users.index')); ?>"
         class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</a>
      <button type="submit"
              class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">Update
        User</button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/users/edit.blade.php ENDPATH**/ ?>