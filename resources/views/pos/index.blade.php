@extends('layouts.app')

@section('title', 'Point of Sale')

@section('content')
<div x-data="posTerminal()" class="h-[calc(100vh-10rem)]">
    <div class="flex h-full gap-6">
        <!-- Products Section -->
        <div class="flex-1 flex flex-col bg-white rounded-lg shadow overflow-hidden">
            <!-- Search and Categories -->
            <div class="p-4 border-b space-y-4">
                <div class="flex gap-4">
                    <div class="flex-1 relative">
                        <input type="text" x-model="searchQuery" @input.debounce.300ms="filterProducts()" placeholder="Search products or scan barcode..."
                               @keydown.enter.prevent="handleBarcodeSearch()"
                               class="w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <select x-model="selectedCategory" @change="filterProducts()" class="rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1 overflow-y-auto p-4">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @foreach($products as $product)
                        <button type="button" @click="addToCart({{ json_encode([
                            'id' => $product->id,
                            'name' => $product->name,
                            'sku' => $product->sku,
                            'price' => $product->selling_price,
                            'quantity' => $product->quantity,
                            'image' => $product->image_url,
                            'category_id' => $product->category_id,
                        ]) }})"
                                x-show="shouldShowProduct({{ $product->category_id ?? 'null' }}, '{{ strtolower($product->name) }}', '{{ strtolower($product->sku) }}')"
                                class="flex flex-col items-center p-3 rounded-lg border border-gray-200 hover:border-primary-500 hover:shadow-md transition-all text-center group">
                            <div class="w-16 h-16 mb-2 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-gray-900 line-clamp-2">{{ $product->name }}</span>
                            <span class="text-xs text-gray-500">{{ $product->sku }}</span>
                            <span class="text-sm font-bold text-primary-600 mt-1">${{ number_format($product->selling_price, 2) }}</span>
                            <span class="text-xs {{ $product->quantity <= $product->min_stock_level ? 'text-yellow-600' : 'text-gray-400' }}">
                                Stock: {{ $product->quantity }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="w-96 flex flex-col bg-white rounded-lg shadow overflow-hidden">
            <!-- Cart Header -->
            <div class="p-4 border-b bg-primary-600 text-white">
                <h2 class="text-lg font-semibold">Current Sale</h2>
                <p class="text-sm text-primary-200" x-text="cart.length + ' item(s)'"></p>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                <template x-for="(item, index) in cart" :key="item.id">
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate" x-text="item.name"></p>
                            <p class="text-sm text-gray-500" x-text="'$' + item.price.toFixed(2) + ' × ' + item.qty"></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="decrementQty(index)" class="w-7 h-7 flex items-center justify-center rounded bg-gray-200 hover:bg-gray-300 text-gray-600">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                            </button>
                            <input type="number" x-model.number="item.qty" @change="validateQty(index)" min="1" :max="item.maxQty"
                                   class="w-12 text-center text-sm border-gray-300 rounded">
                            <button @click="incrementQty(index)" class="w-7 h-7 flex items-center justify-center rounded bg-gray-200 hover:bg-gray-300 text-gray-600">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900" x-text="'$' + (item.price * item.qty).toFixed(2)"></p>
                            <button @click="removeFromCart(index)" class="text-xs text-red-600 hover:text-red-700">Remove</button>
                        </div>
                    </div>
                </template>

                <div x-show="cart.length === 0" class="text-center py-12 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="mt-2">Cart is empty</p>
                    <p class="text-sm">Add products to start a sale</p>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="border-t p-4 space-y-3 bg-gray-50">
                <!-- Discount -->
                <div class="flex items-center gap-2">
                    <select x-model="discountType" class="text-sm rounded-md border-gray-300">
                        <option value="">No Discount</option>
                        <option value="percentage">%</option>
                        <option value="fixed">$</option>
                    </select>
                    <input type="number" x-model.number="discountValue" x-show="discountType" min="0" step="0.01" placeholder="0"
                           class="flex-1 text-sm rounded-md border-gray-300">
                </div>

                <!-- Tax -->
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Tax Rate (%)</span>
                    <input type="number" x-model.number="taxRate" min="0" max="100" step="0.01"
                           class="w-20 text-sm text-right rounded-md border-gray-300">
                </div>

                <!-- Totals -->
                <div class="space-y-1 pt-3 border-t">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span x-text="'$' + subtotal.toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between text-sm" x-show="discountAmount > 0">
                        <span class="text-gray-600">Discount</span>
                        <span class="text-red-600" x-text="'-$' + discountAmount.toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between text-sm" x-show="taxAmount > 0">
                        <span class="text-gray-600">Tax (<span x-text="taxRate"></span>%)</span>
                        <span x-text="'$' + taxAmount.toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-2 border-t">
                        <span>Total</span>
                        <span class="text-primary-600" x-text="'$' + total.toFixed(2)"></span>
                    </div>
                </div>

                <!-- Payment -->
                <div class="space-y-3 pt-3">
                    <select x-model="paymentMethod" class="w-full rounded-md border-gray-300">
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="transfer">Bank Transfer</option>
                    </select>

                    <div x-show="paymentMethod === 'cash'">
                        <label class="text-sm text-gray-600">Amount Received</label>
                        <input type="number" x-model.number="amountPaid" min="0" step="0.01"
                               class="w-full rounded-md border-gray-300">
                        <p class="text-sm mt-1" x-show="change >= 0">
                            Change: <span class="font-semibold text-green-600" x-text="'$' + change.toFixed(2)"></span>
                        </p>
                    </div>

                    <!-- Customer Info (optional) -->
                    <div x-data="{ showCustomer: false }">
                        <button @click="showCustomer = !showCustomer" type="button" class="text-sm text-primary-600 hover:text-primary-700">
                            <span x-text="showCustomer ? '− Hide' : '+ Add'"></span> Customer Info
                        </button>
                        <div x-show="showCustomer" x-collapse class="mt-2 space-y-2">
                            <input type="text" x-model="customerName" placeholder="Customer Name" class="w-full text-sm rounded-md border-gray-300">
                            <input type="text" x-model="customerPhone" placeholder="Phone" class="w-full text-sm rounded-md border-gray-300">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2 pt-3">
                    <button @click="clearCart()" type="button" class="flex-1 py-2 px-4 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">
                        Clear
                    </button>
                    <button @click="checkout()" type="button" :disabled="cart.length === 0 || processing"
                            class="flex-1 py-2 px-4 rounded-md bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!processing">Complete Sale</span>
                        <span x-show="processing">Processing...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div x-show="showSuccessModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeSuccessModal()"></div>
            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 mb-4">
                    <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Sale Completed!</h3>
                <p class="text-gray-600 mb-2">Invoice: <span class="font-mono font-semibold" x-text="lastSale?.invoice_number"></span></p>
                <p class="text-2xl font-bold text-primary-600 mb-1" x-text="'$' + (lastSale?.total || 0).toFixed(2)"></p>
                <p class="text-gray-600" x-show="lastSale?.change_amount > 0">Change: <span class="font-semibold text-green-600" x-text="'$' + (lastSale?.change_amount || 0).toFixed(2)"></span></p>
                <div class="mt-6 flex gap-3 justify-center">
                    <a :href="'/pos/sales/' + lastSale?.id + '/receipt'" target="_blank" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                        Print Receipt
                    </a>
                    <button @click="closeSuccessModal()" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                        New Sale
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function posTerminal() {
    return {
        cart: [],
        searchQuery: '',
        selectedCategory: '',
        discountType: '',
        discountValue: 0,
        taxRate: 0,
        paymentMethod: 'cash',
        amountPaid: 0,
        customerName: '',
        customerPhone: '',
        processing: false,
        showSuccessModal: false,
        lastSale: null,

        get subtotal() {
            return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        },

        get discountAmount() {
            if (!this.discountType || !this.discountValue) return 0;
            if (this.discountType === 'percentage') {
                return this.subtotal * (this.discountValue / 100);
            }
            return Math.min(this.discountValue, this.subtotal);
        },

        get taxableAmount() {
            return this.subtotal - this.discountAmount;
        },

        get taxAmount() {
            return this.taxableAmount * (this.taxRate / 100);
        },

        get total() {
            return this.taxableAmount + this.taxAmount;
        },

        get change() {
            return this.amountPaid - this.total;
        },

        shouldShowProduct(categoryId, name, sku) {
            if (this.selectedCategory && categoryId != this.selectedCategory) return false;
            if (this.searchQuery) {
                const search = this.searchQuery.toLowerCase();
                return name.includes(search) || sku.includes(search);
            }
            return true;
        },

        filterProducts() {
            // Handled by x-show
        },

        handleBarcodeSearch() {
            if (!this.searchQuery) return;
            fetch(`{{ route('pos.search-product') }}?barcode=${encodeURIComponent(this.searchQuery)}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(r => r.json())
            .then(data => {
                if (data.success && data.product) {
                    this.addToCart({
                        id: data.product.id,
                        name: data.product.name,
                        sku: data.product.sku,
                        price: parseFloat(data.product.price),
                        quantity: data.product.quantity,
                    });
                    this.searchQuery = '';
                }
            });
        },

        addToCart(product) {
            const existing = this.cart.find(item => item.id === product.id);
            if (existing) {
                if (existing.qty < product.quantity) {
                    existing.qty++;
                }
            } else {
                this.cart.push({
                    id: product.id,
                    name: product.name,
                    sku: product.sku,
                    price: parseFloat(product.price),
                    qty: 1,
                    maxQty: product.quantity,
                });
            }
            this.updateAmountPaid();
        },

        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.updateAmountPaid();
        },

        incrementQty(index) {
            if (this.cart[index].qty < this.cart[index].maxQty) {
                this.cart[index].qty++;
                this.updateAmountPaid();
            }
        },

        decrementQty(index) {
            if (this.cart[index].qty > 1) {
                this.cart[index].qty--;
                this.updateAmountPaid();
            }
        },

        validateQty(index) {
            const item = this.cart[index];
            item.qty = Math.max(1, Math.min(item.qty, item.maxQty));
            this.updateAmountPaid();
        },

        updateAmountPaid() {
            if (this.paymentMethod !== 'cash') {
                this.amountPaid = this.total;
            }
        },

        clearCart() {
            if (this.cart.length && confirm('Clear all items from cart?')) {
                this.cart = [];
                this.discountType = '';
                this.discountValue = 0;
                this.customerName = '';
                this.customerPhone = '';
            }
        },

        async checkout() {
            if (this.cart.length === 0) return;
            if (this.paymentMethod === 'cash' && this.amountPaid < this.total) {
                alert('Amount paid is less than total');
                return;
            }

            this.processing = true;

            try {
                const response = await fetch('{{ route('pos.checkout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        items: this.cart.map(item => ({
                            product_id: item.id,
                            quantity: item.qty,
                            unit_price: item.price,
                        })),
                        discount_type: this.discountType || null,
                        discount_value: this.discountValue,
                        tax_rate: this.taxRate,
                        payment_method: this.paymentMethod,
                        amount_paid: this.paymentMethod === 'cash' ? this.amountPaid : this.total,
                        customer_name: this.customerName || null,
                        customer_phone: this.customerPhone || null,
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    this.lastSale = data.sale;
                    this.showSuccessModal = true;
                } else {
                    alert(data.message || 'Error processing sale');
                }
            } catch (error) {
                alert('Error processing sale');
            } finally {
                this.processing = false;
            }
        },

        closeSuccessModal() {
            this.showSuccessModal = false;
            this.cart = [];
            this.discountType = '';
            this.discountValue = 0;
            this.amountPaid = 0;
            this.customerName = '';
            this.customerPhone = '';
        }
    };
}
</script>
@endsection
