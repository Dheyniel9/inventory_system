{{-- Reusable Status Badge Component --}}
<style>
  .status-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.8125rem;
    font-weight: 500;
  }

  .status-badge.paid {
    background-color: #d1fae5;
    color: #065f46;
  }

  .status-badge.pending {
    background-color: #fef3c7;
    color: #92400e;
  }

  .status-badge.cancelled {
    background-color: #fee2e2;
    color: #991b1b;
  }

  .status-badge.active {
    background-color: #dbeafe;
    color: #1e40af;
  }

  .status-badge.inactive {
    background-color: #e5e7eb;
    color: #374151;
  }

  .status-badge.warning {
    background-color: #fed7aa;
    color: #92400e;
  }

  .status-badge.success {
    background-color: #d1fae5;
    color: #065f46;
  }

  .status-badge.error {
    background-color: #fee2e2;
    color: #991b1b;
  }
</style>

<span class="status-badge {{ $type ?? 'default' }}">
  {{ $slot }}
</span>
