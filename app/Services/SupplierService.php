<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SupplierService
{
    public function __construct(
        protected Supplier $model
    ) {}

    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->withCount('products')
            ->search($filters['search'] ?? null)
            ->when(isset($filters['is_active']), fn($q) => $q->where('is_active', $filters['is_active']))
            ->when(isset($filters['city']), fn($q) => $q->where('city', $filters['city']))
            ->when(isset($filters['country']), fn($q) => $q->where('country', $filters['country']))
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

    public function getForDropdown(): Collection
    {
        return $this->model
            ->query()
            ->active()
            ->select('id', 'name', 'code')
            ->orderBy('name')
            ->get();
    }

    public function findById(int $id): ?Supplier
    {
        return $this->model
            ->with('products')
            ->withCount('products')
            ->find($id);
    }

    public function findByCode(string $code): ?Supplier
    {
        return $this->model
            ->with('products')
            ->where('code', $code)
            ->first();
    }

    public function create(array $data): Supplier
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create([
                'name' => $data['name'],
                'code' => $data['code'] ?? null,
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'country' => $data['country'] ?? null,
                'contact_person' => $data['contact_person'] ?? null,
                'is_active' => $data['is_active'] ?? true,
            ]);
        });
    }

    public function update(Supplier $supplier, array $data): Supplier
    {
        return DB::transaction(function () use ($supplier, $data) {
            $supplier->update([
                'name' => $data['name'] ?? $supplier->name,
                'email' => $data['email'] ?? $supplier->email,
                'phone' => $data['phone'] ?? $supplier->phone,
                'address' => $data['address'] ?? $supplier->address,
                'city' => $data['city'] ?? $supplier->city,
                'country' => $data['country'] ?? $supplier->country,
                'contact_person' => $data['contact_person'] ?? $supplier->contact_person,
                'is_active' => $data['is_active'] ?? $supplier->is_active,
            ]);

            return $supplier->fresh();
        });
    }

    public function delete(Supplier $supplier): bool
    {
        return DB::transaction(function () use ($supplier) {
            // Set products supplier to null
            $supplier->products()->update(['supplier_id' => null]);

            return $supplier->delete();
        });
    }

    public function forceDelete(Supplier $supplier): bool
    {
        return DB::transaction(function () use ($supplier) {
            $supplier->products()->update(['supplier_id' => null]);
            return $supplier->forceDelete();
        });
    }

    public function restore(int $id): ?Supplier
    {
        $supplier = $this->model->withTrashed()->find($id);

        if ($supplier) {
            $supplier->restore();
        }

        return $supplier;
    }

    public function toggleStatus(Supplier $supplier): Supplier
    {
        $supplier->update(['is_active' => !$supplier->is_active]);
        return $supplier->fresh();
    }

    public function getCountries(): array
    {
        return $this->model
            ->query()
            ->whereNotNull('country')
            ->distinct()
            ->pluck('country')
            ->toArray();
    }

    public function getCities(): array
    {
        return $this->model
            ->query()
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city')
            ->toArray();
    }
}
