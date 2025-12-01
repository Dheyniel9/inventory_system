<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        protected Product $model
    ) {}

    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['category', 'supplier'])
            ->search($filters['search'] ?? null)
            ->byCategory($filters['category_id'] ?? null)
            ->bySupplier($filters['supplier_id'] ?? null)
            ->when(isset($filters['is_active']), fn($q) => $q->where('is_active', $filters['is_active']))
            ->when(isset($filters['stock_status']), fn($q) => $this->applyStockStatusFilter($q, $filters['stock_status']))
            ->orderBy($filters['sort_by'] ?? 'name', $filters['sort_order'] ?? 'asc')
            ->paginate($perPage);
    }

    public function getAll(bool $activeOnly = true): Collection
    {
        return $this->model
            ->query()
            ->with(['category', 'supplier'])
            ->when($activeOnly, fn($q) => $q->active())
            ->orderBy('name')
            ->get();
    }

    public function getForDropdown(): Collection
    {
        return $this->model
            ->query()
            ->active()
            ->select('id', 'name', 'sku', 'quantity')
            ->orderBy('name')
            ->get();
    }

    public function findById(int $id): ?Product
    {
        return $this->model
            ->with(['category', 'supplier', 'stockTransactions' => fn($q) => $q->latest()->limit(10)])
            ->find($id);
    }

    public function findBySku(string $sku): ?Product
    {
        return $this->model
            ->with(['category', 'supplier'])
            ->where('sku', $sku)
            ->first();
    }

    public function findByBarcode(string $barcode): ?Product
    {
        return $this->model
            ->with(['category', 'supplier'])
            ->where('barcode', $barcode)
            ->first();
    }

    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $imagePath = null;

            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $imagePath = $this->uploadImage($data['image']);
            }

            return $this->model->create([
                'name' => $data['name'],
                'sku' => $data['sku'] ?? null,
                'barcode' => $data['barcode'] ?? null,
                'description' => $data['description'] ?? null,
                'category_id' => $data['category_id'] ?? null,
                'supplier_id' => $data['supplier_id'] ?? null,
                'cost_price' => $data['cost_price'] ?? 0,
                'selling_price' => $data['selling_price'] ?? 0,
                'quantity' => $data['quantity'] ?? 0,
                'min_stock_level' => $data['min_stock_level'] ?? 0,
                'max_stock_level' => $data['max_stock_level'] ?? null,
                'unit' => $data['unit'] ?? 'pcs',
                'location' => $data['location'] ?? null,
                'image' => $imagePath,
                'is_active' => $data['is_active'] ?? true,
            ]);
        });
    }

    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            $imagePath = $product->image;

            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $this->deleteImage($product->image);
                $imagePath = $this->uploadImage($data['image']);
            } elseif (isset($data['remove_image']) && $data['remove_image']) {
                $this->deleteImage($product->image);
                $imagePath = null;
            }

            $product->update([
                'name' => $data['name'] ?? $product->name,
                'barcode' => $data['barcode'] ?? $product->barcode,
                'description' => $data['description'] ?? $product->description,
                'category_id' => array_key_exists('category_id', $data) ? $data['category_id'] : $product->category_id,
                'supplier_id' => array_key_exists('supplier_id', $data) ? $data['supplier_id'] : $product->supplier_id,
                'cost_price' => $data['cost_price'] ?? $product->cost_price,
                'selling_price' => $data['selling_price'] ?? $product->selling_price,
                'min_stock_level' => $data['min_stock_level'] ?? $product->min_stock_level,
                'max_stock_level' => $data['max_stock_level'] ?? $product->max_stock_level,
                'unit' => $data['unit'] ?? $product->unit,
                'location' => $data['location'] ?? $product->location,
                'image' => $imagePath,
                'is_active' => $data['is_active'] ?? $product->is_active,
            ]);

            return $product->fresh();
        });
    }

    public function delete(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            return $product->delete();
        });
    }

    public function forceDelete(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            $this->deleteImage($product->image);
            return $product->forceDelete();
        });
    }

    public function restore(int $id): ?Product
    {
        $product = $this->model->withTrashed()->find($id);

        if ($product) {
            $product->restore();
        }

        return $product;
    }

    public function toggleStatus(Product $product): Product
    {
        $product->update(['is_active' => !$product->is_active]);
        return $product->fresh();
    }

    public function updateQuantity(Product $product, int $quantity): Product
    {
        $product->update(['quantity' => $quantity]);
        return $product->fresh();
    }

    public function getLowStockProducts(int $limit = 10): Collection
    {
        return $this->model
            ->query()
            ->active()
            ->lowStock()
            ->with(['category', 'supplier'])
            ->orderBy('quantity')
            ->limit($limit)
            ->get();
    }

    public function getOutOfStockProducts(int $limit = 10): Collection
    {
        return $this->model
            ->query()
            ->active()
            ->outOfStock()
            ->with(['category', 'supplier'])
            ->limit($limit)
            ->get();
    }

    public function getTotalStockValue(): float
    {
        return $this->model
            ->query()
            ->active()
            ->selectRaw('SUM(quantity * cost_price) as total')
            ->value('total') ?? 0;
    }

    protected function applyStockStatusFilter($query, string $status)
    {
        return match ($status) {
            'low_stock' => $query->lowStock(),
            'out_of_stock' => $query->outOfStock(),
            'in_stock' => $query->inStock(),
            default => $query,
        };
    }

    protected function uploadImage(UploadedFile $file): string
    {
        return $file->store('products', 'public');
    }

    protected function deleteImage(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
