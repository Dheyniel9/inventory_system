

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
  <div class="sm:flex sm:items-center sm:justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-900">Users</h1>
      <p class="mt-1 text-sm text-gray-500">Manage system users and their permissions</p>
    </div>
    <div class="mt-4 sm:mt-0">
      <a href="<?php echo e(route('users.create')); ?>"
         class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5"
             viewBox="0 0 20 20"
             fill="currentColor">
          <path
                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
        </svg>
        Add User
      </a>
    </div>
  </div>

  <!-- Search and Filters -->
  <div class="rounded-lg bg-white p-4 shadow">
    <form method="GET"
          class="flex flex-col gap-4 sm:flex-row">
      <div class="flex-1">
        <input type="text"
               name="search"
               value="<?php echo e(request('search')); ?>"
               placeholder="Search users..."
               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
      </div>
      <div>
        <select name="is_active"
                class="block rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <option value="">All Status</option>
          <option value="1"
                  <?php echo e(request('is_active')=='1'
                  ? 'selected'
                  : ''); ?>>Active</option>
          <option value="0"
                  <?php echo e(request('is_active')=='0'
                  ? 'selected'
                  : ''); ?>>Inactive</option>
        </select>
      </div>
      <div>
        <select name="role"
                class="block rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          <option value="">All Roles</option>
          <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($role->name); ?>"
                  <?php echo e(request('role')==$role->name ? 'selected' : ''); ?>>
            <?php echo e(ucfirst($role->name)); ?>

          </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <button type="submit"
              class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
        Search
      </button>
      <a href="<?php echo e(route('users.index')); ?>"
         class="inline-flex items-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">
        Reset
      </a>
    </form>
  </div>

  <!-- Table -->
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <table class="min-w-full divide-y divide-gray-300">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col"
              class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">User</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Contact</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
          <th scope="col"
              class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Joined</th>
          <th scope="col"
              class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 bg-white">
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
            <div class="flex items-center">
              <div class="h-10 w-10 flex-shrink-0">
                <img class="h-10 w-10 rounded-full"
                     src="<?php echo e($user->avatar_url); ?>"
                     alt="">
              </div>
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></div>
                <div class="text-sm text-gray-500"><?php echo e($user->email); ?></div>
              </div>
            </div>
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <?php echo e($user->phone ?? '-'); ?>

          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
              <?php echo e(ucfirst($user->roles->first()->name ?? 'No Role')); ?>

            </span>
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm">
            <span
                  class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($user->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
              <?php echo e($user->is_active ? 'Active' : 'Inactive'); ?>

            </span>
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <?php echo e($user->created_at->format('M j, Y')); ?>

          </td>
          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
            <div class="flex items-center justify-end gap-2">
              <a href="<?php echo e(route('users.show', $user)); ?>"
                 class="text-primary-600 hover:text-primary-900">View</a>
              <a href="<?php echo e(route('users.edit', $user)); ?>"
                 class="text-primary-600 hover:text-primary-900">Edit</a>
              <?php if($user->id !== auth()->id()): ?>
              <form method="POST"
                    action="<?php echo e(route('users.toggle-status', $user)); ?>"
                    class="inline">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <button type="submit"
                        class="text-yellow-600 hover:text-yellow-900">
                  <?php echo e($user->is_active ? 'Deactivate' : 'Activate'); ?>

                </button>
              </form>
              <form method="POST"
                    action="<?php echo e(route('users.destroy', $user)); ?>"
                    class="inline"
                    onsubmit="return confirm('Are you sure?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit"
                        class="text-red-600 hover:text-red-900">Delete</button>
              </form>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="6"
              class="px-6 py-12 text-center text-sm text-gray-500">No users found.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <?php if($users->hasPages()): ?>
    <div class="border-t border-gray-200 px-4 py-3 sm:px-6"><?php echo e($users->links()); ?></div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/users/index.blade.php ENDPATH**/ ?>