<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use App\Exports\SalesAnalyticsExport;
use App\Exports\OrderHistoryExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SalesController extends Controller
{
    /**
     * Display sales analytics page
     */
    public function index()
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Revenue metrics
        $currentMonthRevenue = Orders::whereBetween('created_at', [$currentMonth, $currentMonthEnd])->sum('total');
        $previousMonthRevenue = Orders::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->sum('total');
        
        // Order metrics
        $currentMonthOrders = Orders::whereBetween('created_at', [$currentMonth, $currentMonthEnd])->count();
        $previousMonthOrders = Orders::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->count();
        
        // Average order value
        $currentMonthAOV = $currentMonthOrders > 0 ? $currentMonthRevenue / $currentMonthOrders : 0;
        $previousMonthAOV = $previousMonthOrders > 0 ? $previousMonthRevenue / $previousMonthOrders : 0;
        
        // Calculate percentage changes
        $revenueChange = $this->calculatePercentageChange($previousMonthRevenue, $currentMonthRevenue);
        $ordersChange = $this->calculatePercentageChange($previousMonthOrders, $currentMonthOrders);
        $aovChange = $this->calculatePercentageChange($previousMonthAOV, $currentMonthAOV);

        // Top 5 selling products
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', 'products.image', 'products.price', 
                     DB::raw('SUM(order_items.quantity) as total_quantity'),
                     DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // Sales by status
        $salesByStatus = Orders::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(total) as revenue'))
            ->groupBy('status')
            ->get();

        // Daily sales for current month
        $dailySales = Orders::whereBetween('created_at', [$currentMonth, $currentMonthEnd])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'), DB::raw('SUM(total) as revenue'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.sales.sales', [
            'currentMonthRevenue' => $currentMonthRevenue,
            'previousMonthRevenue' => $previousMonthRevenue,
            'revenueChange' => $revenueChange,
            'currentMonthOrders' => $currentMonthOrders,
            'previousMonthOrders' => $previousMonthOrders,
            'ordersChange' => $ordersChange,
            'currentMonthAOV' => $currentMonthAOV,
            'aovChange' => $aovChange,
            'topProducts' => $topProducts,
            'salesByStatus' => $salesByStatus,
            'dailySales' => $dailySales,
        ]);
    }

    /**
     * Calculate percentage change between two values
     */
    private function calculatePercentageChange($oldValue, $newValue)
    {
        if ($oldValue == 0) {
            return $newValue > 0 ? 100 : 0;
        }
        return (($newValue - $oldValue) / $oldValue) * 100;
    }

    /**
     * Export sales analytics to Excel
     */
    public function exportAnalyticsExcel()
    {
        $data = $this->getSalesData();
        return Excel::download(new SalesAnalyticsExport($data), 'sales-analytics-' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Export sales analytics to PDF
     */
    public function exportAnalyticsPDF()
    {
        $startDate = request('start_date') ? Carbon::parse(request('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = request('end_date') ? Carbon::parse(request('end_date'))->endOfDay() : Carbon::now()->endOfMonth();
        
        $data = $this->getSalesData($startDate, $endDate);
        
        $pdf = \PDF::loadView('admin.sales.analytics-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('sales-analytics-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export order history to Excel
     */
    public function exportOrdersExcel()
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
        
        return Excel::download(
            new OrderHistoryExport($startDate, $endDate),
            'order-history-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Get sales data for export
     */
    private function getSalesData($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->startOfMonth();
        $endDate = $endDate ?? Carbon::now()->endOfMonth();
        
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Revenue metrics
        $currentMonthRevenue = Orders::whereBetween('created_at', [$currentMonth, $currentMonthEnd])->sum('total');
        $previousMonthRevenue = Orders::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->sum('total');
        
        // Order metrics
        $currentMonthOrders = Orders::whereBetween('created_at', [$currentMonth, $currentMonthEnd])->count();
        $previousMonthOrders = Orders::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->count();
        
        // Average order value
        $currentMonthAOV = $currentMonthOrders > 0 ? $currentMonthRevenue / $currentMonthOrders : 0;
        $previousMonthAOV = $previousMonthOrders > 0 ? $previousMonthRevenue / $previousMonthOrders : 0;
        
        // Calculate percentage changes
        $revenueChange = $this->calculatePercentageChange($previousMonthRevenue, $currentMonthRevenue);
        $ordersChange = $this->calculatePercentageChange($previousMonthOrders, $currentMonthOrders);
        $aovChange = $this->calculatePercentageChange($previousMonthAOV, $currentMonthAOV);

        // Top 5 selling products (for selected range)
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->select('products.id', 'products.name', 'products.image', 'products.price', 
                     DB::raw('SUM(order_items.quantity) as total_quantity'),
                     DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // Sales by status (for selected range)
        $salesByStatus = Orders::whereBetween('created_at', [$startDate, $endDate])
            ->select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(total) as revenue'))
            ->groupBy('status')
            ->get();

        // Daily sales (for selected range)
        $dailySales = Orders::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'), DB::raw('SUM(total) as revenue'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'currentMonthRevenue' => $currentMonthRevenue,
            'previousMonthRevenue' => $previousMonthRevenue,
            'revenueChange' => $revenueChange,
            'currentMonthOrders' => $currentMonthOrders,
            'previousMonthOrders' => $previousMonthOrders,
            'ordersChange' => $ordersChange,
            'currentMonthAOV' => $currentMonthAOV,
            'previousMonthAOV' => $previousMonthAOV,
            'aovChange' => $aovChange,
            'topProducts' => $topProducts,
            'salesByStatus' => $salesByStatus,
            'dailySales' => $dailySales,
        ];
    }
}
