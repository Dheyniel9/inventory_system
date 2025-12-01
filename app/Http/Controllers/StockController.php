<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Services\ProductService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockController extends Controller
{
    public function __construct(
        protected StockService $stockService,
        protected ProductService $productService
    ) {}

    public function index(Request $request): View
    {
        $transactions = $this->stockService->getPaginated(
            filters: $request->only(['search', 'type', 'product_id', 'user_id', 'start_date', 'end_date']),
            perPage: $request->integer('per_page', 15)
        );

        $products = $this->productService->getForDropdown();

        return view('stock.index', compact('transactions', 'products'));
    }

    public function stockIn(): View
    {
        $products = $this->productService->getForDropdown();

        return view('stock.stock-in', compact('products'));
    }

    public function processStockIn(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_cost' => ['nullable', 'numeric', 'min:0'],
            'reason' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        try {
            $this->stockService->stockIn($validated);

            return redirect()
                ->route('stock.index')
                ->with('success', 'Stock in recorded successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function stockOut(): View
    {
        $products = $this->productService->getForDropdown();

        return view('stock.stock-out', compact('products'));
    }

    public function processStockOut(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reason' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        try {
            $this->stockService->stockOut($validated);

            return redirect()
                ->route('stock.index')
                ->with('success', 'Stock out recorded successfully.');
        } catch (\InvalidArgumentException $e) {
            return back()
                ->withInput()
                ->withErrors(['quantity' => $e->getMessage()]);
        }
    }

    public function adjustment(): View
    {
        $products = $this->productService->getForDropdown();

        return view('stock.adjustment', compact('products'));
    }

    public function processAdjustment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'new_quantity' => ['required', 'integer', 'min:0'],
            'reason' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        try {
            $this->stockService->stockAdjustment($validated);

            return redirect()
                ->route('stock.index')
                ->with('success', 'Stock adjustment recorded successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(StockTransaction $stockTransaction): View
    {
        $transaction = $this->stockService->findById($stockTransaction->id);

        return view('stock.show', compact('transaction'));
    }

    public function history(int $productId): View
    {
        $product = $this->productService->findById($productId);
        $transactions = $this->stockService->getByProduct($productId);

        return view('stock.history', compact('product', 'transactions'));
    }
}
