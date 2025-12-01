@extends('layouts.app')

@section('title', 'Stock Adjustment')

@section('content')
<div class="space-y-6">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-2xl font-bold text-gray-900">Stock Adjustment</h1>
      <p class="mt-1 text-sm text-gray-500">Adjust inventory quantities to match physical counts</p>
    </div>
    <div class="mt-4 sm:mt-0">
      <a href="{{ route('stock.index') }}"
         class="text-sm font-medium text-primary-600 hover:text-primary-500">
        ← Back to Transactions
      </a>
    </div>
  </div>

  <div class="rounded-lg bg-white shadow">
    <form action="{{ route('stock.adjustment.process') }}"
          method="POST"
          class="space-y-6 p-6"
          x-data="stockAdjustment()">
      @csrf
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="sm:col-span-2">
          <label for="product_id"
                 class="block text-sm font-medium text-gray-700">Product *</label>
          <select name="product_id"
                  id="product_id"
                  required
                  x-model="selectedProduct"
                  @change="updateCurrentStock()"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">Select Product</option>
            @foreach($products as $product)
            <option value="{{ $product->id }}"
                    data-current-stock="{{ $product->quantity }}"
                    data-product-name="{{ $product->name }}"
                    {{
                    (old('product_id')
                    ??
                    request('product_id'))==$product->id ? 'selected' : '' }}>
              {{ $product->name }} ({{ $product->sku }}) - Current: {{ $product->quantity }}
            </option>
            @endforeach
          </select>
          @error('product_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Current Stock Display -->
        <div x-show="currentStock !== null"
             class="sm:col-span-2">
          <div class="rounded-md bg-blue-50 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400"
                     viewBox="0 0 20 20"
                     fill="currentColor">
                  <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                        clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3 flex-1">
                <p class="text-sm text-blue-800">
                  <span class="font-medium"
                        x-text="productName"></span> currently has <strong x-text="currentStock"></strong> units in
                  stock.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div>
          <label for="new_quantity"
                 class="block text-sm font-medium text-gray-700">New Quantity *</label>
          <input type="number"
                 name="new_quantity"
                 id="new_quantity"
                 required
                 min="0"
                 value="{{ old('new_quantity', 0) }}"
                 x-model="newQuantity"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('new_quantity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

          <!-- Adjustment Preview -->
          <div x-show="currentStock !== null && newQuantity !== ''"
               class="mt-2">
            <p class="text-sm"
               :class="adjustmentDifference > 0 ? 'text-green-600' : adjustmentDifference < 0 ? 'text-red-600' : 'text-gray-500'">
              <span x-show="adjustmentDifference > 0">
                Increase by <span x-text="Math.abs(adjustmentDifference)"></span> units
              </span>
              <span x-show="adjustmentDifference < 0">
                Decrease by <span x-text="Math.abs(adjustmentDifference)"></span> units
              </span>
              <span x-show="adjustmentDifference === 0">
                No change in quantity
              </span>
            </p>
          </div>
        </div>

        <div>
          <label for="transaction_date"
                 class="block text-sm font-medium text-gray-700">Transaction Date</label>
          <input type="datetime-local"
                 name="transaction_date"
                 id="transaction_date"
                 value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('transaction_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="sm:col-span-2">
          <label for="reason"
                 class="block text-sm font-medium text-gray-700">Reason *</label>
          <input type="text"
                 name="reason"
                 id="reason"
                 required
                 value="{{ old('reason') }}"
                 placeholder="e.g., Physical count adjustment, Damaged goods, Inventory correction"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
          @error('reason') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="sm:col-span-2">
          <label for="notes"
                 class="block text-sm font-medium text-gray-700">Notes</label>
          <textarea name="notes"
                    id="notes"
                    rows="3"
                    placeholder="Additional details about the adjustment..."
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('notes') }}</textarea>
          @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-4 border-t">
        <a href="{{ route('stock.index') }}"
           class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
          Cancel
        </a>
        <button type="submit"
                class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500">
          Record Stock Adjustment
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function stockAdjustment() {
    return {
        selectedProduct: '{{ old('product_id') ?? request('product_id') }}',
        currentStock: null,
        newQuantity: '{{ old('new_quantity', '') }}',
        productName: '',

        get adjustmentDifference() {
            if (this.currentStock === null || this.newQuantity === '') return 0;
            return parseInt(this.newQuantity) - parseInt(this.currentStock);
        },

        updateCurrentStock() {
            const select = document.getElementById('product_id');
            const option = select.options[select.selectedIndex];

            if (option && option.value) {
                this.currentStock = parseInt(option.dataset.currentStock);
                this.productName = option.dataset.productName;
            } else {
                this.currentStock = null;
                this.productName = '';
            }
        },

        init() {
            // Set initial values if product is pre-selected
            if (this.selectedProduct) {
                this.updateCurrentStock();
            }
        }
    }
}
</script>
@endsection
