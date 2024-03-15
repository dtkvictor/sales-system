<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\ItemSale;
use App\Services\Sales\AnnualSalesService;
use App\Services\Sales\MonthlySalesService;
use App\Services\Sales\DailySalesService;

class DashboardController extends Controller
{
    public function index()
    {   
        $sale = new Sale();
        
        return view('components.pages.dashboard.index', [
            'annualSales' => new AnnualSalesService($sale->annualSales()),
            'monthlySales' => new MonthlySalesService($sale->monthlySales()),
            'dailySales' => new DailySalesService($sale->dailySales()),
            'topSellingProducts' => ItemSale::topSellingProducts(),
        ]);
    }
}
