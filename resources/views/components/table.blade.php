{{-- Reusable Table Component --}}
<style>
  .table-container {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .table-wrapper {
    overflow-x: auto;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
  }

  .data-table thead {
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
  }

  .data-table thead tr {
    height: auto;
  }

  .data-table th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    vertical-align: middle;
  }

  .data-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: background-color 0.2s;
  }

  .data-table tbody tr:hover {
    background-color: #f9fafb;
  }

  .data-table tbody tr.cancelled {
    opacity: 0.6;
    background-color: #fef2f2;
  }

  .data-table td {
    padding: 1rem 1.5rem;
    font-size: 0.875rem;
    color: #111827;
  }

  .table-empty {
    padding: 3rem 1.5rem;
    text-align: center;
    color: #6b7280;
  }

  .table-pagination {
    padding: 1rem;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: center;
  }

  .table-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
  }

  .table-link {
    color: #2563eb;
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s;
  }

  .table-link:hover {
    color: #1d4ed8;
  }

  .table-link.danger {
    color: #dc2626;
  }

  .table-link.danger:hover {
    color: #b91c1c;
  }

  .table-highlight {
    color: #3b82f6;
    font-weight: 500;
  }

  .table-secondary {
    color: #6b7280;
    font-size: 0.8125rem;
  }

  @media (max-width: 768px) {
    .data-table {
      font-size: 0.75rem;
    }

    .data-table th,
    .data-table td {
      padding: 0.5rem;
    }
  }
</style>

<div class="table-container">
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr>
          @foreach($headers as $header)
          <th scope="col">
            @if(is_array($header))
            {{ $header['label'] ?? '' }}
            @else
            {{ $header }}
            @endif
          </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $row)
        <tr class="{{ $row['class'] ?? '' }}">
          @foreach($headers as $key => $header)
          <td>
            @if(is_array($header) && isset($header['render']))
            {!! $header['render']($row) !!}
            @else
            @if(is_array($row))
            {{ $row[$key] ?? '' }}
            @else
            {{ $row->{$key} ?? '' }}
            @endif
            @endif
          </td>
          @endforeach
        </tr>
        @empty
        <tr>
          <td colspan="{{ count($headers) }}"
              class="table-empty">
            {{ $emptyMessage ?? 'No records found.' }}
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($pagination ?? false)
  <div class="table-pagination">
    {{ $pagination }}
  </div>
  @endif
</div>
