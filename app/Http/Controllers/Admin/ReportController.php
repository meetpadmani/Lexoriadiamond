<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $stats = [
            'total_sales' => Order::confirmed()->where('status', '!=', 'cancelled')->sum('total_amount'),
            'total_tax' => Order::confirmed()->where('status', '!=', 'cancelled')->sum('tax_amount'),
            'total_profit' => $this->calculateProfit(),
            'total_customers' => User::count(),
        ];

        return view('admin.reports.index', compact('stats'));
    }

    public function sales(Request $request)
    {
        $query = Order::confirmed()->where('status', '!=', 'cancelled');

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->latest()->paginate(20);
        $totalSales = $query->sum('total_amount');

        return view('admin.reports.sales', compact('orders', 'totalSales'));
    }

    public function products(Request $request)
    {
        $query = OrderItem::select(
            'product_id',
            'product_name',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(subtotal) as total_revenue')
        )
        ->groupBy('product_id', 'product_name');

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $products = $query->orderBy('total_quantity', 'desc')->paginate(20);

        return view('admin.reports.products', compact('products'));
    }

    public function customers(Request $request)
    {
        $query = User::select(
            'users.*',
            DB::raw('(SELECT SUM(total_amount) FROM orders WHERE orders.user_id = users.id AND orders.status != "cancelled" AND (payment_method != "razorpay" OR status != "pending")) as total_spent'),
            DB::raw('(SELECT COUNT(*) FROM orders WHERE orders.user_id = users.id AND orders.status != "cancelled" AND (payment_method != "razorpay" OR status != "pending")) as total_orders')
        );

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $customers = $query->orderBy('total_spent', 'desc')->paginate(20);

        return view('admin.reports.customers', compact('customers'));
    }

    public function tax(Request $request)
    {
        $query = Order::confirmed()->where('status', '!=', 'cancelled')->where('tax_amount', '>', 0);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->latest()->paginate(20);
        $totalTax = $query->sum('tax_amount');

        return view('admin.reports.tax', compact('orders', 'totalTax'));
    }

    public function profitLoss(Request $request)
    {
        // For Profit/Loss, we need to compare order items price with product cost_price
        $query = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'order_items.*',
                'products.cost_price as unit_cost',
                DB::raw('(order_items.price - IFNULL(products.cost_price, 0)) * order_items.quantity as profit')
            )
            ->where('orders.status', '!=', 'cancelled');

        if ($request->filled('start_date')) {
            $query->whereDate('order_items.created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('order_items.created_at', '<=', $request->end_date);
        }

        $report = $query->latest('order_items.created_at')->paginate(20);
        $totalRevenue = $query->sum(DB::raw('order_items.price * order_items.quantity'));
        $totalCost = $query->sum(DB::raw('IFNULL(products.cost_price, 0) * order_items.quantity'));
        $totalProfit = $totalRevenue - $totalCost;

        return view('admin.reports.profit_loss', compact('report', 'totalRevenue', 'totalCost', 'totalProfit'));
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'csv');
        $reportType = $request->get('report_type', 'sales');
        $data = $this->getReportData($reportType, $request);

        if ($type === 'csv') {
            return $this->exportToCsv($data, $reportType);
        } elseif ($type === 'pdf') {
            return $this->exportToPdf($data, $reportType);
        } elseif ($type === 'excel') {
            // We use CSV for Excel compatibility as phpspreadsheet is missing GD
            return $this->exportToCsv($data, $reportType, true);
        }

        return back()->with('error', 'Invalid export type.');
    }

    private function getReportData($reportType, Request $request)
    {
        $query = null;
        switch ($reportType) {
            case 'sales':
                $query = Order::confirmed()->where('status', '!=', 'cancelled');
                break;
            case 'products':
                $query = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_revenue'))
                    ->groupBy('product_name');
                break;
            case 'customers':
                $query = User::select('name', 'email', 
                    DB::raw('(SELECT SUM(total_amount) FROM orders WHERE orders.user_id = users.id AND orders.status != "cancelled" AND (payment_method != "razorpay" OR status != "pending")) as total_spent'));
                break;
            case 'tax':
                $query = Order::confirmed()->where('status', '!=', 'cancelled')->where('tax_amount', '>', 0);
                break;
            case 'profit_loss':
                $query = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
                    ->select(
                        'order_items.product_name',
                        'order_items.quantity',
                        'order_items.price as selling_price',
                        DB::raw('IFNULL(products.cost_price, 0) as unit_cost'),
                        DB::raw('(order_items.price - IFNULL(products.cost_price, 0)) * order_items.quantity as profit')
                    )
                    ->where('orders.status', '!=', 'cancelled')
                    ->where(function($q) {
                        $q->where('orders.payment_method', '!=', 'razorpay')
                          ->orWhere('orders.status', '!=', 'pending');
                    });
                break;
        }

        if ($request->filled('start_date')) {
            $query->whereDate($reportType == 'profit_loss' || $reportType == 'products' ? 'order_items.created_at' : 'created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate($reportType == 'profit_loss' || $reportType == 'products' ? 'order_items.created_at' : 'created_at', '<=', $request->end_date);
        }

        return $query->get();
    }

    private function exportToCsv($data, $reportType, $isExcel = false)
    {
        $filename = $reportType . '_report_' . date('Y-m-d') . ($isExcel ? '.xls' : '.csv');
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = $this->getColumns($reportType);

        $callback = function() use($data, $columns, $reportType) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                $rowData = [];
                foreach ($columns as $col) {
                    $key = strtolower(str_replace([' ', '/'], '_', $col));
                    // Handle specific column mapping if needed
                    if ($reportType == 'sales' && $col == 'Date') $rowData[] = $row->created_at->format('Y-m-d');
                    elseif ($reportType == 'sales' && $col == 'Order #') $rowData[] = $row->order_number;
                    elseif ($reportType == 'sales' && $col == 'Customer') $rowData[] = $row->first_name . ' ' . $row->last_name;
                    elseif ($reportType == 'sales' && $col == 'Amount') $rowData[] = $row->total_amount;
                    elseif ($reportType == 'products' && $col == 'Product') $rowData[] = $row->product_name;
                    elseif ($reportType == 'products' && $col == 'Quantity') $rowData[] = $row->total_quantity;
                    elseif ($reportType == 'products' && $col == 'Revenue') $rowData[] = $row->total_revenue;
                    elseif ($reportType == 'customers' && $col == 'Customer') $rowData[] = $row->name;
                    elseif ($reportType == 'customers' && $col == 'Spent') $rowData[] = $row->total_spent;
                    elseif ($reportType == 'tax' && $col == 'Tax Amount') $rowData[] = $row->tax_amount;
                    elseif ($reportType == 'profit_loss' && $col == 'Selling Price') $rowData[] = $row->selling_price;
                    elseif ($reportType == 'profit_loss' && $col == 'Unit Cost') $rowData[] = $row->unit_cost;
                    else $rowData[] = $row->$key ?? '';
                }
                fputcsv($file, $rowData);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportToPdf($data, $reportType)
    {
        $columns = $this->getColumns($reportType);
        $pdf = Pdf::loadView('admin.reports.pdf', [
            'data' => $data,
            'columns' => $columns,
            'title' => ucfirst(str_replace('_', ' ', $reportType)) . ' Report',
            'reportType' => $reportType
        ]);
        return $pdf->download($reportType . '_report_' . date('Y-m-d') . '.pdf');
    }

    private function getColumns($reportType)
    {
        switch ($reportType) {
            case 'sales': return ['Date', 'Order #', 'Customer', 'Amount', 'Status'];
            case 'products': return ['Product', 'Quantity', 'Revenue'];
            case 'customers': return ['Customer', 'Email', 'Spent'];
            case 'tax': return ['Date', 'Order #', 'Amount', 'Tax Amount'];
            case 'profit_loss': return ['Product', 'Quantity', 'Selling Price', 'Unit Cost', 'Profit'];
            default: return [];
        }
    }

    private function calculateProfit()
    {
        return OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', '!=', 'cancelled')
            ->where(function($q) {
                $q->where('orders.payment_method', '!=', 'razorpay')
                  ->orWhere('orders.status', '!=', 'pending');
            })
            ->sum(DB::raw('(order_items.price - IFNULL(products.cost_price, 0)) * order_items.quantity'));
    }
}
