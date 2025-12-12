@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container-responsive">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Edit Product</h1>
            <p class="page-description">Update product information</p>
        </div>
        <div class="header-actions">
            <x-button tag="link"
                      href="{{ route('products.index') }}"
                      variant="secondary"
                      icon="<path stroke-linecap='round' stroke-linejoin='round' d='M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18' />">
                Back to Products
            </x-button>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('products.update', $product) }}"
          method="POST"
          enctype="multipart/form-data"
          class="form-container">
        @csrf
        @method('PUT')

        <!-- Basic Information Section -->
        <div class="form-section">
            <h2 class="section-title">Basic Information</h2>

            <div class="form-grid">
                <x-form-group name="name"
                              label="Product Name"
                              type="text"
                              placeholder="Enter product name"
                              value="{{ old('name', $product->name) }}"
                              required
                              error="{{ $errors->has('name') ? $errors->first('name') : false }}" />

                <x-form-group name="sku"
                              label="SKU"
                              type="text"
                              value="{{ $product->sku }}"
                              disabled
                              help="SKU cannot be changed" />

                <x-form-group name="barcode"
                              label="Barcode"
                              type="text"
                              placeholder="Enter barcode"
                              value="{{ old('barcode', $product->barcode) }}"
                              error="{{ $errors->has('barcode') ? $errors->first('barcode') : false }}" />

                <x-form-group name="description"
                              label="Description"
                              type="textarea"
                              placeholder="Enter product description"
                              value="{{ old('description', $product->description) }}"
                              error="{{ $errors->has('description') ? $errors->first('description') : false }}" />

                <x-form-group name="category_id"
                              label="Category"
                              type="select"
                              :options="collect($categories)->pluck('name', 'id')->toArray()"
                              value="{{ old('category_id', $product->category_id) }}"
                              error="{{ $errors->has('category_id') ? $errors->first('category_id') : false }}" />

                <x-form-group name="supplier_id"
                              label="Supplier"
                              type="select"
                              :options="$suppliers->pluck('name', 'id')->toArray()"
                              value="{{ old('supplier_id', $product->supplier_id) }}"
                              error="{{ $errors->has('supplier_id') ? $errors->first('supplier_id') : false }}" />
            </div>
        </div>

        <!-- Pricing & Stock Section -->
        <div class="form-section">
            <h2 class="section-title">Pricing & Stock</h2>

            <div class="form-grid form-grid-3">
                <x-form-group name="cost_price"
                              label="Cost Price"
                              type="number"
                              value="{{ old('cost_price', $product->cost_price) }}"
                              required
                              error="{{ $errors->has('cost_price') ? $errors->first('cost_price') : false }}" />

                <x-form-group name="selling_price"
                              label="Selling Price"
                              type="number"
                              value="{{ old('selling_price', $product->selling_price) }}"
                              required
                              error="{{ $errors->has('selling_price') ? $errors->first('selling_price') : false }}" />

                <x-form-group name="quantity"
                              label="Current Quantity"
                              type="text"
                              value="{{ number_format($product->quantity) }} {{ $product->unit }}"
                              disabled
                              help="Use Stock Management to adjust" />

                <x-form-group name="min_stock_level"
                              label="Min Stock Level"
                              type="number"
                              value="{{ old('min_stock_level', $product->min_stock_level) }}"
                              required
                              error="{{ $errors->has('min_stock_level') ? $errors->first('min_stock_level') : false }}" />

                <x-form-group name="max_stock_level"
                              label="Max Stock Level"
                              type="number"
                              value="{{ old('max_stock_level', $product->max_stock_level) }}"
                              error="{{ $errors->has('max_stock_level') ? $errors->first('max_stock_level') : false }}" />

                <x-form-group name="unit"
                              label="Unit"
                              type="select"
                              :options="['pcs' => 'Pieces (pcs)', 'box' => 'Box', 'kg' => 'Kilogram (kg)', 'ltr' => 'Liter (ltr)', 'm' => 'Meter (m)', 'ream' => 'Ream']"
                              value="{{ old('unit', $product->unit) }}"
                              required
                              error="{{ $errors->has('unit') ? $errors->first('unit') : false }}" />
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="form-section">
            <h2 class="section-title">Additional Information</h2>

            <div class="form-grid">
                <x-form-group name="location"
                              label="Storage Location"
                              type="text"
                              placeholder="e.g., Warehouse A - Shelf 1"
                              value="{{ old('location', $product->location) }}"
                              error="{{ $errors->has('location') ? $errors->first('location') : false }}" />

                <x-form-group name="image"
                              label="Product Image"
                              type="file"
                              help="{{ $product->image_url ? 'Upload a new image to replace the current one' : '' }}"
                              error="{{ $errors->has('image') ? $errors->first('image') : false }}" />
            </div>

            @if($product->image_url)
            <div class="form-group"
                 style="margin-bottom: 1rem;">
                <img src="{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     style="max-width: 200px; border-radius: 0.375rem; margin-bottom: 0.5rem;">
                <div class="checkbox-container">
                    <input type="checkbox"
                           name="remove_image"
                           id="remove_image"
                           value="1"
                           class="form-checkbox">
                    <label for="remove_image"
                           class="checkbox-label">Remove current image</label>
                </div>
            </div>
            @endif

            <div class="form-group form-group-full">
                <div class="checkbox-container">
                    <input type="hidden"
                           name="is_active"
                           value="0">
                    <input type="checkbox"
                           name="is_active"
                           id="is_active"
                           value="1"
                           {{
                           old('is_active',
                           $product->is_active) ? 'checked' : '' }} class="form-checkbox">
                    <label for="is_active"
                           class="checkbox-label">Active product</label>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <x-button tag="link"
                      href="{{ route('products.index') }}"
                      variant="secondary">
                Cancel
            </x-button>
            <x-button type="submit"
                      variant="primary">
                Update Product
            </x-button>
        </div>
    </form>
