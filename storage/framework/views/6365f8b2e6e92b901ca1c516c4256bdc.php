

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('css'); ?>
<style>
  .user-container {
    padding: 24px;
    max-width: 1400px;
    margin: 0 auto;
  }

  .user-filters {
    background: white;
    padding: 24px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
  }

  .user-filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: center;
  }

  .user-search-wrapper {
    flex: 1;
    min-width: 250px;
  }

  .user-filter-input,
  .user-filter-select {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    width: 100%;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .user-filter-input:focus,
  .user-filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .user-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
    text-decoration: none;
  }

  .user-filter-submit {
    background-color: #3b82f6;
    color: white;
  }

  .user-filter-submit:hover {
    background-color: #2563eb;
    color: white;
  }

  .user-filter-reset {
    background-color: #f3f4f6;
    color: #4b5563;
  }

  .user-filter-reset:hover {
    background-color: #e5e7eb;
    color: #4b5563;
    text-decoration: none;
  }

  .user-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background-color: #3b82f6;
    color: white;
    border-radius: 6px;
    border: none;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.2s;
    margin-left: auto;
  }

  .user-add-btn:hover {
    background-color: #2563eb;
    color: white;
    text-decoration: none;
  }

  .user-table-container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .user-table {
    width: 100%;
    margin-bottom: 0;
    background-color: white;
    border-collapse: collapse;
  }

  .user-table thead {
    background-color: #f9fafb;
  }

  .user-table thead th {
    font-weight: 600;
    color: #374151;
    font-size: 14px;
    padding: 16px;
    border-bottom: 2px solid #e5e7eb;
    text-align: left;
  }

  .user-table thead th.text-end {
    text-align: right;
  }

  .user-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: background-color 0.15s;
  }

  .user-table tbody tr:hover {
    background-color: #f9fafb;
  }

  .user-table tbody tr:last-child {
    border-bottom: none;
  }

  .user-table tbody td {
    padding: 16px;
    font-size: 14px;
    color: #4b5563;
    vertical-align: middle;
  }

  .d-flex {
    display: flex;
  }

  .align-items-center {
    align-items: center;
  }

  .d-inline {
    display: inline;
  }

  .text-end {
    text-align: right;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }

  .user-info {
    margin-left: 12px;
  }

  .user-name {
    font-weight: 500;
    color: #111827;
    margin-bottom: 2px;
  }

  .user-email {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
  }

  .badge {
    display: inline-block;
    padding: 4px 12px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 9999px;
    line-height: 1.5;
  }

  .bg-primary {
    background-color: #3b82f6;
    color: white;
  }

  .bg-success {
    background-color: #10b981;
    color: white;
  }

  .bg-secondary {
    background-color: #6b7280;
    color: white;
  }

  .action-links {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    align-items: center;
  }

  .action-link {
    font-size: 14px;
    text-decoration: none;
    font-weight: 500;
  }

  .text-primary {
    color: #3b82f6;
  }

  .text-primary:hover {
    color: #2563eb;
    text-decoration: underline;
  }

  .action-btn {
    padding: 0;
    font-size: 14px;
    font-weight: 500;
    border: none;
    background: none;
    cursor: pointer;
    text-decoration: none;
  }

  .text-warning {
    color: #f59e0b;
  }

  .text-warning:hover {
    color: #d97706;
    text-decoration: underline;
  }

  .text-danger {
    color: #ef4444;
  }

  .text-danger:hover {
    color: #dc2626;
    text-decoration: underline;
  }

  .empty-state {
    padding: 48px 16px;
    text-align: center;
    color: #6b7280;
  }

  .pagination-wrapper {
    padding: 16px 24px;
    border-top: 1px solid #e5e7eb;
    background-color: #f9fafb;
  }

  @media (max-width: 768px) {
    .user-container {
      padding: 16px;
    }

    .user-filters {
      padding: 16px;
    }

    .user-filter-form {
      flex-direction: column;
      gap: 12px;
    }

    .user-search-wrapper,
    .user-filter-select,
    .user-filter-btn,
    .user-add-btn {
      width: 100%;
    }

    .user-add-btn {
      margin-left: 0;
    }

    .user-table thead th,
    .user-table tbody td {
      padding: 12px 8px;
      font-size: 12px;
    }

    .user-avatar {
      width: 32px;
      height: 32px;
    }

    .user-info {
      margin-left: 8px;
    }

    .action-links {
      flex-direction: column;
      gap: 8px;
      align-items: flex-start;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="user-container">
  <div class="user-filters">
    <form method="GET"
          class="user-filter-form">
      <div class="user-search-wrapper">
        <input type="text"
               name="search"
               value="<?php echo e(request('search')); ?>"
               placeholder="🔍 Search users..."
               class="user-filter-input">
      </div>

      <div>
        <select name="is_active"
                class="user-filter-select">
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
                class="user-filter-select">
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
              class="user-filter-btn user-filter-submit">
        Search
      </button>

      <a href="<?php echo e(route('users.index')); ?>"
         class="user-filter-btn user-filter-reset">
        Reset
      </a>

      <a href="<?php echo e(route('users.create')); ?>"
         class="user-add-btn">
        <i class="bi bi-plus-circle"></i>
        Add User
      </a>
    </form>
  </div>

  <div class="user-table-container">
    <table class="user-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Contact</th>
          <th>Role</th>
          <th>Status</th>
          <th>Joined</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="<?php echo e($user->avatar_url); ?>"
                   alt="<?php echo e($user->name); ?>"
                   class="user-avatar">
              <div class="user-info">
                <div class="user-name"><?php echo e($user->name); ?></div>
                <div class="user-email"><?php echo e($user->email); ?></div>
              </div>
            </div>
          </td>
          <td><?php echo e($user->phone ?? '-'); ?></td>
          <td>
            <span class="badge bg-primary">
              <?php echo e(ucfirst($user->roles->first()->name ?? 'No Role')); ?>

            </span>
          </td>
          <td>
            <span class="badge <?php echo e($user->is_active ? 'bg-success' : 'bg-secondary'); ?>">
              <?php echo e($user->is_active ? 'Active' : 'Inactive'); ?>

            </span>
          </td>
          <td><?php echo e($user->created_at->format('M j, Y')); ?></td>
          <td>
            <div class="action-links">
              <a href="<?php echo e(route('users.show', $user)); ?>"
                 class="action-link text-primary">
                View
              </a>
              <a href="<?php echo e(route('users.edit', $user)); ?>"
                 class="action-link text-primary">
                Edit
              </a>
              <?php if($user->id !== auth()->id()): ?>
              <form method="POST"
                    action="<?php echo e(route('users.toggle-status', $user)); ?>"
                    class="d-inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit"
                        class="action-btn text-warning">
                  <?php echo e($user->is_active ? 'Deactivate' : 'Activate'); ?>

                </button>
              </form>
              <form method="POST"
                    action="<?php echo e(route('users.destroy', $user)); ?>"
                    class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit"
                        class="action-btn text-danger">
                  Delete
                </button>
              </form>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="6"
              class="empty-state">
            No users found.
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?php if($users->hasPages()): ?>
    <div class="pagination-wrapper">
      <?php echo e($users->links()); ?>

    </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/users/index.blade.php ENDPATH**/ ?>