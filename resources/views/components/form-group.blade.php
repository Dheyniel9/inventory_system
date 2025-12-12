{{-- Reusable Form Group Component --}}
<style>
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
    margin-bottom: 1rem;
  }

  .form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
  }

  .form-label.required::after {
    content: ' *';
    color: #dc2626;
  }

  .form-input,
  .form-select,
  .form-textarea {
    padding: 0.625rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-family: inherit;
    transition: all 0.2s;
  }

  .form-input:focus,
  .form-select:focus,
  .form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .form-textarea {
    resize: vertical;
    min-height: 6rem;
  }

  .form-help {
    font-size: 0.8125rem;
    color: #6b7280;
    margin-top: 0.25rem;
  }

  .form-error {
    font-size: 0.8125rem;
    color: #dc2626;
    margin-top: 0.25rem;
  }

  .form-input.error,
  .form-select.error,
  .form-textarea.error {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
  }
</style>

<div class="form-group">
  @if($label ?? false)
  <label for="{{ $name }}"
         class="form-label {{ $required ?? false ? 'required' : '' }}">
    {{ $label }}
  </label>
  @endif

  @if($type === 'select')
  <select name="{{ $name }}"
          id="{{ $name }}"
          class="form-input {{ $error ?? false ? 'error' : '' }}"
          @if($required
          ??
          false)
          required
          @endif
          @if($disabled
          ??
          false)
          disabled
          @endif>
    @foreach($options ?? [] as $value => $text)
    <option value="{{ $value }}"
            @if($value===($selected
            ??
            null))
            selected
            @endif>
      {{ $text }}
    </option>
    @endforeach
  </select>
  @elseif($type === 'textarea')
  <textarea name="{{ $name }}"
            id="{{ $name }}"
            class="form-input {{ $error ?? false ? 'error' : '' }}"
            @if($required
            ??
            false)
            required
            @endif
            @if($disabled
            ??
            false)
            disabled
            @endif
            placeholder="{{ $placeholder ?? '' }}">{{ $value ?? '' }}</textarea>
  @else
  <input type="{{ $type ?? 'text' }}"
         name="{{ $name }}"
         id="{{ $name }}"
         class="form-input {{ $error ?? false ? 'error' : '' }}"
         value="{{ $value ?? '' }}"
         placeholder="{{ $placeholder ?? '' }}"
         @if($required
         ??
         false)
         required
         @endif
         @if($disabled
         ??
         false)
         disabled
         @endif>
  @endif

  @if($help ?? false)
  <span class="form-help">{{ $help }}</span>
  @endif

  @if($error ?? false)
  <span class="form-error">{{ $error }}</span>
  @endif
</div>
