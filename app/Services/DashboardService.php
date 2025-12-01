<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function __construct(
        protected ProductService $productService,
        protected StockService $stockService
    ) {}

    public function getOverviewStats(): array
    {
        return [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_categories' => Category::count(),
            'total_suppliers' => Supplier::count(),
            'total_users' => User::count(),
            'total_stock_value' => $this->productService->getTotalStockValue(),
            'low_stock_count' => Product::active()->lowStock()->count(),
            'out_of_stock_count' => Product::active()->outOfStock()->count(),
        ];
    }

    public function getStockSummary(): array
    {
        return [
            'today' => $this->stockService->getTransactionSummary('today'),
            'week' => $this->stockService->getTransactionSummary('week'),
            'month' => $this->stockService->getTransactionSummary('month'),
        ];
    }

    public function getLowStockProducts(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return $this->productService->getLowStockProducts($limit);
    }

    public function getRecentTransactions(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return $this->stockService->getRecentTransactions($limit);
    }

    public function getStockMovementChart(int $days = 30): array
    {
        $startDate = now()->subDays($days)->startOfDay();

        $transactions = StockTransaction::query()
            ->where('transaction_date', '>=', $startDate)
            ->selectRaw("
                DATE(transaction_date) as date,
                type,
                SUM(quantity) as total_quantity
            ")
            ->groupBy('date', 'type')
            ->orderBy('date')
            ->get();

        $dates = [];
        $stockIn = [];
        $stockOut = [];

        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('M d');

            $dayData = $transactions->where('date', $date);

            $stockIn[] = (int) $dayData->where('type', StockTransaction::TYPE_IN)->sum('total_quantity')
                + (int) $dayData->where('type', StockTransaction::TYPE_RETURN)->sum('total_quantity');

            $stockOut[] = (int) $dayData->where('type', StockTransaction::TYPE_OUT)->sum('total_quantity');
        }

        return [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Stock In',
                    'data' => $stockIn,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
                [
                    'label' => 'Stock Out',
                    'data' => $stockOut,
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                ],
            ],
        ];
    }

    public function getCategoryDistribution(): array
    {
        $categories = Category::query()
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(10)
            ->get();

        return [
            'labels' => $categories->pluck('name')->toArray(),
            'data' => $categories->pluck('products_count')->toArray(),
            'colors' => [
                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                '#EC4899', '#06B6D4', '#84CC16', '#F97316', '#6366F1',
            ],
        ];
    }

    public function getTopProducts(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Product::query()
            ->active()
            ->withCount(['stockTransactions as transactions_count' => fn($q) => $q->where('type', 'out')])
            ->withSum(['stockTransactions as total_sold' => fn($q) => $q->where('type', 'out')], 'quantity')
            ->orderBy('total_sold', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getStockValueByCategory(): array
    {
        $data = Category::query()
            ->select('categories.id', 'categories.name')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->selectRaw('COALESCE(SUM(products.quantity * products.cost_price), 0) as stock_value')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('stock_value', 'desc')
            ->limit(10)
            ->get();

        return [
            'labels' => $data->pluck('name')->toArray(),
            'data' => $data->pluck('stock_value')->map(fn($v) => round($v, 2))->toArray(),
        ];
    }

    public function getMonthlyTrend(int $months = 12): array
    {
        $startDate = now()->subMonths($months)->startOfMonth();

        $transactions = StockTransaction::query()
            ->where('transaction_date', '>=', $startDate)
            ->selectRaw("
                DATE_FORMAT(transaction_date, '%Y-%m') as month,
                SUM(CASE WHEN type IN ('in', 'return') THEN total_cost ELSE 0 END) as stock_in_value,
                SUM(CASE WHEN type = 'out' THEN total_cost ELSE 0 END) as stock_out_value
            ")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $labels = [];
        $stockInValues = [];
        $stockOutValues = [];

        for ($i = $months; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $labels[] = $date->format('M Y');

            $monthData = $transactions->get($monthKey);
            $stockInValues[] = round($monthData?->stock_in_value ?? 0, 2);
            $stockOutValues[] = round($monthData?->stock_out_value ?? 0, 2);
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Stock In Value',
                    'data' => $stockInValues,
                    'borderColor' => '#10B981',
                    'backgroundColor' => '#10B981',
                ],
                [
                    'label' => 'Stock Out Value',
                    'data' => $stockOutValues,
                    'borderColor' => '#EF4444',
                    'backgroundColor' => '#EF4444',
                ],
            ],
        ];
    }
}
