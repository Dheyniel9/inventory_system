{{-- Reusable Input Table Button Component (for quantity controls, etc.) --}}
<style>
  .input-table-button {
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background: white;
    color: #4b5563;
    cursor: pointer;
    transition: all 0.2s;
    padding: 0;
  }

  .input-table-button:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
  }

  .input-table-button:active {
    transform: scale(0.95);
  }

  .input-table-button svg {
    width: 1rem;
    height: 1rem;
  }

  .input-table-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }
</style>

<button type="button"
        class="input-table-button {{ $class ?? '' }}"
        @if($disabled
        ??
        false)
        disabled
        @endif
        @if($click)
        @click="{{ $click }}"
        @endif>
  <svg fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor">
    {!! $icon !!}
  </svg>
</button>
