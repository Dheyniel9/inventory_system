<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .categories-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .categories-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .categories-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #111827;
    }

    .categories-subtitle {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        border-radius: 0.375rem;
        background-color: #2563eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        text-decoration: none;
        margin-top: 1rem;
    }

    .btn-add:hover {
        background-color: #1d4ed8;
    }

    .btn-add svg {
        margin-right: 0.375rem;
        margin-left: -0.125rem;
        height: 1.25rem;
        width: 1.25rem;
    }

    .search-box {
        border-radius: 0.5rem;
        background-color: #ffffff;
        padding: 1rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .search-form {
        display: flex;
        gap: 1rem;
    }

    .search-input-wrapper {
        flex: 1;
    }

    .search-input {
        display: block;
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 0.5rem;
    }

    .search-input:focus {
        border-color: #3b82f6;
        outline: none;
    }

    .btn-search {
        display: inline-flex;
        align-items: center;
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

    .btn-search:hover {
        background-color: #1d4ed8;
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        border-radius: 0.375rem;
        background-color: #f3f4f6;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        text-decoration: none;
    }

    .btn-reset:hover {
        background-color: #e5e7eb;
    }

    .table-wrapper {
        overflow: hidden;
        border-radius: 0.5rem;
        background-color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .categories-table {
        min-width: 100%;
        border-collapse: collapse;
    }

    .categories-table thead {
        background-color: #f9fafb;
    }

    .categories-table th {
        padding: 0.875rem 0.75rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
    }

    .categories-table th:first-child {
        padding-left: 1rem;
    }

    .categories-table th:last-child {
        padding-right: 1rem;
        text-align: right;
    }

    .categories-table tbody {
        background-color: #ffffff;
    }

    .categories-table tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .categories-table td {
        white-space: nowrap;
        padding: 1rem 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .categories-table td:first-child {
        padding-left: 1rem;
        font-weight: 500;
        color: #111827;
    }

    .categories-table td:last-child {
        padding-right: 1rem;
        text-align: right;
    }

    .category-description {
        font-size: 0.75rem;
        color: #6b7280;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 20rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 9999px;
        padding: 0.125rem 0.625rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-active {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-inactive {
        background-color: #f3f4f6;
        color: #1f2937;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .btn-edit {
        color: #2563eb;
        text-decoration: none;
    }

    .btn-edit:hover {
        color: #1e40af;
    }

    .btn-delete {
        color: #dc2626;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 0.875rem;
    }

    .btn-delete:hover {
        color: #991b1b;
    }

    .delete-form {
        display: inline;
    }

    .empty-state {
        padding: 3rem 1.5rem;
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .pagination-wrapper {
        border-top: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
    }
</style>

<div class="categories-container">
    <div class="categories-header">
        <div>
            <h1 class="categories-title">Categories</h1>
            <p class="categories-subtitle">Organize your products with categories</p>
        </div>
        <div>
            <a href="<?php echo e(route('categories.create')); ?>"
               class="btn-add">
                <svg viewBox="0 0 20 20"
                     fill="currentColor">
                    <path
                          d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                Add Category
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="search-box">
        <form method="GET"
              class="search-form">
            <div class="search-input-wrapper">
                <input type="text"
                       name="search"
                       value="<?php echo e(request('search')); ?>"
                       placeholder="Search categories..."
                       class="search-input">
            </div>
            <button type="submit"
                    class="btn-search">
                Search
            </button>
            <a href="<?php echo e(route('categories.index')); ?>"
               class="btn-reset">
                Reset
            </a>
        </form>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table class="categories-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Products</th>
                    <th scope="col">Status</th>
                    <th scope="col"><span style="visibility: hidden;">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <?php echo e($category->name); ?>

                        <?php if($category->description): ?>
                        <p class="category-description"><?php echo e($category->description); ?></p>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($category->parent?->name ?? '-'); ?></td>
                    <td><?php echo e($category->products_count); ?></td>
                    <td>
                        <span class="status-badge <?php echo e($category->is_active ? 'status-active' : 'status-inactive'); ?>">
                            <?php echo e($category->is_active ? 'Active' : 'Inactive'); ?>

                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="<?php echo e(route('categories.edit', $category)); ?>"
                               class="btn-edit">Edit</a>
                            <form method="POST"
                                  action="<?php echo e(route('categories.destroy', $category)); ?>"
                                  class="delete-form"
                                  onsubmit="return confirm('Are you sure?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5"
                        class="empty-state">No categories found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if($categories->hasPages()): ?>
        <div class="pagination-wrapper"><?php echo e($categories->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/categories/index.blade.php ENDPATH**/ ?>