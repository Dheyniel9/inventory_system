{{-- Partial view for sales table actions --}}
{{-- This would be used by the refactored sales.blade.php --}}

<div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
  <x-button tag="link"
            href="{{ route('pos.show', $sale) }}"
            variant="link"
            size="sm">
    View
  </x-button>

  <x-button tag="link"
            href="{{ route('pos.receipt', $sale) }}"
            target="_blank"
            variant="link"
            size="sm">
    Receipt
  </x-button>

  @if(!$sale->is_cancelled)
  @can('cancel sales')
  <form method="POST"
        action="{{ route('pos.cancel', $sale) }}"
        style="display: inline;"
        onsubmit="return confirm('Cancel this sale? Stock will be restored.');">
    @csrf
    <button type="submit"
            class="button button-link button-sm"
            style="color: #dc2626; margin: 0; padding: 0;">
      Cancel
    </button>
  </form>
  @endcan
  @endif
</div>
