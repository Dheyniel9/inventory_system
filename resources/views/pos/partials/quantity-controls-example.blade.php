{{-- Example showing how to use input-table-button component in POS index --}}
{{-- This demonstrates the refactored approach for the cart quantity controls --}}

{{-- BEFORE: Inline buttons with duplicated styles --}}
{{-- <button @click="decrementQty(index)"
        class="quantity-button"
        type="button">
  <svg fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor">
    <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M20 12H4" />
  </svg>
</button>

<input type="number"
       x-model.number="item.qty"
       @change="validateQty(index)"
       min="1"
       :max="item.maxQty"
       class="quantity-input">

<button @click="incrementQty(index)"
        class="quantity-button"
        type="button">
  <svg fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor">
    <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 4v16m8-8H4" />
  </svg>
</button> --}}

{{-- AFTER: Using the input-table-button component --}}
<div class="quantity-controls">
  <x-input-table-button click="decrementQty(index)"
                        icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 12H4' />" />
  <input type="number"
         x-model.number="item.qty"
         @change="validateQty(index)"
         min="1"
         :max="item.maxQty"
         class="quantity-input">
  <x-input-table-button click="incrementQty(index)"
                        icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 4v16m8-8H4' />" />
</div>

{{-- The quantity-controls, quantity-input, and quantity-button styles are still defined in the main view CSS --}}
{{-- This approach keeps the Alpine.js logic inline while centralizing button styles --}}
