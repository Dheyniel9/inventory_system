@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Products</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your inventory products</p>
        </div>
        @can('manage products')
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5"
                     viewBox="0 0 20 20"
                     fill="currentColor">
                    <path
                          d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                Add Product
            </a>
        </div>
        @endcan
    </div>

    <!-- Filters -->
    <div class="rounded-lg bg-white p-4 shadow">
        <form method="GET"
              class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
            <div>
                <label for="search"
                       class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text"
                       name="search"
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Name, SKU, Barcode..."
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div>
                <label for="category_id"
                       class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id"
                        id="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}"
                            {{
                            request('category_id')==$category['id']
                            ? 'selected'
                            : ''
                            }}>
                        {{ $category['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="supplier_id"
                       class="block text-sm font-medium text-gray-700">Supplier</label>
                <select name="supplier_id"
                        id="supplier_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                            {{
                            request('supplier_id')==$supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="stock_status"
                       class="block text-sm font-medium text-gray-700">Stock Status</label>
                <select name="stock_status"
                        id="stock_status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    <option value="">All Status</option>
                    <option value="in_stock"
                            {{
                            request('stock_status')==='in_stock'
                            ? 'selected'
                            : ''
                            }}>In Stock</option>
                    <option value="low_stock"
                            {{
                            request('stock_status')==='low_stock'
                            ? 'selected'
                            : ''
                            }}>Low Stock</option>
                    <option value="out_of_stock"
                            {{
                            request('stock_status')==='out_of_stock'
                            ? 'selected'
                            : ''
                            }}>Out of Stock</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit"
                        class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                    Filter
                </button>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Products table -->
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Product</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">SKU</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col"
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($products as $product)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    @if($product->image_url)
                                    <img class="h-10 w-10 rounded-lg object-cover"
                                         src="{{ $product->image_url }}"
                                         alt="">
                                    @else
                                    <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-400"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                    @if($product->barcode)
                                    <div class="text-sm text-gray-500">{{ $product->barcode }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->sku }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->category?->name ??
                            '-' }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <div>₱{{ number_format($product->selling_price, 2) }}</div>
                            <div class="text-xs text-gray-400">Cost: ₱{{ number_format($product->cost_price, 2) }}</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                            <span
                                  class="{{ $product->quantity <= 0 ? 'text-red-600' : ($product->is_low_stock ? 'text-yellow-600' : 'text-gray-900') }} font-medium">
                                {{ number_format($product->quantity) }} {{ $product->unit }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $product->stock_status === 'in_stock' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $product->stock_status === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $product->stock_status === 'out_of_stock' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $product->stock_status_label }}
                            </span>
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('products.show', $product) }}"
                                   class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-5 w-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                @can('manage products')
                                <a href="{{ route('products.edit', $product) }}"
                                   class="text-primary-600 hover:text-primary-900">
                                    <svg class="h-5 w-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7"
                            class="px-6 py-12 text-center text-sm text-gray-500">
                            No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
        <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
