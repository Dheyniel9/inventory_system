{{-- Reusable Button Component --}}
@php
$classes = match($variant ?? 'primary') {
'primary' => 'button-primary',
'secondary' => 'button-secondary',
'danger' => 'button-danger',
'small' => 'button-small',
'link' => 'button-link',
default => 'button-primary',
};

$sizeClasses = match($size ?? 'md') {
'sm' => 'button-sm',
'md' => 'button-md',
'lg' => 'button-lg',
default => 'button-md',
};

$type = $type ?? 'button';
$icon = $icon ?? null;
@endphp

<style>
  /* Base Button Styles */
  .button {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    border: none;
    border-radius: 0.375rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    font-size: 0.875rem;
  }

  /* Size Variants */
  .button-sm {
    padding: 0.375rem 0.625rem;
    font-size: 0.75rem;
  }

  .button-md {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
  }

  .button-lg {
    padding: 0.75rem 1rem;
    font-size: 0.9375rem;
  }

  /* Color Variants */
  .button-primary {
    background-color: #3b82f6;
    color: white;
  }

  .button-primary:hover {
    background-color: #2563eb;
  }

  .button-primary:active {
    transform: scale(0.98);
  }

  .button-primary:disabled {
    background-color: #d1d5db;
    cursor: not-allowed;
    opacity: 0.6;
  }

  .button-secondary {
    background-color: #f3f4f6;
    color: #4b5563;
  }

  .button-secondary:hover {
    background-color: #e5e7eb;
  }

  .button-secondary:disabled {
    background-color: #e5e7eb;
    cursor: not-allowed;
    opacity: 0.6;
  }

  .button-danger {
    background-color: #dc2626;
    color: white;
  }

  .button-danger:hover {
    background-color: #b91c1c;
  }

  .button-danger:disabled {
    background-color: #fca5a5;
    cursor: not-allowed;
    opacity: 0.6;
  }

  .button-link {
    background: none;
    color: #2563eb;
    padding: 0;
    font-weight: 500;
  }

  .button-link:hover {
    color: #1d4ed8;
  }

  .button-link.danger {
    color: #dc2626;
  }

  .button-link.danger:hover {
    color: #b91c1c;
  }

  .button svg {
    width: 1rem;
    height: 1rem;
  }
</style>

@if($tag ?? 'button' === 'link')
<a href="{{ $href ?? '#' }}"
   class="button {{ $classes }} {{ $sizeClasses }} {{ $class ?? '' }}"
   @if($disabled
   ??
   false)
   style="pointer-events: none; opacity: 0.6;"
   @endif>
  @if($icon)
  <svg fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor">
    {!! $icon !!}
  </svg>
  @endif
  {{ $slot }}
</a>
@else
<button type="{{ $type }}"
        class="button {{ $classes }} {{ $sizeClasses }} {{ $class ?? '' }}"
        @if($disabled
        ??
        false)
        disabled
        @endif
        @if($onclick
        ??
        false)
        onclick="{{ $onclick }}"
        @endif>
  @if($icon)
  <svg fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor">
    {!! $icon !!}
  </svg>
  @endif
  {{ $slot }}
</button>
@endif
