@extends('layouts.app')

@section('title', 'Supplier Details')

@section('css')
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

  .supplier-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .supplier-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    border: none;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.2s;
  }

  .supplier-btn-primary {
    background-color: #3b82f6;
    color: white;
  }

  .supplier-btn-primary:hover {
    background-color: #2563eb;
  }

  .supplier-btn-secondary {
    background-color: white;
    color: #111827;
    border: 1px solid #d1d5db;
  }

  .supplier-btn-secondary:hover {
    background-color: #f9fafb;
  }

  .supplier-info-card {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
  }

  .supplier-info-title {
    font-size: 1rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 1rem;
  }

  .supplier-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
  }

  .supplier-info-item {
    display: flex;
    flex-direction: column;
  }

  .supplier-info-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
    margin-bottom: 0.25rem;
  }

  .supplier-info-value {
    font-size: 0.875rem;
    color: #111827;
  }

  .supplier-info-link {
    color: #2563eb;
    text-decoration: none;
  }

  .supplier-info-link:hover {
    color: #1d4ed8;
  }

  .supplier-status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
  }

  .supplier-status-active {
    background-color: #dcfce7;
    color: #166534;
  }

  .supplier-status-inactive {
    background-color: #f3f4f6;
    color: #4b5563;
  }

  .supplier-products-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
  }

  .supplier-products-table thead {
    background-color: #f9fafb;
  }

  .supplier-products-table th {
    padding: 0.75rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 600;
    color: #111827;
    border-bottom: 1px solid #e5e7eb;
  }

  .supplier-products-table td {
    padding: 0.75rem;
    border-bottom: 1px solid #e5e7eb;
    font-size: 0.875rem;
    color: #4b5563;
  }

  .supplier-products-table tbody tr:hover {
    background-color: #f9fafb;
  }

  .supplier-empty-state {
    padding: 2rem;
    text-align: center;
    color: #6b7280;
  }

  @media (max-width: 768px) {
    .supplier-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .supplier-actions {
      flex-direction: column;
      width: 100%;
    }

    .supplier-actions .supplier-btn {
      width: 100%;
    }

    .supplier-info-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')
<div class="supplier-container">
  <div class="supplier-header">
    <div class="supplier-title">
      <h1>{{ $supplier->name }}</h1>
      <p>Supplier details and information</p>
    </div>
    <div class="supplier-actions">
      <a href="{{ route('suppliers.edit', $supplier) }}"
         class="supplier-btn supplier-btn-primary">
        <i class="bi bi-pencil-square"></i>
        Edit
      </a>
      <a href="{{ route('suppliers.index') }}"
         class="supplier-btn supplier-btn-secondary">← Back</a>
    </div>
  </div>

  <!-- Supplier Information -->
  <div class="supplier-info-card">
    <h3 class="supplier-info-title">Supplier Information</h3>
    <div class="supplier-info-grid">
      <div class="supplier-info-item">
        <dt class="supplier-info-label">Name</dt>
        <dd class="supplier-info-value">{{ $supplier->name }}</dd>
      </div>

      <div class="supplier-info-item">
        <dt class="supplier-info-label">Status</dt>
        <dd>
          <span
                class="supplier-status-badge {{ $supplier->is_active ? 'supplier-status-active' : 'supplier-status-inactive' }}">
            {{ $supplier->is_active ? 'Active' : 'Inactive' }}
          </span>
        </dd>
      </div>

      @if($supplier->email)
      <div class="supplier-info-item">
        <dt class="supplier-info-label">Email</dt>
        <dd class="supplier-info-value">
          <a href="mailto:{{ $supplier->email }}"
             class="supplier-info-link">{{ $supplier->email }}</a>
        </dd>
      </div>
      @endif

      @if($supplier->phone)
      <div class="supplier-info-item">
        <dt class="supplier-info-label">Phone</dt>
        <dd class="supplier-info-value">
          <a href="tel:{{ $supplier->phone }}"
             class="supplier-info-link">{{ $supplier->phone }}</a>
        </dd>
      </div>
      @endif

      @if($supplier->contact_person)
      <div class="supplier-info-item">
        <dt class="supplier-info-label">Contact Person</dt>
        <dd class="supplier-info-value">{{ $supplier->contact_person }}</dd>
      </div>
      @endif

      @if($supplier->city)
      <div class="supplier-info-item">
        <dt class="supplier-info-label">City</dt>
        <dd class="supplier-info-value">{{ $supplier->city }}</dd>
      </div>
      @endif

      @if($supplier->country)
      <div class="supplier-info-item">
        <dt class="supplier-info-label">Country</dt>
        <dd class="supplier-info-value">{{ $supplier->country }}</dd>
      </div>
      @endif

      @if($supplier->address)
      <div class="supplier-info-item"
           style="grid-column: 1 / -1;">
        <dt class="supplier-info-label">Address</dt>
        <dd class="supplier-info-value">{{ $supplier->address }}</dd>
      </div>
      @endif

      <div class="supplier-info-item">
        <dt class="supplier-info-label">Created</dt>
        <dd class="supplier-info-value">{{ $supplier->created_at->format('M j, Y') }}</dd>
      </div>

      <div class="supplier-info-item">
        <dt class="supplier-info-label">Last Updated</dt>
        <dd class="supplier-info-value">{{ $supplier->updated_at->format('M j, Y') }}</dd>
      </div>
    </div>
  </div>

  <!-- Products from this Supplier (if any) -->
  @if(isset($supplier->products) && $supplier->products->count() > 0)
  <div class="supplier-info-card">
    <h3 class="supplier-info-title">Products from this Supplier</h3>
    <table class="supplier-products-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>SKU</th>
          <th>Stock</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($supplier->products as $product)
        <tr>
          <td>
            <a href="{{ route('products.show', $product) }}"
               class="supplier-table-link">{{ $product->name }}</a>
          </td>
          <td>{{ $product->sku }}</td>
          <td>{{ $product->stock_quantity }}</td>
          <td>₱{{ number_format($product->price, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif

  <!-- Actions -->
  <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
    <form method="POST"
          action="{{ route('suppliers.toggle-status', $supplier) }}"
          style="display: inline;">
      @csrf @method('PATCH')
      <button type="submit"
              style="padding: 0.5rem 0.75rem; background-color: #f59e0b; color: white; border-radius: 0.375rem; border: none; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">
        {{ $supplier->is_active ? 'Deactivate' : 'Activate' }} Supplier
      </button>
    </form>
    <form method="POST"
          action="{{ route('suppliers.destroy', $supplier) }}"
          style="display: inline;"
          onsubmit="return confirm('Are you sure you want to delete this supplier? This action cannot be undone.')">
      @csrf @method('DELETE')
      <button type="submit"
              style="padding: 0.5rem 0.75rem; background-color: #dc2626; color: white; border-radius: 0.375rem; border: none; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">Delete
        Supplier</button>
    </form>
  </div>
</div>
@endsection
