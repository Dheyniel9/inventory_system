<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function index(): View
    {
        return view('dashboard', [
            'stats' => $this->dashboardService->getOverviewStats(),
            'stockSummary' => $this->dashboardService->getStockSummary(),
            'lowStockProducts' => $this->dashboardService->getLowStockProducts(),
            'recentTransactions' => $this->dashboardService->getRecentTransactions(),
            'stockMovementChart' => $this->dashboardService->getStockMovementChart(),
            'categoryDistribution' => $this->dashboardService->getCategoryDistribution(),
        ]);
    }
}
