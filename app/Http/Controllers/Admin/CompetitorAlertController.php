<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompetitorAlert;
use Illuminate\Http\Request;

class CompetitorAlertController extends Controller
{
    public function index()
    {
        $alerts = CompetitorAlert::with('competitor')
            ->latest()
            ->paginate(50);
            
        return response()->json($alerts);
    }

    public function markRead($id)
    {
        $alert = CompetitorAlert::findOrFail($id);
        $alert->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'એલર્ટ વંચાયેલ તરીકે ચિહ્નિત.'
        ]);
    }
}
