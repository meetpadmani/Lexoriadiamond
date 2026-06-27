<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Core Stats
        $stats = [
            'total_sales' => Order::confirmed()->where('status', '!=', 'cancelled')->sum('total_amount'),
            'total_orders' => Order::confirmed()->count(),
            'total_customers' => User::count(),
            'total_products' => Product::count(),
            'monthly_earnings' => Order::confirmed()->where('status', '!=', 'cancelled')
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->sum('total_amount'),
            'pending_orders' => Order::confirmed()->where('status', 'pending')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
        ];

        // 2. Recent Orders
        $recentOrders = Order::confirmed()->with('user')->latest()->take(10)->get();

        // 3. Top Selling Products
        $topProducts = OrderItem::select('product_id', 'product_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
                        ->groupBy('product_id', 'product_name')
                        ->orderBy('total_qty', 'desc')
                        ->take(5)
                        ->get();

        // 4. Sales Analytics (Last 6 months)
        $salesData = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
            $salesData[] = Order::confirmed()->where('status', '!=', 'cancelled')
                            ->whereMonth('created_at', $month->month)
                            ->whereYear('created_at', $month->year)
                            ->sum('total_amount');
        }

        // 5. Customer Growth (Last 6 months)
        $customerData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $customerData[] = User::whereMonth('created_at', $month->month)
                                ->whereYear('created_at', $month->year)
                                ->count();
        }

        // 6. Custom Order / Inquiry Stats
        $customOrderStats = [
            'total' => \App\Models\CustomOrder::count(),
            'pending' => \App\Models\CustomOrder::where('status', 'pending')->count(),
            'reviewed' => \App\Models\CustomOrder::where('status', 'reviewed')->count(),
            'accepted' => \App\Models\CustomOrder::where('status', 'accepted')->count(),
            'completed' => \App\Models\CustomOrder::where('status', 'completed')->count(),
            'rejected' => \App\Models\CustomOrder::where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts', 'salesData', 'labels', 'customerData', 'customOrderStats'));
    }
}
