@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
            <p class="mt-1 text-sm text-gray-500">Update product information</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('products.index') }}"
               class="text-sm font-medium text-primary-600 hover:text-primary-500">
                ← Back to Products
            </a>
        </div>
    </div>

    <form action="{{ route('products.update', $product) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name"
                               class="block text-sm font-medium text-gray-700">Product Name *</label>
                        <input type="text"
                               name="name"
                               id="name"
                               required
                               value="{{ old('name', $product->name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">SKU</label>
                        <input type="text"
                               value="{{ $product->sku }}"
                               disabled
                               class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">SKU cannot be changed</p>
                    </div>

                    <div>
                        <label for="barcode"
                               class="block text-sm font-medium text-gray-700">Barcode</label>
                        <input type="text"
                               name="barcode"
                               id="barcode"
                               value="{{ old('barcode', $product->barcode) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('barcode') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description"
                               class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id"
                               class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id"
                                id="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category['id'] }}"
                                    {{
                                    old('category_id',
                                    $product->category_id) == $category['id'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="supplier_id"
                               class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id"
                                id="supplier_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                    {{
                                    old('supplier_id',
                                    $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pricing & Stock</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div>
                        <label for="cost_price"
                               class="block text-sm font-medium text-gray-700">Cost Price *</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">₱</span>
                            </div>
                            <input type="number"
                                   name="cost_price"
                                   id="cost_price"
                                   required
                                   step="0.01"
                                   min="0"
                                   value="{{ old('cost_price', $product->cost_price) }}"
                                   class="block w-full rounded-md border-gray-300 pl-7 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        @error('cost_price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="selling_price"
                               class="block text-sm font-medium text-gray-700">Selling Price *</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">₱</span>
                            </div>
                            <input type="number"
                                   name="selling_price"
                                   id="selling_price"
                                   required
                                   step="0.01"
                                   min="0"
                                   value="{{ old('selling_price', $product->selling_price) }}"
                                   class="block w-full rounded-md border-gray-300 pl-7 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        @error('selling_price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Current Quantity</label>
                        <input type="text"
                               value="{{ number_format($product->quantity) }} {{ $product->unit }}"
                               disabled
                               class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Use Stock Management to adjust</p>
                    </div>

                    <div>
                        <label for="min_stock_level"
                               class="block text-sm font-medium text-gray-700">Min Stock Level *</label>
                        <input type="number"
                               name="min_stock_level"
                               id="min_stock_level"
                               required
                               min="0"
                               value="{{ old('min_stock_level', $product->min_stock_level) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('min_stock_level') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="max_stock_level"
                               class="block text-sm font-medium text-gray-700">Max Stock Level</label>
                        <input type="number"
                               name="max_stock_level"
                               id="max_stock_level"
                               min="0"
                               value="{{ old('max_stock_level', $product->max_stock_level) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('max_stock_level') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="unit"
                               class="block text-sm font-medium text-gray-700">Unit *</label>
                        <select name="unit"
                                id="unit"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="pcs"
                                    {{
                                    old('unit',
                                    $product->unit) === 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                            <option value="box"
                                    {{
                                    old('unit',
                                    $product->unit) === 'box' ? 'selected' : '' }}>Box</option>
                            <option value="kg"
                                    {{
                                    old('unit',
                                    $product->unit) === 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                            <option value="ltr"
                                    {{
                                    old('unit',
                                    $product->unit) === 'ltr' ? 'selected' : '' }}>Liter (ltr)</option>
                            <option value="m"
                                    {{
                                    old('unit',
                                    $product->unit) === 'm' ? 'selected' : '' }}>Meter (m)</option>
                            <option value="ream"
                                    {{
                                    old('unit',
                                    $product->unit) === 'ream' ? 'selected' : '' }}>Ream</option>
                        </select>
                        @error('unit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="location"
                               class="block text-sm font-medium text-gray-700">Storage Location</label>
                        <input type="text"
                               name="location"
                               id="location"
                               value="{{ old('location', $product->location) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="image"
                               class="block text-sm font-medium text-gray-700">Product Image</label>
                        @if($product->image_url)
                        <div class="mt-1 flex items-center gap-4">
                            <img src="{{ $product->image_url }}"
                                 alt=""
                                 class="h-16 w-16 rounded-lg object-cover">
                            <div class="flex items-center">
                                <input type="checkbox"
                                       name="remove_image"
                                       id="remove_image"
                                       value="1"
                                       class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                                <label for="remove_image"
                                       class="ml-2 text-sm text-gray-500">Remove image</label>
                            </div>
                        </div>
                        @endif
                        <input type="file"
                               name="image"
                               id="image"
                               accept="image/*"
                               class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <div class="flex items-center">
                            <input type="hidden"
                                   name="is_active"
                                   value="0">
                            <input type="checkbox"
                                   name="is_active"
                                   id="is_active"
                                   value="1"
                                   {{
                                   old('is_active',
                                   $product->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="is_active"
                                   class="ml-2 block text-sm text-gray-900">Active product</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('products.index') }}"
               class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
