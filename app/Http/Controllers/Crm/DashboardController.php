<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Placeholder stats — will be populated when models are created in later phases
        $stats = [
            'total_leads' => 0,
            'new_leads_today' => 0,
            'active_projects' => 0,
            'total_clients' => 0,
            'monthly_revenue' => 0,
            'pending_payments' => 0,
            'total_quotations' => 0,
            'conversion_rate' => 0,
        ];

        // Try to load real data if tables exist
        try {
            if (\Schema::hasTable('leads')) {
                $stats['total_leads'] = DB::table('leads')->count();
                $stats['new_leads_today'] = DB::table('leads')->whereDate('created_at', today())->count();
            }
            if (\Schema::hasTable('projects')) {
                $stats['active_projects'] = DB::table('projects')->where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->count();
            }
            if (\Schema::hasTable('clients')) {
                $stats['total_clients'] = DB::table('clients')->count();
            }
            if (\Schema::hasTable('invoices')) {
                $stats['monthly_revenue'] = DB::table('invoices')
                    ->where('status', 'paid')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->sum('total');
            }
            if (\Schema::hasTable('payments')) {
                $stats['pending_payments'] = DB::table('invoices')
                    ->whereIn('status', ['sent', 'overdue'])
                    ->sum('total');
            }
            if (\Schema::hasTable('quotations')) {
                $stats['total_quotations'] = DB::table('quotations')->count();
            }
        } catch (\Exception $e) {
            // Tables don't exist yet, use defaults
        }

        // Recent activities placeholder
        $recentActivities = collect();

        // Chart data placeholders
        $leadChartLabels = [];
        $leadChartData = [];
        $revenueChartLabels = [];
        $revenueChartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $leadChartLabels[] = $month->format('M');
            $revenueChartLabels[] = $month->format('M');
            $leadChartData[] = 0;
            $revenueChartData[] = 0;
        }

        try {
            if (\Schema::hasTable('leads')) {
                $leadChartData = [];
                for ($i = 5; $i >= 0; $i--) {
                    $month = Carbon::now()->subMonths($i);
                    $leadChartData[] = DB::table('leads')
                        ->whereMonth('created_at', $month->month)
                        ->whereYear('created_at', $month->year)
                        ->count();
                }
            }
            if (\Schema::hasTable('invoices')) {
                $revenueChartData = [];
                for ($i = 5; $i >= 0; $i--) {
                    $month = Carbon::now()->subMonths($i);
                    $revenueChartData[] = DB::table('invoices')
                        ->where('status', 'paid')
                        ->whereMonth('created_at', $month->month)
                        ->whereYear('created_at', $month->year)
                        ->sum('total');
                }
            }
        } catch (\Exception $e) {
            // Tables don't exist yet
        }

        return view('crm.dashboard', compact(
            'stats',
            'recentActivities',
            'leadChartLabels',
            'leadChartData',
            'revenueChartLabels',
            'revenueChartData'
        ));
    }
}