</div>

<style>
    /* Container */
    .container-responsive {
        width: 100%;
        max-width: 80rem;
        margin: 0 auto;
        padding: 1rem;
    }

    @media (min-width: 640px) {
        .container-responsive {
            padding: 1.5rem;
        }
    }

    /* Page Header */
    .page-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 640px) {
        .page-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
    }

    .header-content {
        flex: 1;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    @media (min-width: 640px) {
        .page-title {
            font-size: 1.875rem;
        }
    }

    .page-description {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .header-actions {
        display: flex;
        justify-content: flex-start;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
        transition: color 0.2s;
    }

    .btn-back:hover {
        color: #1d4ed8;
    }

    .btn-text {
        display: none;
    }

    @media (min-width: 640px) {
        .btn-text {
            display: inline;
        }
    }

    /* Form Container */
    .form-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    /* Form Section */
    .form-section {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.25rem;
    }

    @media (min-width: 640px) {
        .form-section {
            padding: 1.5rem;
        }
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0 0 1.25rem 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }

    @media (min-width: 640px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    .form-grid-3 {
        grid-template-columns: 1fr;
    }

    @media (min-width: 768px) {
        .form-grid-3 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .form-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Form Group */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .required {
        color: #dc2626;
    }

    /* Form Inputs */
    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.625rem 0.875rem;
        font-size: 0.875rem;
        color: #111827;
        background-color: white;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input-disabled {
        width: 100%;
        padding: 0.625rem 0.875rem;
        font-size: 0.875rem;
        color: #6b7280;
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        cursor: not-allowed;
    }

    .form-textarea {
        resize: vertical;
        min-height: 5rem;
    }

    .input-error {
        border-color: #dc2626;
    }

    .input-error:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Input with Prefix */
    .input-with-prefix {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-prefix {
        position: absolute;
        left: 0.875rem;
        font-size: 0.875rem;
        color: #6b7280;
        pointer-events: none;
    }

    .input-with-prefix-field {
        padding-left: 2rem;
    }

    /* File Input */
    .form-file {
        width: 100%;
        font-size: 0.875rem;
        color: #6b7280;
        cursor: pointer;
    }

    .form-file::file-selector-button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e40af;
        background-color: #eff6ff;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .form-file::file-selector-button:hover {
        background-color: #dbeafe;
    }

    /* Image Preview */
    .image-preview-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        padding: 0.75rem;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }

    @media (min-width: 640px) {
        .image-preview-container {
            flex-direction: row;
            align-items: center;
        }
    }

    .image-preview {
        width: 5rem;
        height: 5rem;
        object-fit: cover;
        border-radius: 0.5rem;
        background-color: white;
        border: 1px solid #e5e7eb;
    }

    /* Checkbox */
    .checkbox-container {
        display: flex;
        align-items: center;
    }

    .form-checkbox {
        width: 1rem;
        height: 1rem;
        color: #2563eb;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .form-checkbox:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .checkbox-danger {
        color: #dc2626;
    }

    .checkbox-danger:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .checkbox-label {
        margin-left: 0.5rem;
        font-size: 0.875rem;
        color: #111827;
        cursor: pointer;
    }

    /* Help Text */
    .help-text {
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: #6b7280;
    }

    /* Error Message */
    .error-message {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #dc2626;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    @media (min-width: 640px) {
        .form-actions {
            flex-direction: row;
            justify-content: flex-end;
        }
    }

    /* Buttons */
    .btn-primary,
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-primary {
        color: white;
        background-color: #2563eb;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-secondary {
        color: #111827;
        background-color: white;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-secondary:hover {
        background-color: #f9fafb;
    }

    @media (min-width: 640px) {

        .btn-primary,
        .btn-secondary {
            width: auto;
        }
    }

    /* Icons */
    .icon-small {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
    }
</style>
@endsection
