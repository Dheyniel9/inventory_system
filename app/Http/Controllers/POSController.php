<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Services\CategoryService;
use App\Services\POSService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class POSController extends Controller
{
    public function __construct(
        protected POSService $posService,
        protected CategoryService $categoryService
    ) {}

    public function index(Request $request): View
    {
        $products = $this->posService->getProducts([
            'search' => $request->get('search'),
            'category_id' => $request->get('category_id'),
        ]);

        $categories = $this->categoryService->getAll();

        return view('pos.index', compact('products', 'categories'));
    }

    public function searchProduct(Request $request): JsonResponse
    {
        $barcode = $request->get('barcode');
        $product = $this->posService->getProductByBarcode($barcode);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        if ($product->quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Product out of stock'], 400);
        }

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'barcode' => $product->barcode,
                'price' => $product->selling_price,
                'quantity' => $product->quantity,
                'image' => $product->image_url,
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'items.*.discount_amount' => ['nullable', 'numeric', 'min:0'],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'discount_type' => ['nullable', 'in:percentage,fixed'],
            'discount_value' => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['required', 'in:cash,card,transfer'],
            'amount_paid' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        try {
            $sale = $this->posService->createSale($validated);

            return response()->json([
                'success' => true,
                'message' => 'Sale completed successfully',
                'sale' => [
                    'id' => $sale->id,
                    'invoice_number' => $sale->invoice_number,
                    'total' => $sale->total,
                    'amount_paid' => $sale->amount_paid,
                    'change_amount' => $sale->change_amount,
                ],
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the sale.',
            ], 500);
        }
    }

    public function sales(Request $request): View
    {
        $sales = $this->posService->getSales(
            filters: $request->only(['search', 'user_id', 'payment_status', 'payment_method', 'start_date', 'end_date']),
            perPage: $request->integer('per_page', 15)
        );

        return view('pos.sales', compact('sales'));
    }

    public function show(Sale $sale): View
    {
        $sale = $this->posService->findById($sale->id);

        return view('pos.show', compact('sale'));
    }

    public function receipt(Sale $sale): View
    {
        $sale = $this->posService->findById($sale->id);

        return view('pos.receipt', compact('sale'));
    }

    public function cancel(Request $request, Sale $sale): RedirectResponse
    {
        $request->validate([
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $this->posService->cancelSale($sale, $request->get('reason'));

            return redirect()
                ->route('pos.sales')
                ->with('success', 'Sale cancelled successfully. Stock has been restored.');
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function report(Request $request): View
    {
        $period = $request->get('period', 'today');
        $report = $this->posService->getSalesReport($period);
        $todaySummary = $this->posService->getTodaySummary();

        return view('pos.report', compact('report', 'todaySummary', 'period'));
    }
}
