<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockTransaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSService
{
    public function __construct(
        protected Sale $saleModel,
        protected Product $productModel
    ) {}

    public function getProducts(array $filters = []): Collection
    {
        return $this->productModel
            ->query()
            ->active()
            ->inStock()
            ->with('category')
            ->search($filters['search'] ?? null)
            ->byCategory($filters['category_id'] ?? null)
            ->orderBy('name')
            ->get();
    }

    public function getProductByBarcode(string $barcode): ?Product
    {
        return $this->productModel
            ->query()
            ->active()
            ->where(function ($q) use ($barcode) {
                $q->where('barcode', $barcode)
                  ->orWhere('sku', $barcode);
            })
            ->first();
    }

    public function createSale(array $data): Sale
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'];
            $subtotal = 0;

            // Calculate subtotal
            foreach ($items as $item) {
                $subtotal += $item['unit_price'] * $item['quantity'];
            }

            // Calculate discount
            $discountAmount = 0;
            if (!empty($data['discount_type']) && !empty($data['discount_value'])) {
                if ($data['discount_type'] === Sale::DISCOUNT_PERCENTAGE) {
                    $discountAmount = $subtotal * ($data['discount_value'] / 100);
                } else {
                    $discountAmount = $data['discount_value'];
                }
            }

            // Calculate tax
            $taxRate = $data['tax_rate'] ?? 0;
            $taxableAmount = $subtotal - $discountAmount;
            $taxAmount = $taxableAmount * ($taxRate / 100);

            // Calculate total
            $total = $taxableAmount + $taxAmount;

            // Calculate change
            $amountPaid = $data['amount_paid'] ?? $total;
            $changeAmount = max(0, $amountPaid - $total);

            // Create sale
            $sale = $this->saleModel->create([
                'user_id' => Auth::id(),
                'customer_name' => $data['customer_name'] ?? null,
                'customer_email' => $data['customer_email'] ?? null,
                'customer_phone' => $data['customer_phone'] ?? null,
                'subtotal' => $subtotal,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'discount_type' => $data['discount_type'] ?? null,
                'discount_value' => $data['discount_value'] ?? 0,
                'discount_amount' => $discountAmount,
                'total' => $total,
                'amount_paid' => $amountPaid,
                'change_amount' => $changeAmount,
                'payment_method' => $data['payment_method'] ?? Sale::PAYMENT_CASH,
                'payment_status' => Sale::STATUS_PAID,
                'notes' => $data['notes'] ?? null,
                'sale_date' => $data['sale_date'] ?? now(),
            ]);

            // Create sale items and update stock
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);

                if (!$product) {
                    throw new \InvalidArgumentException("Product not found: {$item['product_id']}");
                }

                if ($product->quantity < $item['quantity']) {
                    throw new \InvalidArgumentException(
                        "Insufficient stock for {$product->name}. Available: {$product->quantity}, Requested: {$item['quantity']}"
                    );
                }

                $itemSubtotal = $item['unit_price'] * $item['quantity'];
                $itemDiscount = $item['discount_amount'] ?? 0;
                $itemTotal = $itemSubtotal - $itemDiscount;

                // Create sale item
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'discount_amount' => $itemDiscount,
                    'subtotal' => $itemSubtotal,
                    'total' => $itemTotal,
                ]);

                // Update stock
                $quantityBefore = $product->quantity;
                $quantityAfter = $quantityBefore - $item['quantity'];

                $product->update(['quantity' => $quantityAfter]);

                // Create stock transaction
                StockTransaction::create([
                    'product_id' => $product->id,
                    'user_id' => Auth::id(),
                    'type' => StockTransaction::TYPE_OUT,
                    'quantity' => $item['quantity'],
                    'quantity_before' => $quantityBefore,
                    'quantity_after' => $quantityAfter,
                    'unit_cost' => $product->cost_price,
                    'total_cost' => $product->cost_price * $item['quantity'],
                    'reason' => "POS Sale: {$sale->invoice_number}",
                    'transaction_date' => now(),
                ]);
            }

            return $sale->load('items.product', 'user');
        });
    }

    public function getSales(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->saleModel
            ->query()
            ->with(['user', 'items'])
            ->search($filters['search'] ?? null)
            ->byUser($filters['user_id'] ?? null)
            ->byStatus($filters['payment_status'] ?? null)
            ->byPaymentMethod($filters['payment_method'] ?? null)
            ->dateRange($filters['start_date'] ?? null, $filters['end_date'] ?? null)
            ->orderBy($filters['sort_by'] ?? 'sale_date', $filters['sort_order'] ?? 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Sale
    {
        return $this->saleModel
            ->with(['user', 'items.product'])
            ->find($id);
    }

    public function findByInvoice(string $invoiceNumber): ?Sale
    {
        return $this->saleModel
            ->with(['user', 'items.product'])
            ->where('invoice_number', $invoiceNumber)
            ->first();
    }

    public function cancelSale(Sale $sale, string $reason = null): Sale
    {
        if ($sale->is_cancelled) {
            throw new \InvalidArgumentException('Sale is already cancelled.');
        }

        return DB::transaction(function () use ($sale, $reason) {
            // Restore stock for each item
            foreach ($sale->items as $item) {
                if ($item->product) {
                    $quantityBefore = $item->product->quantity;
                    $quantityAfter = $quantityBefore + $item->quantity;

                    $item->product->update(['quantity' => $quantityAfter]);

                    // Create return stock transaction
                    StockTransaction::create([
                        'product_id' => $item->product_id,
                        'user_id' => Auth::id(),
                        'type' => StockTransaction::TYPE_RETURN,
                        'quantity' => $item->quantity,
                        'quantity_before' => $quantityBefore,
                        'quantity_after' => $quantityAfter,
                        'unit_cost' => $item->product->cost_price,
                        'total_cost' => $item->product->cost_price * $item->quantity,
                        'reason' => "Sale Cancelled: {$sale->invoice_number}" . ($reason ? " - {$reason}" : ''),
                        'transaction_date' => now(),
                    ]);
                }
            }

            // Update sale status
            $sale->update([
                'payment_status' => Sale::STATUS_CANCELLED,
                'notes' => $sale->notes . ($reason ? "\nCancelled: {$reason}" : "\nCancelled"),
            ]);

            return $sale->fresh(['user', 'items.product']);
        });
    }

    public function getTodaySummary(): array
    {
        $sales = $this->saleModel->today()->where('payment_status', Sale::STATUS_PAID);

        return [
            'total_sales' => $sales->count(),
            'total_revenue' => $sales->sum('total'),
            'total_items' => $sales->with('items')->get()->sum(fn($s) => $s->items->sum('quantity')),
            'average_sale' => $sales->count() > 0 ? $sales->avg('total') : 0,
            'by_payment_method' => [
                'cash' => $sales->clone()->where('payment_method', Sale::PAYMENT_CASH)->sum('total'),
                'card' => $sales->clone()->where('payment_method', Sale::PAYMENT_CARD)->sum('total'),
                'transfer' => $sales->clone()->where('payment_method', Sale::PAYMENT_TRANSFER)->sum('total'),
            ],
        ];
    }

    public function getSalesReport(string $period = 'today'): array
    {
        $query = $this->saleModel->query()->where('payment_status', Sale::STATUS_PAID);

        $query = match ($period) {
            'today' => $query->today(),
            'week' => $query->thisWeek(),
            'month' => $query->thisMonth(),
            default => $query->today(),
        };

        $sales = $query->get();

        return [
            'total_sales' => $sales->count(),
            'total_revenue' => $sales->sum('total'),
            'total_profit' => $this->calculateProfit($sales),
            'average_sale' => $sales->count() > 0 ? $sales->avg('total') : 0,
            'top_products' => $this->getTopSellingProducts($period),
        ];
    }

    protected function calculateProfit(Collection $sales): float
    {
        $profit = 0;

        foreach ($sales as $sale) {
            foreach ($sale->items as $item) {
                if ($item->product) {
                    $profit += ($item->unit_price - $item->product->cost_price) * $item->quantity;
                }
            }
        }

        return $profit;
    }

    protected function getTopSellingProducts(string $period, int $limit = 5): Collection
    {
        $query = SaleItem::query()
            ->select('product_id', 'product_name', 'product_sku')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(total) as total_revenue')
            ->whereHas('sale', function ($q) use ($period) {
                $q->where('payment_status', Sale::STATUS_PAID);
                match ($period) {
                    'today' => $q->today(),
                    'week' => $q->thisWeek(),
                    'month' => $q->thisMonth(),
                    default => $q->today(),
                };
            })
            ->groupBy('product_id', 'product_name', 'product_sku')
            ->orderByDesc('total_quantity')
            ->limit($limit);

        return $query->get();
    }

    public function getRecentSales(int $limit = 10): Collection
    {
        return $this->saleModel
            ->query()
            ->with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
