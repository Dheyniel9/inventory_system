<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function __construct(
        protected Category $model
    ) {}

    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with('parent', 'children')
            ->withCount('products')
            ->search($filters['search'] ?? null)
            ->when(isset($filters['is_active']), fn($q) => $q->where('is_active', $filters['is_active']))
            ->when(isset($filters['parent_only']) && $filters['parent_only'], fn($q) => $q->parentsOnly())
            ->orderBy($filters['sort_by'] ?? 'name', $filters['sort_order'] ?? 'asc')
            ->paginate($perPage);
    }

    public function getAll(bool $activeOnly = true): Collection
    {
        return $this->model
            ->query()
            ->when($activeOnly, fn($q) => $q->active())
            ->orderBy('name')
            ->get();
    }

    public function getParentCategories(bool $activeOnly = true): Collection
    {
        return $this->model
            ->query()
            ->parentsOnly()
            ->when($activeOnly, fn($q) => $q->active())
            ->orderBy('name')
            ->get();
    }

    public function getForDropdown(): SupportCollection
    {
        return $this->model
            ->query()
            ->active()
            ->with('parent')
            ->orderBy('name')
            ->get()
            ->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->full_name,
            ]);
    }

    public function findById(int $id): ?Category
    {
        return $this->model
            ->with('parent', 'children', 'products')
            ->withCount('products')
            ->find($id);
    }

    public function findBySlug(string $slug): ?Category
    {
        return $this->model
            ->with('parent', 'children', 'products')
            ->where('slug', $slug)
            ->first();
    }

    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create([
                'name' => $data['name'],
                'slug' => $data['slug'] ?? null,
                'description' => $data['description'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
                'is_active' => $data['is_active'] ?? true,
            ]);
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {
            // Prevent circular reference
            if (isset($data['parent_id']) && $data['parent_id'] == $category->id) {
                throw new \InvalidArgumentException('Category cannot be its own parent.');
            }

            // Check if parent_id would create circular reference
            if (isset($data['parent_id']) && $this->wouldCreateCircularReference($category, $data['parent_id'])) {
                throw new \InvalidArgumentException('This would create a circular reference.');
            }

            $category->update([
                'name' => $data['name'] ?? $category->name,
                'slug' => $data['slug'] ?? $category->slug,
                'description' => $data['description'] ?? $category->description,
                'parent_id' => array_key_exists('parent_id', $data) ? $data['parent_id'] : $category->parent_id,
                'is_active' => $data['is_active'] ?? $category->is_active,
            ]);

            return $category->fresh();
        });
    }

    public function delete(Category $category): bool
    {
        return DB::transaction(function () use ($category) {
            // Move children to parent or set to null
            $category->children()->update(['parent_id' => $category->parent_id]);

            // Set products category to null
            $category->products()->update(['category_id' => null]);

            return $category->delete();
        });
    }

    public function forceDelete(Category $category): bool
    {
        return DB::transaction(function () use ($category) {
            $category->children()->update(['parent_id' => null]);
            $category->products()->update(['category_id' => null]);

            return $category->forceDelete();
        });
    }

    public function restore(int $id): ?Category
    {
        $category = $this->model->withTrashed()->find($id);

        if ($category) {
            $category->restore();
        }

        return $category;
    }

    public function toggleStatus(Category $category): Category
    {
        $category->update(['is_active' => !$category->is_active]);
        return $category->fresh();
    }

    protected function wouldCreateCircularReference(Category $category, int $parentId): bool
    {
        $childIds = $this->getAllChildIds($category);
        return in_array($parentId, $childIds);
    }

    protected function getAllChildIds(Category $category): array
    {
        $ids = [];

        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllChildIds($child));
        }

        return $ids;
    }
}
