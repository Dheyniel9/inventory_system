{{-- Reusable Filter Form Component --}}
<style>
  .filter-container {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
  }

  .filter-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    align-items: flex-end;
  }

  .filter-group {
    display: flex;
    flex-direction: column;
  }

  .filter-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.25rem;
  }

  .filter-input,
  .filter-select {
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    background: white;
  }

  .filter-input:focus,
  .filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .filter-buttons {
    display: flex;
    align-items: flex-end;
    gap: 0.5rem;
  }

  .filter-button {
    padding: 0.5rem 0.75rem;
    border: none;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .filter-button.primary {
    background-color: #3b82f6;
    color: white;
  }

  .filter-button.primary:hover {
    background-color: #2563eb;
  }

  .filter-button.secondary {
    background-color: #f3f4f6;
    color: #4b5563;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .filter-button.secondary:hover {
    background-color: #e5e7eb;
  }

  @media (max-width: 768px) {
    .filter-form {
      grid-template-columns: 1fr;
    }

    .filter-buttons {
      grid-column: 1 / -1;
    }
  }
</style>

<div class="filter-container">
  <form method="GET"
        class="filter-form"
        action="{{ $action ?? '#' }}">
    @foreach($fields as $field)
    <div class="filter-group">
      <label for="{{ $field['name'] }}"
             class="filter-label">
        {{ $field['label'] ?? ucfirst($field['name']) }}
      </label>

      @if($field['type'] === 'select')
      <select name="{{ $field['name'] }}"
              id="{{ $field['name'] }}"
              class="filter-select">
        <option value="">{{ $field['placeholder'] ?? 'Select...' }}</option>
        @foreach($field['options'] ?? [] as $value => $label)
        <option value="{{ $value }}"
                @if(request($field['name'])==$value)
                selected
                @endif>
          {{ $label }}
        </option>
        @endforeach
      </select>
      @elseif($field['type'] === 'date')
      <input type="date"
             name="{{ $field['name'] }}"
             id="{{ $field['name'] }}"
             value="{{ request($field['name']) }}"
             class="filter-input">
      @elseif($field['type'] === 'number')
      <input type="number"
             name="{{ $field['name'] }}"
             id="{{ $field['name'] }}"
             value="{{ request($field['name']) }}"
             placeholder="{{ $field['placeholder'] ?? '' }}"
             class="filter-input">
      @else
      <input type="text"
             name="{{ $field['name'] }}"
             id="{{ $field['name'] }}"
             value="{{ request($field['name']) }}"
             placeholder="{{ $field['placeholder'] ?? '' }}"
             class="filter-input">
      @endif
    </div>
    @endforeach

    <div class="filter-buttons">
      <button type="submit"
              class="filter-button primary">
        {{ $submitLabel ?? 'Filter' }}
      </button>
      @if($resetUrl ?? false)
      <a href="{{ $resetUrl }}"
         class="filter-button secondary">
        {{ $resetLabel ?? 'Reset' }}
      </a>
      @endif
    </div>
  </form>
</div>
