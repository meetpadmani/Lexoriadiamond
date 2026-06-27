<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorStatsController extends Controller
{
    public function dashboard()
    {
        $competitors = Competitor::with(['latestStat', 'latestPrice'])->get();
        return view('admin.competitors.dashboard', compact('competitors'));
    }
}
