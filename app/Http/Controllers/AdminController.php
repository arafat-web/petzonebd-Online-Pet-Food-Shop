<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Current month range
        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();
        
        // Last month range
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        
        // Get stats
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'user')->count();
        
        // Calculate total revenue
        $totalRevenue = Order::sum('total') ?? 0;
        
        // Calculate percentage changes
        
        // Products this month vs last month
        $productsThisMonth = Product::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $productsLastMonth = Product::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $productsChange = $this->calculatePercentageChange($productsLastMonth, $productsThisMonth);
        
        // Orders this month vs last month
        $ordersThisMonth = Order::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $ordersLastMonth = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $ordersChange = $this->calculatePercentageChange($ordersLastMonth, $ordersThisMonth);
        
        // Revenue this month vs last month
        $revenueThisMonth = Order::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('total') ?? 0;
        $revenueLastMonth = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total') ?? 0;
        $revenueChange = $this->calculatePercentageChange($revenueLastMonth, $revenueThisMonth);
        
        // Customers this month vs last month
        $customersThisMonth = User::where('role', 'user')->whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $customersLastMonth = User::where('role', 'user')->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $customersChange = $this->calculatePercentageChange($customersLastMonth, $customersThisMonth);
        
        // Get recent orders
        $recentOrders = Order::with('user')
            ->latest()
            ->limit(4)
            ->get();
        
        // Get categories with product counts
        $categories = Category::withCount('products')
            ->get();
        
        return view('admin.home.index', compact(
            'totalProducts',
            'totalOrders', 
            'totalCustomers',
            'totalRevenue',
            'productsChange',
            'ordersChange',
            'revenueChange',
            'customersChange',
            'recentOrders',
            'categories'
        ));
    }
    
    /**
     * Calculate percentage change between two values
     */
    private function calculatePercentageChange($oldValue, $newValue)
    {
        if ($oldValue == 0) {
            return $newValue > 0 ? 100 : 0;
        }
        
        $change = (($newValue - $oldValue) / $oldValue) * 100;
        return round($change, 1);
    }

}