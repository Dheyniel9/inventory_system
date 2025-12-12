

<?php $__env->startSection('title', 'Suppliers'); ?>

<?php $__env->startSection('css'); ?>
<style>
  /* Reset and Override Global Styles */
  .suppliers-page {
    background-color: #f8fafc;
    min-height: 100vh;
  }

  .suppliers-page * {
    box-sizing: border-box;
  }

  /* Layout Container */
  .suppliers-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
  }

  /* Modern Header Section */
  .suppliers-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
  }

  .suppliers-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
  }

  .suppliers-header-text {
    flex: 1;
  }

  .suppliers-title {
    font-size: 2.25rem;
    font-weight: 800;
    color: white !important;
    margin: 0 0 0.5rem 0 !important;
    letter-spacing: -0.025em;
  }

  .suppliers-subtitle {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9) !important;
    margin: 0 !important;
    font-weight: 400;
  }

  .btn-add-supplier {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.875rem 1.75rem;
    background-color: white !important;
    color: #667eea !important;
    border: none !important;
    border-radius: 0.75rem;
    font-size: 0.9375rem;
    font-weight: 700;
    text-decoration: none !important;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .btn-add-supplier:hover {
    background-color: #f8f9ff !important;
    color: #5568d3 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
  }

  .btn-add-supplier svg {
    width: 0.875rem;
    height: 0.875rem;
    flex-shrink: 0;
  }

  /* Modern Filters Card */
  .filters-card {
    background: white;
    border-radius: 1rem;
    padding: 1.75rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid #e8eaed;
  }

  .filters-grid {
    display: grid;
    gap: 1.25rem;
    align-items: end;
  }

  @media (min-width: 768px) {
    .filters-grid {
      grid-template-columns: 2.5fr 1.25fr 1.25fr 1.25fr auto;
    }
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .form-label {
    font-size: 0.8125rem;
    font-weight: 600;
    color: #4b5563 !important;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    margin: 0 !important;
  }

  .form-input,
  .form-select {
    width: 100% !important;
    padding: 0.75rem 1rem !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    font-size: 0.9375rem !important;
    transition: all 0.25s ease !important;
    background-color: white !important;
    color: #1f2937 !important;
    font-family: inherit !important;
  }

  .form-input:focus,
  .form-select:focus {
    outline: none !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1) !important;
    background-color: #fefeff !important;
  }

  .form-input::placeholder {
    color: #9ca3af !important;
    font-weight: 400;
  }

  .filter-actions {
    display: flex;
    gap: 0.75rem;
  }

  .btn-filter {
    padding: 0.75rem 1.5rem !important;
    border: none !important;
    border-radius: 0.75rem !important;
    font-size: 0.9375rem !important;
    font-weight: 600 !important;
    cursor: pointer;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
  }

  .btn-filter-primary {
    background-color: #667eea !important;
    color: white !important;
  }

  .btn-filter-primary:hover {
    background-color: #5568d3 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
  }

  .btn-filter-secondary {
    background-color: #f3f4f6 !important;
    color: #4b5563 !important;
    display: inline-flex !important;
    align-items: center;
  }

  .btn-filter-secondary:hover {
    background-color: #e5e7eb !important;
    color: #1f2937 !important;
  }

  .btn-filter-secondary:hover {
    background-color: #e5e7eb !important;
    color: #1f2937 !important;
  }

  /* Modern Table Card */
  .table-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    border: 1px solid #e8eaed;
  }

  .table-responsive {
    overflow-x: auto;
  }

  .data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }

  .data-table thead {
    background: linear-gradient(180deg, #f9fafb 0%, #f3f4f6 100%);
  }

  .data-table th {
    padding: 1.125rem 1.5rem !important;
    text-align: left !important;
    font-size: 0.8125rem !important;
    font-weight: 700 !important;
    color: #4b5563 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.06em !important;
    border-bottom: 2px solid #e5e7eb !important;
    background: transparent !important;
  }

  .data-table th:last-child {
    text-align: right !important;
  }

  .data-table tbody tr {
    border-bottom: 1px solid #f3f4f6 !important;
    transition: all 0.2s ease !important;
  }

  .data-table tbody tr:hover {
    background-color: #f8f9ff !important;
    transform: scale(1.001);
  }

  .data-table tbody tr:last-child {
    border-bottom: none !important;
  }

  .data-table td {
    padding: 1.375rem 1.5rem !important;
    font-size: 0.9375rem !important;
    color: #111827 !important;
    vertical-align: middle !important;
    border-bottom: none !important;
  }

  .data-table td:last-child {
    text-align: right !important;
  }

  /* Table Cell Content */
  .supplier-name {
    font-weight: 700 !important;
    color: #1f2937 !important;
    margin: 0 0 0.375rem 0 !important;
    font-size: 1rem !important;
  }

  .supplier-address {
    font-size: 0.875rem !important;
    color: #6b7280 !important;
    line-height: 1.6 !important;
    margin: 0 !important;
  }

  .contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
  }

  .contact-email {
    color: #667eea !important;
    text-decoration: none !important;
    font-weight: 500;
    transition: all 0.2s ease;
  }

  .contact-email:hover {
    color: #5568d3 !important;
    text-decoration: underline !important;
  }

  .contact-phone {
    color: #4b5563 !important;
    font-size: 0.9375rem;
  }

  .status-badge {
    display: inline-flex !important;
    align-items: center;
    padding: 0.5rem 1rem !important;
    border-radius: 0.625rem !important;
    font-size: 0.8125rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.025em;
  }

  .status-active {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
    color: #065f46 !important;
    border: 1px solid #86efac;
  }

  .status-inactive {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
    color: #991b1b !important;
    border: 1px solid #fca5a5;
  }

  .table-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 1.125rem;
  }

  .action-link,
  .action-button {
    font-size: 0.9375rem !important;
    font-weight: 600 !important;
    cursor: pointer;
    transition: all 0.2s ease !important;
    background: none !important;
    border: none !important;
    padding: 0 !important;
    text-decoration: none !important;
  }

  .action-link {
    color: #667eea !important;
  }

  .action-link:hover {
    color: #5568d3 !important;
    text-decoration: underline !important;
  }

  .action-toggle {
    color: #f59e0b !important;
  }

  .action-toggle:hover {
    color: #d97706 !important;
  }

  .action-delete {
    color: #dc2626 !important;
  }

  .action-delete:hover {
    color: #b91c1c !important;
  }

  .action-delete:hover {
    color: #b91c1c !important;
  }

  /* Modern Empty State */
  .empty-state {
    padding: 5rem 2rem;
    text-align: center;
  }

  .empty-icon {
    width: 5rem;
    height: 5rem;
    margin: 0 auto 1.75rem;
    color: #cbd5e1;
  }

  .empty-title {
    font-size: 1.375rem !important;
    font-weight: 700 !important;
    color: #1f2937 !important;
    margin: 0 0 0.75rem 0 !important;
  }

  .empty-text {
    font-size: 1rem !important;
    color: #6b7280 !important;
    margin: 0 !important;
    line-height: 1.6;
  }

  /* Pagination */
  .table-pagination {
    padding: 1.5rem;
    border-top: 2px solid #f3f4f6;
    background-color: #fafbfc;
  }

  .text-muted {
    color: #9ca3af !important;
  }

  /* Stats Badges (optional enhancement) */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
  }

  .stat-card {
    background: white;
    border-radius: 0.875rem;
    padding: 1.25rem;
    border: 1px solid #e8eaed;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  .stat-label {
    font-size: 0.8125rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
  }

  .stat-value {
    font-size: 1.875rem;
    font-weight: 800;
    color: #1f2937;
  }

  /* Responsive Design */
  @media (max-width: 767px) {
    .suppliers-container {
      padding: 1rem;
    }

    .suppliers-header {
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .suppliers-header-content {
      flex-direction: column;
      align-items: stretch;
    }

    .suppliers-title {
      font-size: 1.75rem !important;
    }

    .btn-add-supplier {
      justify-content: center;
      width: 100%;
    }

    .filters-grid {
      grid-template-columns: 1fr;
    }

    .filter-actions {
      flex-direction: column;
    }

    .btn-filter {
      width: 100%;
    }

    .data-table th,
    .data-table td {
      padding: 0.875rem 1rem !important;
      font-size: 0.875rem !important;
    }

    .table-actions {
      flex-direction: column;
      align-items: flex-end;
      gap: 0.75rem;
    }

    .empty-state {
      padding: 3rem 1.5rem;
    }
  }

  @media (max-width: 1024px) {
    .filters-grid {
      grid-template-columns: 1fr 1fr;
    }

    .form-group:nth-child(5) {
      grid-column: 1 / -1;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="suppliers-page">
  <div class="suppliers-container">

    <!-- Modern Page Header -->
    <header class="suppliers-header">
      <div class="suppliers-header-content">
        <div class="suppliers-header-text">
          <h1 class="suppliers-title">Suppliers Management</h1>
          <p class="suppliers-subtitle">Manage your business suppliers and vendor relationships efficiently</p>
        </div>
        <a href="<?php echo e(route('suppliers.create')); ?>"
           class="btn-add-supplier">
          <i class="bi bi-plus-circle"></i>
          Add New Supplier
        </a>
      </div>
    </header>

    </header>

    <!-- Search Filters -->
    <section class="filters-card">
      <form method="GET"
            class="filters-grid">

        <div class="form-group">
          <label class="form-label">🔍 Search</label>
          <input type="text"
                 name="search"
                 value="<?php echo e(request('search')); ?>"
                 placeholder="Search by name, email, or phone..."
                 class="form-input">
        </div>

        <div class="form-group">
          <label class="form-label">📊 Status</label>
          <select name="is_active"
                  class="form-select">
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

        <div class="form-group">
          <label class="form-label">🏙️ City</label>
          <input type="text"
                 name="city"
                 value="<?php echo e(request('city')); ?>"
                 placeholder="Filter by city"
                 class="form-input">
        </div>

        <div class="form-group">
          <label class="form-label">🌍 Country</label>
          <input type="text"
                 name="country"
                 value="<?php echo e(request('country')); ?>"
                 placeholder="Filter by country"
                 class="form-input">
        </div>

        <div class="filter-actions">
          <button type="submit"
                  class="btn-filter btn-filter-primary">
            Apply Filters
          </button>
          <a href="<?php echo e(route('suppliers.index')); ?>"
             class="btn-filter btn-filter-secondary">
            Reset All
          </a>
        </div>

      </form>
    </section>

    </section>

    <!-- Suppliers Table -->
    <section class="table-card">
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>Supplier Info</th>
              <th>Contact Details</th>
              <th>Location</th>
              <th>Contact Person</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td>
                <div class="supplier-name"><?php echo e($supplier->name); ?></div>
                <?php if($supplier->address): ?>
                <div class="supplier-address"><?php echo e($supplier->address); ?></div>
                <?php endif; ?>
              </td>

              <td>
                <div class="contact-info">
                  <?php if($supplier->email): ?>
                  <a href="mailto:<?php echo e($supplier->email); ?>"
                     class="contact-email">
                    📧 <?php echo e($supplier->email); ?>

                  </a>
                  <?php endif; ?>
                  <?php if($supplier->phone): ?>
                  <span class="contact-phone">📱 <?php echo e($supplier->phone); ?></span>
                  <?php endif; ?>
                  <?php if(!$supplier->email && !$supplier->phone): ?>
                  <span class="text-muted">No contact info</span>
                  <?php endif; ?>
                </div>
              </td>

              <td>
                <?php if($supplier->city || $supplier->country): ?>
                <span style="font-weight: 500;"><?php echo e(collect([$supplier->city, $supplier->country])->filter()->implode(',
                  ')); ?></span>
                <?php else: ?>
                <span class="text-muted">—</span>
                <?php endif; ?>
              </td>

              <td>
                <span style="font-weight: 500;"><?php echo e($supplier->contact_person ?? '—'); ?></span>
              </td>

              <td>
                <span class="status-badge <?php echo e($supplier->is_active ? 'status-active' : 'status-inactive'); ?>">
                  <?php echo e($supplier->is_active ? '✓ Active' : '✗ Inactive'); ?>

                </span>
              </td>

              <td>
                <div class="table-actions">
                  <a href="<?php echo e(route('suppliers.show', $supplier)); ?>"
                     class="action-link">
                    View
                  </a>
                  <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>"
                     class="action-link">
                    Edit
                  </a>

                  <form method="POST"
                        action="<?php echo e(route('suppliers.toggle-status', $supplier)); ?>"
                        style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit"
                            class="action-button action-toggle">
                      <?php echo e($supplier->is_active ? 'Deactivate' : 'Activate'); ?>

                    </button>
                  </form>

                  <form method="POST"
                        action="<?php echo e(route('suppliers.destroy', $supplier)); ?>"
                        style="display: inline;"
                        onsubmit="return confirm('⚠️ Are you sure you want to delete this supplier? This action cannot be undone.')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                            class="action-button action-delete">
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="6">
                <div class="empty-state">
                  <i class="bi bi-inbox empty-icon"></i>
                  <div class="empty-title">No Suppliers Found</div>
                  <p class="empty-text">
                    There are no suppliers matching your criteria. Try adjusting your filters or create a new supplier
                    to get started.
                  </p>
                </div>
              </td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <?php if($suppliers->hasPages()): ?>
      <div class="table-pagination">
        <?php echo e($suppliers->links()); ?>

      </div>
      <?php endif; ?>
    </section>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\cnucum_projects\inventory-system\resources\views/suppliers/index.blade.php ENDPATH**/ ?>