@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<style>
    .category-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .category-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .category-header-content {
        flex: 1;
    }

    .category-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #111827;
    }

    .category-subtitle {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .back-link {
        margin-top: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
    }

    .back-link:hover {
        color: #1d4ed8;
    }

    .category-form {
        border-radius: 0.5rem;
        background-color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .form-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .form-input {
        margin-top: 0.25rem;
        display: block;
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 0.5rem;
    }

    .form-input:focus {
        border-color: #3b82f6;
        outline: none;
    }

    .error-message {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc2626;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
    }

    .checkbox-input {
        height: 1rem;
        width: 1rem;
        border-radius: 0.25rem;
        border: 1px solid #d1d5db;
    }

    .checkbox-label {
        margin-left: 0.5rem;
        display: block;
        font-size: 0.875rem;
        color: #111827;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        border-top: 1px solid #e5e7eb;
        padding: 1rem 1.5rem;
    }

    .btn-cancel {
        border-radius: 0.375rem;
        background-color: #ffffff;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: 1px solid #d1d5db;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background-color: #f9fafb;
    }

    .btn-submit {
        border-radius: 0.375rem;
        background-color: #2563eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: none;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #1d4ed8;
    }
</style>

<div class="category-container">
    <div class="category-header">
        <div class="category-header-content">
            <h1 class="category-title">Add Category</h1>
            <p class="category-subtitle">Create a new category</p>
        </div>
        <div>
            <a href="{{ route('categories.index') }}"
               class="back-link">← Back</a>
        </div>
    </div>

    <form action="{{ route('categories.store') }}"
          method="POST"
          class="category-form">
        @csrf
        <div class="form-content">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text"
                       name="name"
                       id="name"
                       required
                       value="{{ old('name') }}"
                       class="form-input">
                @error('name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Category</label>
                <select name="parent_id"
                        id="parent_id"
                        class="form-input">
                    <option value="">None (Top Level)</option>
                    @foreach($parentCategories as $parent)
                    <option value="{{ $parent->id }}"
                            {{
                            old('parent_id')==$parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                    @endforeach
                </select>
                @error('parent_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                          id="description"
                          rows="3"
                          class="form-input">{{ old('description') }}</textarea>
                @error('description') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="checkbox-group">
                <input type="hidden"
                       name="is_active"
                       value="0">
                <input type="checkbox"
                       name="is_active"
                       id="is_active"
                       value="1"
                       {{
                       old('is_active',
                       true)
                       ? 'checked'
                       : ''
                       }}
                       class="checkbox-input">
                <label for="is_active"
                       class="checkbox-label">Active</label>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('categories.index') }}"
               class="btn-cancel">Cancel</a>
            <button type="submit"
                    class="btn-submit">Create</button>
        </div>
    </form>
</div>
@endsection
