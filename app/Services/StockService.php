<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function __construct(
        protected StockTransaction $model,
        protected ProductService $productService
    ) {}

    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['product', 'user'])
            ->search($filters['search'] ?? null)
            ->byType($filters['type'] ?? null)
            ->byProduct($filters['product_id'] ?? null)
            ->byUser($filters['user_id'] ?? null)
            ->dateRange($filters['start_date'] ?? null, $filters['end_date'] ?? null)
            ->orderBy($filters['sort_by'] ?? 'created_at', $filters['sort_order'] ?? 'desc')
            ->paginate($perPage);
    }

    public function getByProduct(int $productId, int $limit = 50): Collection
    {
        return $this->model
            ->query()
            ->with(['user'])
            ->where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function findById(int $id): ?StockTransaction
    {
        return $this->model
            ->with(['product', 'user'])
            ->find($id);
    }

    public function findByReference(string $referenceNumber): ?StockTransaction
    {
        return $this->model
            ->with(['product', 'user'])
            ->where('reference_number', $referenceNumber)
            ->first();
    }

    public function stockIn(array $data): StockTransaction
    {
        return $this->createTransaction(StockTransaction::TYPE_IN, $data);
    }

    public function stockOut(array $data): StockTransaction
    {
        return $this->createTransaction(StockTransaction::TYPE_OUT, $data);
    }

    public function stockAdjustment(array $data): StockTransaction
    {
        return $this->createTransaction(StockTransaction::TYPE_ADJUSTMENT, $data);
    }

    public function stockReturn(array $data): StockTransaction
    {
        return $this->createTransaction(StockTransaction::TYPE_RETURN, $data);
    }

    protected function createTransaction(string $type, array $data): StockTransaction
    {
        return DB::transaction(function () use ($type, $data) {
            $product = Product::findOrFail($data['product_id']);
            $quantity = abs((int) $data['quantity']);
            $quantityBefore = $product->quantity;

            // Calculate new quantity based on transaction type
            $quantityAfter = match ($type) {
                StockTransaction::TYPE_IN, StockTransaction::TYPE_RETURN => $quantityBefore + $quantity,
                StockTransaction::TYPE_OUT => $quantityBefore - $quantity,
                StockTransaction::TYPE_ADJUSTMENT => (int) $data['new_quantity'] ?? $quantityBefore,
                default => $quantityBefore,
            };

            // Validate stock out doesn't go negative (unless allowed)
            if ($type === StockTransaction::TYPE_OUT && $quantityAfter < 0) {
                throw new \InvalidArgumentException(
                    "Insufficient stock. Available: {$quantityBefore}, Requested: {$quantity}"
                );
            }

            // For adjustment, calculate actual quantity change
            if ($type === StockTransaction::TYPE_ADJUSTMENT) {
                $quantity = abs($quantityAfter - $quantityBefore);
            }

            // Create transaction
            $transaction = $this->model->create([
                'product_id' => $product->id,
                'user_id' => Auth::id() ?? $data['user_id'],
                'type' => $type,
                'quantity' => $quantity,
                'quantity_before' => $quantityBefore,
                'quantity_after' => $quantityAfter,
                'unit_cost' => $data['unit_cost'] ?? $product->cost_price,
                'total_cost' => ($data['unit_cost'] ?? $product->cost_price) * $quantity,
                'reason' => $data['reason'] ?? null,
                'notes' => $data['notes'] ?? null,
                'transaction_date' => $data['transaction_date'] ?? now(),
            ]);

            // Update product quantity
            $this->productService->updateQuantity($product, $quantityAfter);

            return $transaction->load(['product', 'user']);
        });
    }

    public function bulkStockIn(array $items): array
    {
        $transactions = [];

        DB::transaction(function () use ($items, &$transactions) {
            foreach ($items as $item) {
                $transactions[] = $this->stockIn($item);
            }
        });

        return $transactions;
    }

    public function bulkStockOut(array $items): array
    {
        $transactions = [];

        DB::transaction(function () use ($items, &$transactions) {
            foreach ($items as $item) {
                $transactions[] = $this->stockOut($item);
            }
        });

        return $transactions;
    }

    public function getTransactionSummary(string $period = 'today'): array
    {
        $startDate = match ($period) {
            'today' => now()->startOfDay(),
            'week' => now()->startOfWeek(),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => now()->startOfDay(),
        };

        $transactions = $this->model
            ->query()
            ->where('transaction_date', '>=', $startDate)
            ->selectRaw("
                type,
                COUNT(*) as count,
                SUM(quantity) as total_quantity,
                SUM(total_cost) as total_value
            ")
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        return [
            'stock_in' => [
                'count' => $transactions->get(StockTransaction::TYPE_IN)?->count ?? 0,
                'quantity' => $transactions->get(StockTransaction::TYPE_IN)?->total_quantity ?? 0,
                'value' => $transactions->get(StockTransaction::TYPE_IN)?->total_value ?? 0,
            ],
            'stock_out' => [
                'count' => $transactions->get(StockTransaction::TYPE_OUT)?->count ?? 0,
                'quantity' => $transactions->get(StockTransaction::TYPE_OUT)?->total_quantity ?? 0,
                'value' => $transactions->get(StockTransaction::TYPE_OUT)?->total_value ?? 0,
            ],
            'adjustments' => [
                'count' => $transactions->get(StockTransaction::TYPE_ADJUSTMENT)?->count ?? 0,
                'quantity' => $transactions->get(StockTransaction::TYPE_ADJUSTMENT)?->total_quantity ?? 0,
                'value' => $transactions->get(StockTransaction::TYPE_ADJUSTMENT)?->total_value ?? 0,
            ],
            'returns' => [
                'count' => $transactions->get(StockTransaction::TYPE_RETURN)?->count ?? 0,
                'quantity' => $transactions->get(StockTransaction::TYPE_RETURN)?->total_quantity ?? 0,
                'value' => $transactions->get(StockTransaction::TYPE_RETURN)?->total_value ?? 0,
            ],
        ];
    }

    public function getRecentTransactions(int $limit = 10): Collection
    {
        return $this->model
            ->query()
            ->with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getTransactionsByDateRange(string $startDate, string $endDate): Collection
    {
        return $this->model
            ->query()
            ->with(['product', 'user'])
            ->dateRange($startDate, $endDate)
            ->orderBy('transaction_date', 'desc')
            ->get();
    }
}
